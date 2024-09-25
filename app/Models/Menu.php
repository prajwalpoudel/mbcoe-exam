<?php

namespace App\Models;

use App\Constants\MenuGroupConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * active class attribute
     *
     * @var array
     */
    protected $appends = ['active_class', 'parent_active_class'];

    /**
     * @var array
     */
    protected $fillable = [
        "title",
        "group_id",
        "class",
        "order",
        "icon",
        "is_active",
        "route",
    ];

    /**
     * Menu has many childes menu
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    /**
     * Menu may belongs to parent menu
     * @return BelongsTo
     */
    public function parents()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * @return BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(MenuGroup::class, 'group_id');
    }

    /**
     * Get active class attribute
     *
     * @return null|string
     */
    public function getActiveClassAttribute()
    {
        if (in_array(request()->route()->getName(), explode(',', $this->related_routes))){
            return 'kt-menu__item--open';
        }
        if(strtolower($this->route) == strtolower(request()->route()->getName()) ) {
            return 'kt-menu__item--active';
        }
        else {
            return null;
        }
    }

    /**
     * get parent active class
     *
     * @return null|string
     */
    public function getParentActiveClassAttribute()
    {
        return strtolower($this->group->title) === strtolower(request()->segment(2)) ? 'm-menu__item--active' : null;
    }


    /**
     * Get is active
     *
     * @return bool
     */
    public function getIsActiveAttribute()
    {
        return (strtolower($this->route) == strtolower(request()->route()->getName()) || in_array(request()->route()->getName(), explode(',', $this->related_routes)));
    }
}
