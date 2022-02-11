<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StateRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        //
        $states = State::with('cities')
            ->when(\request()->keyword != null ,function ($query){

                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null , function ($query){

                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.states.index', compact('states'));


    }


    public function create()
    {
        //

        $countries = Country::get(['id','name']);
        return view('backend.states.create',compact('countries'));
    }


    public function store(StateRequest $request)
    {
        //
        try {
//
//            $input['name'] = $request->name;
//            $input['status'] = $request->status;
//            Tag::create([$input]);

            State::create($request->validated());

            toastr()->success('Created Successfully');
            return redirect()->route('admin.states');

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
        $states = State::findOrFail($id);
        $countries = Country::get(['id','name']);

        return view('backend.states.edit',compact('countries','states'));
    }


    public function update(StateRequest $request)
    {
        try {
            $states = State::findOrFail($request->id);

            $states->update($request->validated());


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

            $states = State::findOrFail($request->delete_state_id);
            $states->delete();

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
