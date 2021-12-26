<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductsRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use PHPUnit\Exception;

class ProductsController extends Controller
{

    public function index()
    {
        //
         $products = Product::with('category','tags','firstMedia')
             ->when(\request()->keyword != null ,function ($query){

                 $query->search(\request()->keyword);
             })
             ->when(\request()->status != null ,function ($query){

                 $query->whereStatus(\request()->status);
             })
             ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
             ->paginate(\request()->limit_by ?? 10);

         return view('backend.products.index',compact('products'));
    }


    public function create()
    {
        //
        $categories = ProductCategory::whereStatus(1)->get(['id','name']);
        $tags = Tag::whereStatus(1)->get(['id','name']);
        return view('backend.products.create',compact('categories','tags'));
    }


    public function store(ProductsRequest $request)
    {
        //
        $input['name'] = $request->name;
        $input['description'] = $request->description;
        $input['product_category_id'] = $request->product_category_id;
        $input['status'] = $request->status;
        $input['quantity'] = $request->quantity;
        $input['price'] = $request->price;
        $input['featured'] = $request->featured;

        $products = Product::create($input);
        $products->tags()->attach($request->tags);

        $i=1;
        if($request->images && count($request->images) > 0){
            foreach ($request->images as $image){

                $fie_name = $products->slug.'_'.time().'_'.$i.'.'.$image->getClientOriginalExtension();
                $file_size= $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('/images/products/'.$fie_name);
                Image::make($image->getRealPath())->resize(500,null,function ($constraint){
                    $constraint->aspectRatio();
                })->save($path,100);

                $products->media()->create([
                   'file_name' => $fie_name,
                'file_size' => $file_size,
                    'file_type'=>$file_type,
                    'file_status'=>true,
                    'file_sort'=>$i,
                ]);
                $i++;

            }
            toastr()->success('Created Successfully');
            return redirect()->route('admin.products');


        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);
        $categories = ProductCategory::whereStatus(1)->get(['id','name']);
        $tags = Tag::whereStatus(1)->get(['id','name']);
              return view('backend.products.edit',compact('product','categories','tags'));
    }


    public function update(ProductsRequest $request)
    {



        $products = Product::findOrFail($request->id);
        $input['name'] = $request->name;
        $input['description'] = $request->description;
        $input['product_category_id'] = $request->product_category_id;
        $input['status'] = $request->status;
        $input['quantity'] = $request->quantity;
        $input['price'] = $request->price;
        $input['featured'] = $request->featured;

        $products->update($input);
        $products->tags()->sync($request->tags);


        $i= $products->media()->count() +1;
        if($request->images && count($request->images) > 0){
            foreach ($request->images as $image){

                $fie_name = $products->slug.'_'.time().'_'.$i.'.'.$image->getClientOriginalExtension();
                $file_size= $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('/images/products/'.$fie_name);
                Image::make($image->getRealPath())->resize(500,null,function ($constraint){
                    $constraint->aspectRatio();
                })->save($path,100);

                $products->media()->create([
                    'file_name' => $fie_name,
                    'file_size' => $file_size,
                    'file_type'=>$file_type,
                    'file_status'=>true,
                    'file_sort'=>$i,
                ]);
                $i++;

            }



        }

        toastr()->success('Updated Successfully');
        return redirect()->route('admin.products');


    }


    public function destroy(Request $request)
    {
        //

        try {
            $product = Product::findOrFail($request->delete_product_id);

            if ($product->media()->count() > 0){

                foreach ($product->media as $media){

                    if (File::exists('images/products/' . $media->file_name)) {

                        unlink('images/products/' . $media->file_name);

                    }
                    $media->delete();

                }





            }

            $product->delete();
            toastr()->error('Deleted Successfully');
            return redirect()->route('admin.products');

        }catch (\Exception $ex){

            return redirect()->back()->with([
                'message' => $ex->getMessage(),
                'alert-type' => 'danger',

            ]);
        }
    }

    public function removeImage(Request $request)
    {


        $product = Product::findOrFail($request->product_id);
        $image = $product->media()->whereId($request->image_id)->first();
        if (File::exists('images/products/' . $image->file_name)) {

            unlink('images/products/' . $image->file_name);

        }

        $image->delete();
        return true;
    }
}
