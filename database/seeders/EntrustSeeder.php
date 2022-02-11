<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        $adminRole = Role::create([ 'name' => 'admin', 'display_name' => 'Administratin',  'description' => 'Administrator', 'allowed_route' => 'admin',]);
        $supervisorRole = Role::create(['name' => 'supervisor', 'display_name' => 'Supervisor', 'description' => 'Supervisor', 'allowed_route' => 'admin',]);
        $customerRole = Role::create(['name' => 'customer', 'display_name' => 'Customer', 'description' => 'Customer', 'allowed_route' => null,]);


        $admin = User::create(['first_name'=>'Admin','last_name'=>'System','username'=>'admin','email'=>'admin@gmail.com','email_verified_at'=>now(),'mobile'=>'05920983231','user_image'=>'avatar.png','status'=>1,'password'=>bcrypt('sa403737570sa'),'remember_token'=>Str::random(10)]);
        $admin->attachRole($adminRole);

        $supervisor = User::create(['first_name'=>'Supervisor','last_name'=>'System','username'=>'supervisor','email'=>'supervisor@gmail.com','email_verified_at'=>now(),'mobile'=>'05920983232','user_image'=>'avatar.png','status'=>1,'password'=>bcrypt('sa403737570sa'),'remember_token'=>Str::random(10)]);
        $supervisor->attachRole($supervisorRole);

        $customer = User::create(['first_name'=>'Saleh','last_name'=>'AbuWarda','username'=>'salehwarda','email'=>'salehwarda6@gmail.com','email_verified_at'=>now(),'mobile'=>'05920983233','user_image'=>'avatar.png','status'=>1,'password'=>bcrypt('sa403737570sa'),'remember_token'=>Str::random(10)]);
        $customer->attachRole($customerRole);


        for ($i=1; $i<=20; $i++){


            $random_customer = User::create([
                'first_name'=>$faker->firstName,
                'last_name'=>$faker->lastName,
                'username'=>$faker->userName,
                'email'=>$faker->unique()->safeEmail,
                'email_verified_at'=>now(),
                'mobile'=>'059'.$faker->numberBetween(1000000,9999999),
                'user_image'=>'avatar.png',
                'status'=>1,
                'password'=>bcrypt('sa403737570sa'),
                'remember_token'=>Str::random(10)]);
            $random_customer->attachRole($customerRole);

        }
    }
}
