<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug','photo'];
    public $timestamps = false;
    
    public function subs()
    {
    	return $this->hasMany('App\Models\Subcategory')->where('status','=',1);
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
    
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', $value);
    }
    public function getPhotoAttribute($value)
    {
        if ($value) {
            return "http://eypindia.com/assets/images/categories/". $value;
            // asset('assets/images/categories/' . $value);
        } else {
            return asset('images/profile/no-image.png');
        }
    }

}
