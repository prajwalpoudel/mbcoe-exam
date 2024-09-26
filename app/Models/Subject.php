<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * @return BelongsTo
     */
    public function semester() {
        return $this->belongsTo(Semester::class);
    }

    /**
     * @return BelongsTo
     */
    public function syllabus() {
        return $this->belongsTo(Syllabus::class);
    }
}
