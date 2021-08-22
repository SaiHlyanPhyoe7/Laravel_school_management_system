<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ClassStudent;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //teacher list

    public function index(){

    $teacher = ClassStudent::select('user.*', DB::raw('COUNT(class_students.teacher_id) as student_count'))
                ->join('users','users.id','class_students.teacher_id')
                ->groupBy('class_students.teacher_id')
                ->get();


    return view('admin.teacher.list')->with(['teacher'=>$teacher]);
    }

    //need to add composer first composer require usmanhalalit/laracsv:^2.0
    //download teacher csv

// public function downloadTeacherCsv(){
//         $users = User::all();

//         $teacher = ClassStudent::select('user.*', DB::raw('COUNT(class_students.teacher_id) as student_count'))
//                 ->join('users','users.id','class_students.teacher_id')
//                 ->groupBy('class_students.teacher_id')
//                 ->get();

//         dd($teacher);
//         $csvExporter = new \Laracsv\Export();

//         $csvExporter->build($teacher, [
//             'id' => 'ID',
//             'name' => 'Name',
//             'email' => 'Email',
//             'gender' => 'Gender',
//             'phone_number_one' => 'Phone Number',
//             'student_count' => 'Student Count'
            
//         ]);

//         $csvReader = $csvExporter->getReader();

//         $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

//         $filename = 'teacher_list.csv';

//         return response((string) $csvReader)
//             ->header('Content-Type', 'text/csv; charset=UTF-8')
//             ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
//     }


    //student list
    public function studentList(){
        $student = User::where('role','student')
        ->orderby('created_at','desc')
        ->get();

        return view('admin.student.list')->with(['student'=>$student]);
    }
    //need to add composer first composer require usmanhalalit/laracsv:^2.0
    //download student csv
    // public function downloadStudentCsv(){
    //     $users = User::all();

    //     $student = User::where('role','student')
    //     ->orderby('created_at','desc')
    //     ->get();
    //     dd($student);
    //     $csvExporter = new \Laracsv\Export();

    //     $csvExporter->build($student, [
    //         'name' => 'Name',
    //         'email' => 'Email',
    //         'gender' => 'Gender',
    //     ]);

    //     $csvReader = $csvExporter->getReader();

    //     $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

    //     $filename = 'student_list.csv';

    //     return response((string) $csvReader)
    //         ->header('Content-Type', 'text/csv; charset=UTF-8')
    //         ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    // }

   //look teacher details
   public function lookTeacherDetails($teacher_id){


    $teacher = User::where('id',$teacher_id)
                ->get();

    dd($teacher->toArray());
    return view('admin.teacher.detail')->with(['teacher'=> $teacher]);
}

    //delete admin account
    public function deleteAdminAccount($admin_id){
        User::where('id',$admin_id)->delete();

        return back()->with(['deleteSuccess',"Delete Success"]);
    }

    //notification
    public function sendNotification(){
        return view('admin.notification.notification');
    }

    //create admin account
    public function createAdminAccount(Request $request){
        $validator = $this->checkCreateAdminValidation($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'name' => $request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'date_of_birth' =>$request->date_of_birth,
            'phone_number_one' => $request->phone_number_one,
            'phone_number_two' =>$request->phone_number_two,
            'region' => $request->region,
            'town' =>$request->town,
            'address' => $request->address,
            'status' => 0,
            'role' => 'admin'
        ];
        User::create($data);
        return back()->with(['createSuccess' => "Admin Create Successfully!"]);
    }

    //admin account list
    public function adminAccountList(){
        $admin = User::where('role','admin')
                    ->orderBy('created_at','desc')
                    ->get();
        return view('admin.addAdmin.list')->with(['admin'=>$admin]);
    }

    //sendNoti
    public function sendNoti(Request $request){
        $user_id = auth()->user()->id;
        $sender_name = auth()->user()->name;

        $data = [
            'user_id' => $user_id,
            'sender' => $sender_name,
            'message' =>$request->message,
            'send_date' =>Carbon::now()
        ];
        Notification::create($data);
        return back()->with(['success'=>'Notification Send!']);
    }

    //add admin
    public function addAdmin(){
        return view('admin.addAdmin.create');
    }

    private function checkCreateAdminValidation($request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'phone_number_one' => 'required',
            'phone_number_two' => 'required',
            'region' => 'required',
            'town' => 'required',
            'address' => 'required',             
     ]);
        return $validator;
    }

}
