<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProductCategory extends Model
{
    use HasFactory,Sluggable,SearchableTrait;

    protected $guarded=[];



    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }



    protected $searchable = [

        'columns' => [
            'product_categories.name' => 10,

        ],

    ];


    public function parent(){

        return $this->belongsTo(self::class,'parent_id');

    }

    public function children(){

        return $this->hasMany(self::class,'parent_id');
    }


    public function products(){

        return $this->hasMany(Product::class);
    }

    public function status(){

        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
