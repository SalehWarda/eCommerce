@extends('layouts.admin')
@section('style')

    <link rel="stylesheet" href="{{asset('backend/vendor/select-2/css/select2.min.css')}}">
@endsection
@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Edit <span class="text-danger">{{$product->name}}</span></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                   class="default-color">Main</a></li>
                    <li class="breadcrumb-item active">Edit Product</li>
                </ol>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">

                <div class="card-body">


                    <form method="post" action="{{route('admin.products.update')}}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input type="hidden" name="page_url" value="{{\Illuminate\Support\Facades\URL::previous()}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Name :</label>

                                    <input type="text" name="name" class="form-control"
                                           value="{{old('name',$product->name)}}">

                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="product_category_id">Category : </label>
                                    <br>
                                    <select class="form-control form-control-lg mb-15" name="product_category_id">
                                        <option selected disabled> Choose...</option>

                                        <option value=""> ---</option>

                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id}}" {{old('product_category_id',$product->product_category_id) == $category->id ?'selected' : null}}>{{$category->name}}</option>
                                        @endforeach


                                    </select>
                                    @error('product_category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status">Status :</label>
                                    <br>
                                    <select class="form-control form-control-lg mb-15" name="status">

                                        <option selected disabled> Choose...</option>
                                        <option value="1" {{old('status',$product->status) == 1 ? 'selected' : null}}>
                                            Active
                                        </option>
                                        <option value="0" {{old('status',$product->status) == 0 ? 'selected' : null}}>
                                            Inactive
                                        </option>

                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description"> Description :</label>

                                    <textarea name="description" rows="3"
                                              class="form-control summernote">{!! old('description',$product->description) !!}</textarea>

                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Quantity :</label>

                                    <input type="text" name="quantity" class="form-control"
                                           value="{{old('quantity',$product->quantity)}}">

                                    @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Price :</label>

                                    <input type="number" name="price" class="form-control"
                                           value="{{old('price',$product->price)}}">

                                    @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="featured">Featured :</label>
                                    <br>
                                    <select class="form-control form-control-lg mb-15" name="featured">

                                        <option selected disabled> Choose...</option>
                                        <option
                                            value="1" {{old('featured',$product->featured) == 1 ? 'selected' : null}}>
                                            Yes
                                        </option>
                                        <option
                                            value="0" {{old('featured',$product->featured) == 0 ? 'selected' : null}}>No
                                        </option>

                                    </select>
                                    @error('featured')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tags">Tags : </label>
                                    <br>
                                    <select class="form-control form-control-lg mb-15 select-2" multiple="multiple"
                                            name="tags[]">

                                        <option value=""> ---</option>

                                        @forelse($tags as $tag)
                                            <option
                                                value="{{$tag->id}}" {{in_array($tag->id,$product->tags->pluck('id')->toArray()) ? 'selected' : ''}}>{{$tag->name}}</option>
                                        @empty
                                        @endforelse


                                    </select>
                                    @error('tags')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row pt-4">

                            <div class="col-12">

                                <label for="images">Images :</label>
                                <br>
                                <div class="file-loading">
                                    <input type="file" name="images[]" id="product_images" class="file-input-overview"
                                           multiple="multiple">
                                    <span class="form-text text-muted">Image width should be 500px x 500px</span>


                                </div>
                                @error('images')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <br>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Save
                        </button>


                    </form>


                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')

    <script src="{{asset('backend/vendor/select-2/js/select2.full.min.js')}}"></script>
    <script>
        $(function () {


            function matchCustom(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Do not display the item if there is no 'text' property
                if (typeof data.text === 'undefined') {
                    return null;
                }

                // `params.term` should be the term that is used for searching
                // `data.text` is the text that is displayed for the data object
                if (data.text.indexOf(params.term) > -1) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.text += ' (matched)';

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            }

            $(".select-2").select2({
                tags: true,
                closeOnSelect: false,
                minimumResultForSearch: Infinity,
                matcher: matchCustom

            });


            $('.summernote').summernote({

                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });


            $("#product_images").fileinput({

                theme: "fa",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,

                initialPreview: [

                    @if($product->media()->count() > 0)

                        @foreach($product->media as $media)

                        "{{asset('images/products/'.$media->file_name)}}",
                    @endforeach

                    @endif

                ],

                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [

                        @if($product->media()->count() > 0)

                            @foreach($product->media as $media)

                               {
                                  caption: "{{$media->file_name}}",
                                  size: '{{$media->file_size}}',
                                  width: "120px",
                                  url: "{{route('admin.products.removeImage',['image_id'=>$media->id, 'product_id'=>$product->id, '_token'=>csrf_token()])}}",
                                  key: {{$media->id}},
                                },

                            @endforeach

                        @endif

                ]


            }).on('filesorted', function (event, params) {

                console.log(params.previewId, params.oldIndex, params.newIndex, params.stack);
            });
        });

    </script>
@endsection
