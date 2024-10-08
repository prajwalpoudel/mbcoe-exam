<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $appends = ['exam_name'];

    public function type() {
        return $this->belongsTo(ExamType::class,'exam_type_id', 'id');
    }

    public function getExamNameAttribute()
    {
        return $this->name . " " . $this->type->name;
    }
}
