<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batch extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function syllabus() {
        return $this->belongsTo(Syllabus::class);
    }

    /**
     * @return HasMany
     */
    public function students() {
        return $this->hasMany(Student::class, 'batch_id', 'id');
    }
}
