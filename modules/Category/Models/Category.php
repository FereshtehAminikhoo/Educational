<?php

namespace Category\Models;

use Course\Models\Course;
use Illuminate\Database\Eloquent\Model;

class Category extends model
{
    protected $guarded = [];


    protected $fillable = [
        'title',
        'slug',
        'parent_id'
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getParentAttribute()
    {
        return (is_null($this->parent_id)) ? 'ندارد' : $this->parentCategory->title;
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }


}
