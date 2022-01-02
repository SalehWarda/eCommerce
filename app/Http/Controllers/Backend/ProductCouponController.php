<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCouponRequest;
use App\Models\Product;
use App\Models\ProductCoupon;
use Illuminate\Http\Request;

class ProductCouponController extends Controller
{

    public function index()
    {
        //
        $coupons =ProductCoupon::query()
            ->when(\request()->keyword != null , function ($query){

                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query){

                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.coupons.index',compact('coupons'));
    }


    public function create()
    {
        //
        return view('backend.coupons.create');
    }


    public function store(ProductCouponRequest $request)
    {
        //
        try {

           ProductCoupon::create($request->validated());

            toastr()->success('Created Successfully');
            return redirect()->route('admin.coupons');

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



            $coupons = ProductCoupon::findOrFail($id);

            return view('backend.coupons.edit',compact('coupons'));





    }


    public function update(ProductCouponRequest $request)
    {
        try {

            $coupons = ProductCoupon::findOrFail($request->coupon_id);

            $coupons->update($request->validated());

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
        try {

            $coupon = ProductCoupon::findOrFail($request->delete_product_id);
            $coupon->delete();

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
