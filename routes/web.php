<?php

use App\Mail\TeacherResponseMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Middleware\StudentCheckMiddleware;
use App\Http\Middleware\TeacherCheckMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('sendMail',function(){
    $data = [
        'message' => "This is testing mail"
    ];
    Mail::to('ethancohen118@gmail.com')->send(new TeacherResponseMail($data));
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if(Auth::check()){
        if(Auth::user()-> role == 'admin'){
            return redirect()->route('lookTeacherList');
        }else if(Auth::user()-> role == 'teacher'){
            return redirect()->route('teacherCourse');
        }else if(Auth::user()-> role == 'student'){
            return redirect()->route('studentCourseList');
        }
    }
})->name('dashboard');

//Admin
Route::group(['prefix'=>'admin' , 'namespace'=>'Admin' ,'middleware' => [AdminCheckMiddleware::class]],function(){

    //teacher
    Route::get('lookTeacherList','AdminController@index')->name('lookTeacherList');
    Route::get('lookTeacherDetails/{teacher_id}','AdminController@lookTeacherDetails')->name('lookTeacherDetails');
    

    //student
    Route::get('studentList','AdminController@studentList')->name('studentList');

    //notification  
    Route::get('sendNotification','AdminController@sendNotification')->name('sendNotification');
    Route::post('sendNoti','AdminController@sendNoti')->name('sendNoti');

   //csv
   Route::get('downloadStudentCsv','AdminController@downloadStudentCsv')->name('downloadStudentCsv');
   Route::get('downloadTeacherCsv','AdminController@downloadTeacherCsv')->name('downloadTeacherCsv');

   

    //add admin
    Route::get('addAdmin','AdminController@addAdmin')->name('addAdmin');
    Route::post('createAdminAccount','AdminController@createAdminAccount')->name('createAdminAccount');
    Route::get('adminAccountList','AdminController@adminAccountList')->name('adminAccountList');

    //delete admin
    Route::get('deleteAdminAccount/{admin_id}','AdminController@deleteAdminAccount')->name('deleteAdminAccount');

    

});

//Teacher
Route::group(['prefix'=>'teacher' , 'namespace'=>'Teacher','middleware' => [TeacherCheckMiddleware::class]],function(){

    // Course
    Route::get('course','TeacherController@course')->name('teacherCourse');
    Route::get('courseList','TeacherController@courseList')->name('courseList');
    Route::post('createCourse','TeacherController@createCourse')->name('createCourse');
    Route::get('deleteCourse/{course_id}','TeacherController@deleteCourse')->name('deleteCourse');
    Route::get('updatePage/{course_id}','TeacherController@updatePage')->name('updatePage');
    Route::post('courseUpdate/{course_id}','TeacherController@courseUpdate')->name('courseUpdate');

    //class

    Route::get('class','TeacherController@classInfo')->name('teacherClass');
    Route::post('createClass','TeacherController@createClass')->name('createClass');
    Route::get('classList','TeacherController@classList')->name('classList');
    Route::get('deleteClass/{class_id}','TeacherController@deleteClass')->name('deleteClass');
    Route::post('updateClass/{class_id}','TeacherController@updateClass')->name('updateClass');
    Route::get('updateClassPage/{class_id}','TeacherController@updateClassPage')->name('updateClassPage');

    Route::get('classStudent','TeacherController@classStudentInfo')->name('teacherClassStudent');
    Route::get('changeStatus/{class_student_id}/{status}','TeacherController@changeStatus')->name('changeStatus');


    // Profile
    Route::get('profile','TeacherController@profileInfo')->name('teacherProfile');
    Route::post('updateProfile/{user_id}', 'TeacherController@updateProfile')->name('updateProfile');
    Route::get('changePassword','TeacherController@changePasswordForm')->name('changePassword');
    Route::post('changePassswordbyME','TeacherController@changePassword')->name('changePassswordbyME');

    Route::get('news','TeacherController@newsInfo')->name('teacherNews');
    Route::get('notification','TeacherController@notificationInfo')->name('teacherNotification');

});

//Student
Route::group(['prefix'=>'student' , 'namespace'=>'Student' ,'middleware' => [StudentCheckMiddleware::class]],function(){
    Route::get('courseList','StudentController@index')->name('studentCourseList');
    Route::get('lookCourse/{course_id}','StudentController@lookCourse')->name('lookCourse');
    Route::get('enrollClass/{class_id}/{teacher_id}','StudentController@enrollClass')->name('enrollClass');


    
    // class

    Route::get('classList','StudentController@classList')->name('studentClassList');
    Route::get('lookClassInformation/{class_id}','StudentController@lookClassInformation')->name('lookClassInformation');

    //teacher
    Route::get('teacherList','StudentController@teacherList')->name('teacherList');
    Route::get('teacherRelatedCourse/{teacher_id}','StudentController@teacherRelatedCourse')->name('teacherRelatedCourse');

    //course Request
    Route::get('courseRequest','StudentController@courseRequest')->name('courseRequest');
    Route::post('requestCourse','StudentController@requestCourse')->name('requestCourse');
});