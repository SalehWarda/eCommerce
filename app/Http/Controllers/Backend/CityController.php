<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CityRequest;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        //
        $cities = City::query()
            ->when(\request()->keyword != null ,function ($query){

                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null , function ($query){

                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.cities.index', compact('cities'));


    }


    public function create()
    {
        //

        $states = State::get(['id','name']);
        return view('backend.cities.create',compact('states'));
    }


    public function store(CityRequest $request)
    {
        //
        try {
//
//            $input['name'] = $request->name;
//            $input['status'] = $request->status;
//            Tag::create([$input]);

            City::create($request->validated());

            toastr()->success('Created Successfully');
            return redirect()->route('admin.cities');

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
        $cities = City::findOrFail($id);
        $states = State::get(['id','name']);

        return view('backend.cities.edit',compact('cities','states'));
    }


    public function update(CityRequest $request)
    {
        try {
            $cities = City::findOrFail($request->id);

            $cities->update($request->validated());


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

            $cities = City::findOrFail($request->delete_city_id);
            $cities->delete();

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
