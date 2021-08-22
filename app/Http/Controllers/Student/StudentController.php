<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Course;
use App\Models\Classes;
use App\Models\ClassStudent;
use Illuminate\Http\Request;
use App\Models\CourseRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    // direct course page
     public function index(){
         //$courses =  Course::orderBy('created_at','desc')->get();
        $courses = Course::select('courses.*','users.name')
                ->join('users','users.id','courses.user_id')
                ->orderBY('courses.created_at','desc')
                ->paginate(6);
         return view('student.course.list')->with(['course'=>$courses]);
     }

    //  look course
     public function lookCourse($course_id){
        $id = auth()->user()->id;

        $courseData = Course::select('courses.*','users.name','users.id')
                    ->join('users','users.id','courses.user_id')
                    ->where('courses.course_id',$course_id)
                    ->get();

        $relatedClass = Course::select('classes.*')
                        ->join('classes','courses.course_id','classes.course_id')
                        ->where('courses.course_id',$course_id)
                        ->get();
        if(empty($relatedClass ->toArray())){
            $relatedClass = null;
        }
        return view('student.course.lookCourse')->with(['courseData' => $courseData, 'relatedClass' => $relatedClass] );
     }

     //enroll class
     public function enrollClass($class_id,$teacher_id,Request $request ){
         $data = [
             'class_id' => $class_id,
             'student_id' => auth()->user()->id,
             'teacher_id' => $teacher_id,
             'status' => 1
         ];
         ClassStudent::create($data);
         return back()->with(['classAttendSuccess'=>'Enroll Success!']);
     }

     //look Class Information
     public function lookClassInformation($class_id){
        $class = Classes::where('class_id',$class_id)
                ->get();
        $id = auth()->user()->id;
        $attend_status = Classes::leftJoin('class_students','classes.class_id','class_students.class_id')
                        ->where('class_students.class_id',$class_id)
                        ->where('class_students.student_id',$id)
                        ->select('class_students.status')
                        ->get();
                        
        if(empty($attend_status->toArray())){
            $status = null;
        }else{
            $status = $attend_status[0]['status'];
        } 
        return view('student.class.lookClassInformation')->with(['class' => $class , 'status' => $status]);
     }


    //  class list
    public function classList(){

        $class = Classes::orderBy('classes.created_at','desc')
                ->join('users','classes.user_id','users.id')
                ->leftJoin('class_students','classes.class_id','class_students.class_id')
                ->select('classes.*','users.name','users.id','class_students.status')
                ->paginate(6);
        return view('student.class.classList')->with(['class' => $class]);
    }
    // teacherList
    public function teacherList(){
        $teacher = User::orderBy('created_at','desc')
                ->where('role','teacher')
                ->paginate(6);
        return view('student.teacher.teacherList')->with(['teacher'=>$teacher]);
    }
    // Teacher Related Course
    public function teacherRelatedCourse($teacher_id){
        $teacher = User::where('id',$teacher_id)->get();

        $class = Classes::where('classes.user_id',$teacher_id)
                ->select('classes.*')
                ->get();
        return view('student.teacher.lookTeacherCourse')->with(['teacher'=> $teacher,'class'=>$class]);
    }

//course Request

    public function courseRequest(){
        return view('student.courseRequest.courseRequest');
    }
    public function requestCourse(Request $request){
        $validator = $this->requestCourseValidation($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'student_id' => auth()->user()->id,
            'course_request_title' => $request->course_request_title,
            'course_request_details' => $request->course_request_details,
        ];
        CourseRequest::create($data);
        return back()->with(['createSuccess'=>'Course Request Successss!']);
    }
    private function requestCourseValidation($request){
        $validator = Validator::make($request->all(), [
            'course_request_title' =>'required',
            'course_request_details' =>'required',
        ]);
        return $validator;
    }
}