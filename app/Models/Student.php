<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function batch() {
        return $this->belongsTo(Batch::class);
    }

    /**
     * @return BelongsTo
     */
    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * @return BelongsToMany
     */
    public function semesters() {
        return $this->belongsToMany(Semester::class, 'semester_student', 'student_id', 'semester_id')->withPivot(['is_current']);
    }

    public function results() {
        return $this->hasMany(Result::class, 'student_id', 'id');
    }
}
