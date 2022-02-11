@extends('layouts.admin')
@section('style')

    <link rel="stylesheet" href="{{asset('backend/vendor/select-2/css/select2.min.css')}}">
@endsection
@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Edit review on product: <span class="text-danger">{{$review->product->name}}</span></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                   class="default-color">Main</a></li>
                    <li class="breadcrumb-item active">Edit Review</li>
                </ol>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">

                <div class="card-body">


                    <form method="post" action="{{route('admin.reviews.update')}}" autocomplete="off">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" value="{{$review->id}}">
                        <input type="hidden" name="page_url" value="{{\Illuminate\Support\Facades\URL::previous()}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Name:</label>

                                    <input type="text" name="name" class="form-control"
                                           value="{{old('name',$review->name)}}">

                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Email:</label>

                                    <input type="text" name="email" class="form-control"
                                           value="{{old('email',$review->email)}}">

                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Rating :</label>
                                    <br>
                                    <select class="form-control form-control-lg mb-15" name="rating">

                                        <option value="1" {{old('rating',$review->rating) == '1' ? 'selected' : null}}>
                                            1
                                        </option>
                                        <option value="2" {{old('rating',$review->rating) == '2' ? 'selected' : null}}>
                                            2
                                        </option>
                                        <option value="3" {{old('rating',$review->rating) == '3' ? 'selected' : null}}>
                                            3
                                        </option>
                                        <option value="4" {{old('rating',$review->rating) == '4' ? 'selected' : null}}>
                                            4
                                        </option>
                                        <option value="5" {{old('rating',$review->rating) == '5' ? 'selected' : null}}>
                                            5
                                        </option>


                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="product_id">Product:</label>
                                    <br>
                                    <input type="text" class="form-control" readonly value="{{$review->product->name}}">
                                    <input type="hidden" class="form-control" readonly name="product_id"
                                           value="{{$review->product_id}}">
                                    @error('product_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="product_id">Customer:</label>
                                    <br>
                                    <input type="text" class="form-control" readonly
                                           value="{{$review->user_id != '' ? $review->user->full_name : ''}}">
                                    <input type="hidden" class="form-control" readonly name="user_id"
                                           value="{{$review->user_id ?? ''}}">
                                    @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status :</label>
                                    <br>
                                    <select class="form-control form-control-lg mb-15" name="status">

                                        <option selected disabled> Choose...</option>
                                        <option value="1" {{old('status',$review->status) == 1 ? 'selected' : null}}>
                                            Active
                                        </option>
                                        <option value="0" {{old('status',$review->status) == 0 ? 'selected' : null}}>
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

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title"> Title :</label>

                                    <input type="text" name="title" class="form-control"
                                           value="{{old('title',$review->title)}}">

                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message"> Message :</label>

                                    <textarea  name="message" class="form-control"
                                           >{!! old('message',$review->message) !!}</textarea>


                                    @error('message')
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


