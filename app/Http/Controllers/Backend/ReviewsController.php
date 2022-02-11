<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ReviewsRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{

    public function index()
    {

        $reviews = Review::query()
            ->when(\request()->keyword != null, function ($query){

                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null , function ($query){

                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.reviews.index',compact('reviews'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
      $review =  Review::findOrFail($id);
       return view('backend.reviews.show',compact('review'));

    }


    public function edit($id)
    {
        //
        $review =  Review::findOrFail($id);
        return view('backend.reviews.edit',compact('review'));
    }


    public function update(ReviewsRequest $request)
    {
        //
        try {
            $review =  Review::findOrFail($request->id);

            $review->update($request->validated());
            toastr()->success('Updated Successfully');
            return redirect()->to($request->page_url);

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
            $review =  Review::findOrFail($request->delete_review);

            $review->delete();
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
