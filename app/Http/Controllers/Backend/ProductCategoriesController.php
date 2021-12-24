<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductsCategoriesRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Image;
use Yoeunes\Toastr\Toastr;

class ProductCategoriesController extends Controller
{

    public function index()
    {
        $categories = ProductCategory::withCount('products')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {

                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.productCategories.index', compact('categories'));
    }


    public function create()
    {
        //
        $main_categories = ProductCategory::whereNull('parent_id')->get(['id', 'name']);
        return view('backend.productCategories.createProduct', compact('main_categories'));

    }


    public function store(ProductsCategoriesRequest $request)
    {

        try {


            $input['name'] = $request->name;
            $input['status'] = $request->status;
            $input['parent_id'] = $request->parent_id;


            if ($image = $request->file('cover')) {
                $file_name = Str::slug($request->name) . "." . $image->getClientOriginalExtension();
                $path = public_path('/images/productCategory/' . $file_name);

                \Intervention\Image\Facades\Image::make($image->getRealPath())->resize(500, null, function ($constraint) {

                    $constraint->aspectRatio();
                })->save($path, 100);

                $input['cover'] = $file_name;

            }


            ProductCategory::create($input);

            toastr()->success('Created Successfully');
            return redirect()->back();

        } catch (\Exception $ex) {

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
        $category = ProductCategory::findOrFail($id);
        $main_categories = ProductCategory::whereNull('parent_id')->get(['id', 'name']);


        return view('backend.productCategories.editProduct', compact('main_categories', 'category'));


    }


    public function update(ProductsCategoriesRequest $request)
    {


        try {
            $category = ProductCategory::findOrFail($request->id);

            $input['name'] = $request->name;
            $input['slug'] = null;
            $input['status'] = $request->status;
            $input['parent_id'] = $request->parent_id;


            if ($image = $request->file('cover')) {

                if ($category->cover != null && File::exists('images/productCategory/' . $category->cover)) {

                    unlink('images/productCategory/' . $category->cover);
                }

                $file_name = Str::slug($request->name) . "." . $image->getClientOriginalExtension();
                $path = public_path('/images/productCategory/' . $file_name);

                \Intervention\Image\Facades\Image::make($image->getRealPath())->resize(500, null, function ($constraint) {

                    $constraint->aspectRatio();
                })->save($path, 100);

                $input['cover'] = $file_name;

            }


            $category->update($input);

            toastr()->success('Updated Successfully');
            return redirect()->back();

        } catch (\Exception $ex) {

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

            $category = ProductCategory::findOrFail($request->delete_cataegory_id);

            if ($category->cover != null && File::exists('images/productCategory/' . $category->cover)) {
                unlink('images/productCategory/' . $category->cover);
            }
            $category->delete();

            toastr()->error('Deleted Successfully');
            return redirect()->back();

        } catch (\Exception $ex) {

            return redirect()->back()->with([
                'message' => $ex->getMessage(),
                'alert-type' => 'danger',

            ]);

        }

    }

    public function removeImage(Request $request)
    {


        $category = ProductCategory::findOrFail($request->category_id);
        if (File::exists('images/productCategory/' . $category->cover)) {

            unlink('images/productCategory/' . $category->cover);
            $category->cover = null;
            $category->save();

        }
        return true;
    }


}
