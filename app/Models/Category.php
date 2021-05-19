<?php

namespace App\Models;

use App\Models\AttributeGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function children(){
        return $this->hasMany(\App\Models\Category::class, 'parent_id');
    }
    public function childrenRecursive(){
        return $this->children()->with('childrenRecursive');
    }
    public function attributeGroups(){
        return $this->belongsToMany(AttributeGroup::class,'attributegroup_category','category_id','attributeGroup_id');
    }
    public function brands(){
        return $this->belongsToMany(Brand::class,'brand_category','category_id','brand_id');
    }
}
