<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomersAddressesRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;

class CustomersAddressesController extends Controller
{
    public function index()
    {
        //
        $addresses = CustomerAddress::with('user')
            ->when(\request()->keyword != null ,function ($query){

                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null , function ($query){

                $query->whereDefaultAddress(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.customers_addresses.index', compact('addresses'));


    }


    public function create()
    {
        //

        $countries = Country::whereStatus(true)->get(['id','name']);
        return view('backend.customers_addresses.create',compact('countries'));
    }


    public function store(CustomersAddressesRequest $request)
    {
        //
        try {
//
//            $input['name'] = $request->name;
//            $input['status'] = $request->status;
//            Tag::create([$input]);

            CustomerAddress::create($request->validated());

            toastr()->success('Created Successfully');
            return redirect()->route('admin.customers_addresses');

        }catch (\Exception $ex){

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
        $addresses = CustomerAddress::findOrFail($id);

        $countries = Country::whereStatus(true)->get(['id','name']);

        return view('backend.customers_addresses.edit',compact('countries','addresses'));
    }


    public function update(CustomersAddressesRequest $request)
    {
        try {
            $addresses = CustomerAddress::findOrFail($request->id);


            $addresses->update($request->validated());


            toastr()->success('Updated Successfully');
            return redirect()->back();

        }catch (\Exception $ex){

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

            $addresses = CustomerAddress::findOrFail($request->delete_customer_address_id);
            $addresses->delete();

            toastr()->error('Deleted Successfully');
            return redirect()->back();

        }catch (\Exception $ex){

            return redirect()->back()->with([
                'message' => $ex->getMessage(),
                'alert-type' => 'danger',

            ]);

        }
    }


    public function get_customers()
    {
        //

        $customers = User::whereHas('roles',function ($query){

            $query->where('name','customer');
        })

            ->when(\request()->input('query') != '' , function ($query){

                $query->search(\request()->input('query'));
            })
            ->get(['id','first_name','last_name','email'])->toArray();

        return response()->json($customers);

    }

    public function get_states($id)
    {
        //

        $states = State::whereCountryId($id)->whereStatus(true)->pluck('name','id');


        return $states;

    }

    public function get_cities($id)
    {
        //

        $cities = City::whereStateId($id)->whereStatus(true)->pluck('name','id');


        return $cities;

    }
}
