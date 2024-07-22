<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{
    use HasFactory;
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
}
