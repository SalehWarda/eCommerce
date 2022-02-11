<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShippingCompanyRequest;
use App\Models\Country;
use App\Models\ShippingCompany;
use Illuminate\Http\Request;

class ShippingCompanyController extends Controller
{


    public function index()
    {
        //
        $shipping_companies = ShippingCompany::withCount('countries')
            ->when(\request()->keyword != null ,function ($query){

                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null , function ($query){

                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.shipping_companies.index', compact('shipping_companies'));


    }


    public function create()
    {
        //
        $countries  = Country::orderBy('id','asc')->get(['id','name']);

        return view('backend.shipping_companies.create',compact('countries'));
    }


    public function store(ShippingCompanyRequest $request)
    {
        //
        try {
              if ($request->validated()){


                  $shipping_companies =  ShippingCompany::create($request->except('countries','submit','_token'));
                  $shipping_companies->countries()->attach(array_values($request->countries));
                  toastr()->success('Created Successfully');
                  return redirect()->route('admin.shipping_companies');

              }else{

                  toastr()->error('Something wrong');
                  return redirect()->route('admin.shipping_companies');

              }




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
        $shipping_companies = ShippingCompany::with('countries')->findOrFail($id);

        $countries = Country::get(['name','id']);
        return view('backend.shipping_companies.edit',compact('shipping_companies','countries'));
    }


    public function update(ShippingCompanyRequest $request)
    {
        try {
            if ($request->validated()){

                $shipping_companies = ShippingCompany::with('countries')->findOrFail($request->id);
                $shipping_companies->update($request->except('countries','submit','_token'));
                $shipping_companies->countries()->sync(array_values($request->countries));
                toastr()->success('Updated Successfully');
                return redirect()->back();

            }else{

                toastr()->error('Something wrong');
                return redirect()->route('admin.shipping_companies');

            }




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

            $shipping_companies = ShippingCompany::findOrFail($request->delete_shipping_companiesId);
            $shipping_companies->delete();

            toastr()->error('Deleted Successfully');
            return redirect()->back();

        }catch (\Exception $ex){

            return redirect()->back()->with([
                'message' => $ex->getMessage(),
                'alert-type' => 'danger',

            ]);

        }
    }
}
