@extends('layouts.admin')
@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Edit Category: <span class="text-danger">  {{$category->name}}</span></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                   class="default-color">Main</a></li>
                    <li class="breadcrumb-item active">Edit Category</li>
                </ol>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">

                <div class="card-body">


                    <form method="post" action="{{route('admin.categories.update')}}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" value="{{$category->id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Name :</label>

                                    <input type="text" name="name" class="form-control" value="{{old('name',$category->name)}}">

                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">Parent : </label>
                                    <br>
                                    <select class="form-control form-control-lg mb-15" name="parent_id">
                                        <option selected disabled> Choose... </option>
                                        <option value=""> --- </option>

                                        @foreach($main_categories as $main_category)
                                            <option value="{{$main_category->id}}" {{old('parent_id',$category->parent_id ) == $main_category->id ?'selected' : null}}>{{$main_category->name}}</option>
                                        @endforeach


                                    </select>
                                    @error('parent_id')
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
                                        <option value="1" {{old('status',$category->status) == '1' ? 'selected' : null}}>Active</option>
                                        <option value="0" {{old('status',$category->status) == '0' ? 'selected' : null}}>Inactive</option>

                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row pt-4">

                            <div class="col-12">

                                <label for="cover">Cover :</label>
                                <br>
                                <div class="file-loading">
                                    <input type="file"  name="cover" id="category-image" class="file-input-overview ">
                                    <span class="form-text text-muted">Image width should be 500px x 500px</span>

                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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

    <script>
        $(function (){

            $("#category-image").fileinput({

                theme: "fa",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview:[

                    "{{asset('images/productCategory/'.$category->cover)}}",

                ],
                initialPreviewAsData:true,
                initialPreviewFileType: 'image',
                initialPreviewConfig:[

                    {
                        caption: "{{$category->cover}}",
                        size:'1111',
                        width:"120px",
                        url:"{{route('admin.categories.removeImage',['category_id'=>$category->id, '_token'=>csrf_token()])}}",
                        key:{{$category->id}}
                    }
                ]



            });
        });

    </script>
@endsection
