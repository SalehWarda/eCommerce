<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class CustomerAddress extends Model
{
    use HasFactory,SearchableTrait;

    protected $guarded=[];


    public $searchable=[

        'columns'=>[

            'customer_addresses.address_title'     =>  10,
            'customer_addresses.first_name'        =>  10,
            'customer_addresses.last_name'         =>  10,
            'customer_addresses.email'             =>  10,
            'customer_addresses.mobile'            =>  10,
            'customer_addresses.address'           =>  10,
            'customer_addresses.address2'          =>  10,
            'customer_addresses.zip_code'          =>  10,
            'customer_addresses.po_box'            =>  10,
            'countries.name'                       =>  10,
            'states.name'                          =>  10,
            'cities.name'                          =>  10,
            'users.first_name'                     =>  10,
            'users.last_name'                      =>  10,
            'users.username'                       =>  10,
            'users.email'                          =>  10,
            'users.mobile'                         =>  10,

        ],
        'joins' => [
            'users' => ['users.id','customer_addresses.user_id'],
            'countries' => ['countries.id','customer_addresses.country_id'],
            'states' => ['states.id','customer_addresses.state_id'],
            'cities' => ['cities.id','customer_addresses.city_id'],
        ]
    ];



    public function defaultAddress()
    {
        return $this->default_address ? 'Default Address' : null;
    }


    public function user(){

        return $this->belongsTo(User::class);
    }

    public function country(){

        return $this->belongsTo(Country::class);
    }


    public function state(){

        return $this->belongsTo(State::class);
    }

    public function city(){

        return $this->belongsTo(City::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }


}
