<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuGroup extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['title', 'order'];

    /**
     * @return HasMany
     */
    public function menus()
    {
        return $this->hasMany(Menu::class, 'group_id');
    }
}
