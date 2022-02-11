@extends('layouts.admin')
@section('style')

    <link rel="stylesheet" href="{{asset('backend/vendor/select-2/css/select2.min.css')}}">
@endsection
@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Edit Customer <span class="text-danger">{{$customer->username}}</span></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                   class="default-color">Main</a></li>
                    <li class="breadcrumb-item active">Edit Customer</li>
                </ol>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">

                <div class="card-body">


                    <form method="post" action="{{route('admin.customers.update')}}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" value="{{$customer->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> First Name :</label>

                                    <input type="text" name="first_name" class="form-control"
                                           value="{{old('first_name',$customer->first_name)}}">

                                    @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Last Name :</label>

                                    <input type="text" name="last_name" class="form-control"
                                           value="{{old('last_name',$customer->last_name)}}">

                                    @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> User Name :</label>

                                    <input type="text" name="username" class="form-control"
                                           value="{{old('username',$customer->username)}}">

                                    @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Mobile :</label>

                                    <input type="text" name="mobile" class="form-control"
                                           value="{{old('mobile',$customer->mobile)}}">

                                    @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Email :</label>

                                    <input type="text" name="email" class="form-control"
                                           value="{{old('email',$customer->email)}}">

                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Passworde :</label>

                                    <input type="password" name="password" class="form-control"
                                           value="{{old('password',$customer->password)}}">

                                    @error('password')
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
                                        <option
                                            value="1" {{old('status',$customer->status) == '1' ? 'selected' : null}}>
                                            Active
                                        </option>
                                        <option
                                            value="0" {{old('status',$customer->status) == '0' ? 'selected' : null}}>
                                            Inactive
                                        </option>

                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>


                            <div class="col-md-3"></div>

                        </div>


                        <div class="row pt-4">

                            <div class="col-12">

                                <label for="images">Image :</label>
                                <br>
                                <div class="file-loading">
                                    <input type="file" name="user_image" id="customer_image" class="file-input-overview"
                                           multiple="multiple">
                                    <span class="form-text text-muted">Image width should be 500px x 500px</span>


                                </div>
                                @error('user_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <br>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Update Customer
                        </button>


                    </form>


                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')

    <script>
        $(function () {

            $("#customer_image").fileinput({

                theme: "fa",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [

                        @if($customer->user_image != '')


                        "{{asset('images/users/'.$customer->user_image)}}",


                    @endif


                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [

                        @if($customer->user_image != ''){




                             caption: "{{$customer->user_image}}",
                             size: '1111',
                             width: "120px",
                             url: "{{route('admin.customers.removeImage',['customer_id'=>$customer->id, '_token'=>csrf_token()])}}",
                             key: {{$customer->id}}


                    }
                    @endif
                ]

            });

        });

    </script>
@endsection
