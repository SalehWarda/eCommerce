<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use HasFactory,Sluggable,SearchableTrait;
    protected $guarded=[];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
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
            'products.name' => 10,

        ],
      ];

    public function featured(){

        return $this->featured == 1 ? 'Yes' : 'No';

    }

    public function status(){

        return $this->status == 1 ? 'Active' : 'Inactive';

    }
    public function category(){

        return $this->belongsTo(ProductCategory::class,'product_category_id','id');
    }

    public function tags(): MorphToMany
    {

        return $this->morphToMany(Tag::class,'taggable');
    }

    public  function  firstMedia(): MorphOne
    {
        return $this->morphOne(Media::class,'mediable')->orderBy('file_sort','asc');

    }
    public function media(): MorphMany
    {

        return $this->morphMany(Media::class,'mediable');
    }
}