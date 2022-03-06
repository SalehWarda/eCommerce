<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodContrller extends Controller
{

    public function index()
    {
        //
        $payment_methods = PaymentMethod::query()
            ->when(\request()->keyword != null ,function ($query){

                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null , function ($query){

                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.payment_methods.index', compact('payment_methods'));


    }


    public function create()
    {
        //

        return view('backend.payment_methods.create');
    }


    public function store(PaymentMethodRequest $request)
    {
        //
        try {
//
//            $input['name'] = $request->name;
//            $input['status'] = $request->status;
//            Tag::create([$input]);

            PaymentMethod::create($request->validated());

            toastr()->success('Created Successfully');
            return redirect()->route('admin.payment_methods');

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
        $payment_methods = PaymentMethod::findOrFail($id);
        return view('backend.payment_methods.edit',compact('payment_methods'));
    }


    public function update(PaymentMethodRequest $request)
    {
        try {
            $payment_methods = PaymentMethod::findOrFail($request->id);


            $payment_methods->update($request->validated());


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

            $payment_methods = PaymentMethod::findOrFail($request->delete_payment_method_id);
            $payment_methods->delete();

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
