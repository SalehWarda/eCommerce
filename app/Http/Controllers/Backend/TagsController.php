<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TagsRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{

    public function index()
    {
        //
        $tags = Tag::with('products')
            ->when(\request()->keyword != null ,function ($query){

                 $query->search(\request()->keyword);
                      })
                    ->when(\request()->status != null , function ($query){

                         $query->whereStatus(\request()->status);
                    })
                     ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
                     ->paginate(\request()->limit_by ?? 10);
        return view('backend.tags.index', compact('tags'));


    }


    public function create()
    {
        //

        return view('backend.tags.createTag');
    }


    public function store(TagsRequest $request)
    {
        //
        try {
//
//            $input['name'] = $request->name;
//            $input['status'] = $request->status;
//            Tag::create([$input]);

            Tag::create($request->validated());

            toastr()->success('Created Successfully');
            return redirect()->route('admin.tags');

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
        $tags = Tag::findOrFail($id);
        return view('backend.tags.editTag',compact('tags'));
    }


    public function update(TagsRequest $request)
    {
        try {
            $tags = Tag::findOrFail($request->id);

            $input['name'] = $request->name;
            $input['slug'] = null;
            $input['status'] = $request->status;
            $tags->update($input);


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

            $tags = Tag::findOrFail($request->delete_tag_id);
            $tags->delete();

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
