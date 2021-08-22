<?php

namespace App\Http\Controllers\Teacher;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Classes;
use App\Models\ClassStudent;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\CourseRequest;
use App\Mail\TeacherResponseMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function course(){
        if(Session::has('CREATE_COURSE')){
            $sessionData = Session::get('CREATE_COURSE');
        }else{
            $sessionData = [];
            $sessionData['course_title']="";
            $sessionData['course_explanation']="";
            $sessionData['course_details']="";
        }
        Session::forget('CREATE_COURSE');
 
        return view('teacher.course.courseInfo')->with('sessionData' , $sessionData);
    }

    public function classInfo(){
        $id = auth()->user()->id;
        $course = Course::where('user_id',$id)->get();
        return view('teacher.class.classInfo')->with(['course'=> $course]);
    }

    public function classStudentInfo(){
        $id = auth()->user()->id;
        $classStudent = ClassStudent::select('users.name','classes.class_name','class_students.*','courses.course_title')
                        ->orderBy('class_students.created_at','desc')
                        ->join('users','users.id','class_students.student_id')
                        ->join('classes','classes.class_id','class_students.class_id')
                        ->join('courses','classes.course_id','courses.course_id')
                        ->where('teacher_id',$id)
                        ->get();
        return view('teacher.classStudent.classStudentInfo')->with(['classStudent' => $classStudent ]);
    }
//change Status
    public function changeStatus($class_student_id,$status){
        //2 accept
        //3 full student
        //4 reject
        $data =[
            'status' => $status
        ];

        $email = ClassStudent::join('users','users.id','class_students.student_id')
                ->where('class_students.class_student_id',$class_student_id)
                ->select('users.email')
                ->get();

            $mail=[];
            if($status !=5){
                if($status == 2){
                    $mail['message'] = 'Teacher Accept this class';
                }elseif($status == 3){
                    $mail['message'] = 'Students full in this class';
                }elseif($status == 4){
                    $mail['message'] = 'Teacher Reject this class';
                }
                Mail::to($email[0]['email'])->send(new TeacherResponseMail($mail));  
            }
            

                  

        ClassStudent::where('class_student_id',$class_student_id)->update($data);
        return back()->with(['changeStatusSuccess' => 'Change Status Success']);
    }

    public function courseList(){
        $id = auth()->user()->id;
        $courseData = Course::where('user_id',$id)->orderBy('created_at','desc')->get();
        return view('teacher.course.courseList')->with(['course' => $courseData]);
    }

    public function deleteCourse($course_id){
        Course::where('course_id',$course_id)->delete();
        return back()->with(['deleteSuccess'=>'Course Deleted!']);

    }

    public function updatePage($course_id){
        $courseData = Course::where('course_id',$course_id)->get();
        return view('teacher.course.updateCourse')->with(['courseData' => $courseData]);

    }

    public function courseUpdate($course_id,Request $request){
        $validator = $this->requestCourseValidation($request);
                $courseData = $this->getCourseData($request,"update");
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }


        Course::where('course_id',$course_id)->update($courseData);

        return back()->with(['updateSuccess' => "Course Update Success!"]);

    }

    public function profileInfo(){
        $id = auth()->user()->id;
        $teacherInfo = User::where('id' ,$id)->get();
        return view('teacher.profile.profileInfo')->with(['teacherInfo'=> $teacherInfo]);
    }

    public function newsInfo(){
        $news = CourseRequest::join('users','course_requests.student_id','users.id')
                ->orderBy('course_requests.created_at','desc')
                ->select('course_requests.*','users.name')
                ->paginate(7);
        
        return view('teacher.news.newsInfo')->with(['news'=>$news]);
    }

    //update Profile
    public function updateProfile($user_id, Request $request){
        $userData = $this->getUserProfileData($request);
        User::where('id',$user_id)->update($userData);
        return back()->with(['updateSuccess' => 'Successfully Update']);
    }

    public function notificationInfo(){
        $notification = Notification::orderBy('created_at','desc')->paginate('10');

        return view('teacher.notification.notificationInfo')->with(['notification'=>$notification]);
    }
    

    //course

    public function createCourse(Request $request){

        $validator = $this->requestCourseValidation($request);
        $data = $this->getCourseData($request,"create");
         Session::put('CREATE_COURSE',$data);
         $sessionData = Session::get('CREATE_COURSE');

        if ($validator->fails()) {
            return back()->with(['session_data' => $sessionData,'sessionData'=>$sessionData])
                        ->withErrors($validator)
                        ->withInput();
        }


        Course::create($data);
        return back()->with(['courseSuccess'=>'Course create success!']);
    }
    //change password page
    public function changePasswordForm(){
        return view('teacher.profile.changePassword');
    }

    //change password 
    public function changePassword(Request $request){
        $validator = $this->changeProfilePassword($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        $db_password = auth()->user()->password;
        if (Hash::check($request->old_password , $db_password)){
            if(strlen($request->new_password) >= 8 && strlen($request->confirm_password ) >= 8){
                if($request->new_password == $request->confirm_password){
                    
                    $data = [
                        'password' => Hash::make($request->new_password)
                    ];
                    $id = auth()->user()->id;

                    User::where('id',$id)->update($data);
                    return back()->with('success','Change Password Success!');
                }else{

                    return back()->with('notSameBoth','Password do not match! Try Again');
                }
            }else{

                return back()->with('errorLength','New Password &Confirm Password must be Greater Than8! Try Again');
            }
        }else{

            return back()->with('noMatch','Old Password do not Match! Try Again');
        }
    }

    //create class
    public function createClass(Request $request){
        $validator = $this->requestClassValidation($request);
        // Session::put('COURSE_DATA',$data);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $classData = $this->getClassData($request,"create");
        // dd($classData);
        Classes::create($classData);
        return back()->with(['createClassSuccess'=>'Class Created!']);
        }


    //class List
    public function classList(){
        $id = auth()->user()->id;
        $classData = Classes::select('classes.*','courses.*')
                    ->join('courses','courses.course_id',"classes.course_id")
                    ->where('classes.user_id',$id)
                    ->orderBy('classes.created_at','desc')
                    ->get();
        return view('teacher.class.classList')->with(['classData'=> $classData]);
    }
    //delete class
    public function deleteClass($class_id){
        Classes::where('class_id',$class_id)->delete();
        return back()->with(['deleteSuccess'=> 'Class Deleted!']);
    }

    //update Class Page
    public function updateClassPage($class_id){
        $data = Classes::where('class_id',$class_id)->get();
        return view('teacher.class.updateClass')->with(['class'=> $data]);
    }

    //update Class
    public function updateClass($class_id,Request $request){
        $validator = $this->requestClassValidation($request);
        // Session::put('COURSE_DATA',$data);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        $classData = $this->getClassData($request);
        Classes::where('class_id',$class_id)->update($classData);
        return back()->with(['updateSuccess'=>'Class Updated']);
    }

    //get course data from client
    private function getCourseData($request,$status){
        if($status == "create"){
            $response=[
                'course_title' => $request->course_title,
                'user_id' => auth()->user()->id,
                'course_explanation' => $request->course_explanation,
                'course_details' => $request->course_details,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
    
            ];
        }else if($status == "update"){
            $response=[
                'course_title' => $request->course_title,
                'course_explanation' => $request->course_explanation,
                'course_details' => $request->course_details,
                'updated_at' => Carbon::now()
    
            ];
        }
        
        return $response;
    }

 
    //request course validation
    private function requestCourseValidation($request){
        $validator = Validator::make($request->all(), [
            'course_title' => 'required',
            'course_explanation' => 'required',
            'course_details' => 'required',
        ],[
            'course_title.required' => 'Course title needed!',
            'course_explanation.required' => 'Course explaination needed!',
            'course_details.required' => 'Course details needed!'
        ]);
        return $validator;
    }
    //get user profile data
    private function getUserProfileData($request){
        $validator = $this->requestUserProfileValidation($request);
        // Session::put('COURSE_DATA',$data);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $data = [
            'name' =>$request->name,
            'email' =>$request->email,
            'gender' =>$request->gender,
            'date_of_birth' =>$request->date_of_birth,
            'phone_number_one' =>$request->phone_number_one,
            'phone_number_two' =>$request->phone_number_two,
            'region' =>$request->region,
            'town' =>$request->town,
            'address' =>$request->address,

        ];
        return $data;
    }

    private function requestUserProfileValidation($request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'phone_number_one' => 'required',
            'phone_number_two' => 'required',
            'region' => 'required',
            'town' => 'required',
            'address' => 'required',             
     ]);
        return $validator;
    }

    //change profile password
    private function changeProfilePassword($request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',         
     ]);
        return $validator;
    }

     //request class validation
     private function requestClassValidation($request){
        $validator = Validator::make($request->all(), [
            'class_name' => 'required',
            'fee' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'start_date' => 'required',
            'end_date' => 'required|after:start_date',
            'class_type' => 'required',
                ],[
            'class_name.required' => 'Class Name needed!',
            'fee.required' => 'Class fee needed!',
            'start_time.required' => 'Start Time needed!',   
            'end_time.required' => 'End Time needed!',   
            'end_time.after' => 'Start Time Must lower than End Time!',   
            'start_date.required' => 'Start Date needed!',
            'end_date.required' => 'End Date needed!', 
            'end_date.after' => 'Start Date Must lower than End Date!', 
            'class_type.required' => 'Class Type needed!',

     ]);
        return $validator;
    }

    // get class data
    private function getClassData($request){
        $data = [];
        if(isset($request -> course_id)){
            $data['course_id'] = $request->course_id;
         }
         if(isset($request -> class_name)){
            $data['class_name'] = $request->class_name;
         }
         if(isset($request -> fee)){
            $data['fee'] = $request->fee;
         }
         if(isset($request -> start_date)){
            $data['start_date'] = $request->start_date;
         }
         if(isset($request -> end_date)){
            $data['end_date'] = $request->end_date;
         }
         if(isset($request -> start_time)){
            $data['start_time'] = $request->start_time;
         }
         if(isset($request -> end_time)){
            $data['end_time'] = $request->end_time;
         }
         if(isset($request -> class_type)){
            $data['class_type'] = $request->class_type;
         }
         if(isset($request -> monday)){
            $data['monday'] = 1;
         }else{
             $data['monday'] = "0";
         }
         if(isset($request -> tuesday)){
            $data['tuesday'] = 1;
         }else{
            $data['tuesday'] = "0";
        }
         if(isset($request -> wednesday)){
            $data['wednesday'] = 1;
         }else{
            $data['wednesday'] = "0";
        }
         if(isset($request -> thursday)){
            $data['thursday'] = 1;
         }else{
            $data['thursday'] = "0";
        }
         if(isset($request -> friday)){
            $data['friday'] = 1;
         }else{
            $data['friday'] = "0";
        }
         if(isset($request -> saturday)){
            $data['saturday'] = 1;
         }else{
            $data['saturday'] = "0";
        }
         if(isset($request -> sunday)){
            $data['sunday'] = 1;
         }else{
            $data['sunday'] = "0";
        }
        $data['user_id']= auth()->user()->id;
         return $data;

    }
}
