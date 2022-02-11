<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        //
        $countries = Country::with('states')
            ->when(\request()->keyword != null ,function ($query){

                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null , function ($query){

                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.countries.index', compact('countries'));


    }


    public function create()
    {
        //

        return view('backend.countries.create');
    }


    public function store(CountryRequest $request)
    {
        //
        try {
//
//            $input['name'] = $request->name;
//            $input['status'] = $request->status;
//            Tag::create([$input]);

            Country::create($request->validated());

            toastr()->success('Created Successfully');
            return redirect()->route('admin.countries');

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
        $countries = Country::findOrFail($id);
        return view('backend.countries.edit',compact('countries'));
    }


    public function update(CountryRequest $request)
    {
        try {
            $countries = Country::findOrFail($request->id);

            $input['name'] = $request->name;
            $input['status'] = $request->status;
            $countries->update($input);


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

            $countries = Country::findOrFail($request->delete_country_id);
            $countries->delete();

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
