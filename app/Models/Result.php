<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    public function exam() {
        return $this->belongsTo(Exam::class);
    }

    public function student() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
//        return $this->belongsTo(Student::class, 'student_id', 'symbol_no');
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

}
