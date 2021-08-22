<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $fillable = ['class_id','user_id','course_id','class_name','fee','start_time','end_time','start_date','end_date','class_type','monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
}
