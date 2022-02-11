<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::whereHas('roles',function ($query){

            $query->where('name','customer');
        })
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {

                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.customers.index', compact('customers'));
    }


    public function create()
    {
        //
        return view('backend.customers.create');

    }


    public function store(CustomerRequest $request)
    {

        try {


            $input['first_name'] = $request->first_name;
            $input['last_name'] = $request->last_name;
            $input['username'] = $request->username;
            $input['email'] = $request->email;
            $input['mobile'] = $request->mobile;
            $input['password'] = bcrypt($request->password) ;
            $input['status'] = $request->status;


            if ($image = $request->file('user_image')) {
                $file_name = Str::slug($request->username) . "." . $image->getClientOriginalExtension();
                $path = public_path('/images/users/' . $file_name);

                \Intervention\Image\Facades\Image::make($image->getRealPath())->resize(300, null, function ($constraint) {

                    $constraint->aspectRatio();
                })->save($path, 100);

                $input['user_image'] = $file_name;

            }


           $customer = User::create($input);
            $customer->markEmailAsVerified();
            $customer->attachRole(Role::whereName('customer')->first()->id);

            toastr()->success('Created Successfully');
            return redirect()->back();

        } catch (\Exception $ex) {

            return redirect()->back()->with([
                'message' => $ex->getMessage(),
                'alert-type' => 'danger',

            ]);


        }


    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
        $customer = User::findOrFail($id);


        return view('backend.customers.edit', compact('customer'));


    }


    public function update(CustomerRequest $request)
    {



        try {

            $customer = User::findOrFail($request->id);

            $input['first_name'] = $request->first_name;
            $input['last_name'] = $request->last_name;
            $input['username'] = $request->username;
            $input['email'] = $request->email;
            $input['mobile'] = $request->mobile;

            if (trim($request->password != '')){
                $input['password'] = bcrypt($request->password) ;

            }
            $input['status'] = $request->status;


            if ($image = $request->file('user_image')) {


                if ($customer->user_image != null && File::exists('images/users/' . $customer->user_image)) {

                    unlink('images/users/' .  $customer->user_image);
                }

                $file_name = Str::slug($request->username) . "." . $image->getClientOriginalExtension();
                $path = public_path('/images/users/' . $file_name);

                \Intervention\Image\Facades\Image::make($image->getRealPath())->resize(300, null, function ($constraint) {

                    $constraint->aspectRatio();
                })->save($path, 100);

                $input['user_image'] = $file_name;

            }


            $customer->update($input);

            toastr()->success('Updated Successfully');
            return redirect()->back();

        } catch (\Exception $ex) {

            return redirect()->back()->with([
                'message' => $ex->getMessage(),
                'alert-type' => 'danger',

            ]);


        }


    }


    public function destroy(Request $request)
    {
        //
        try {

            $customer = User::findOrFail($request->delete_customer);

            if ($customer->user_image != null && File::exists('images/users/' . $customer->user_image)) {
                unlink('images/users/' . $customer->user_image);
            }
            $customer->delete();

            toastr()->error('Deleted Successfully');
            return redirect()->back();

        } catch (\Exception $ex) {

            return redirect()->back()->with([
                'message' => $ex->getMessage(),
                'alert-type' => 'danger',

            ]);

        }

    }

    public function removeImage(Request $request)
    {


        $customer = User::findOrFail($request->customer_id);
        if (File::exists('images/users/' .$customer->user_image)) {

            unlink('images/users/' . $customer->user_image);
            $customer->user_image = null;
            $customer->save();

        }
        return true;
    }
}
