<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRequest extends Model
{
    use HasFactory;
    protected $fillable = ['course_request_id','student_id','course_request_title','course_request_details','created_at','updated_at'];
}
