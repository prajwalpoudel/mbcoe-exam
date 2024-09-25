<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semester extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function faculty() {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }
    /**
     * @return HasMany
     */
    public function subjects() {
        return $this->hasMany(Subject::class, 'semester_id', 'id');
    }
}
