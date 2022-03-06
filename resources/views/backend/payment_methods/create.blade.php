@extends('layouts.admin')
@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Add Payment Method</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                   class="default-color">Main</a></li>
                    <li class="breadcrumb-item active">Add Payment Method</li>
                </ol>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">

                <div class="card-body">


                    <form method="post" action="{{route('admin.payment_methods.store')}}" autocomplete="off" >
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Name :</label>

                                    <input type="text" name="name" class="form-control" value="{{old('name')}}">

                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Code :</label>

                                    <input type="text" name="code" class="form-control" value="{{old('code')}}">

                                    @error('code')
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
                                        <option value="1" {{old('status') == '1' ? 'selected' : null}}>Active</option>
                                        <option value="0" {{old('status') == '0' ? 'selected' : null}}>Inactive</option>

                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sandbox">Sandbox :</label>
                                    <br>
                                    <select class="form-control form-control-lg mb-15" name="sandbox">

                                        <option selected disabled> Choose...</option>
                                        <option value="1" {{old('sandbox') == '1' ? 'selected' : null}}>Sandbox</option>
                                        <option value="0" {{old('sandbox') == '0' ? 'selected' : null}}>Live</option>

                                    </select>
                                    @error('sandbox')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Merchant Email :</label>

                                    <input type="email" name="merchant_email" class="form-control" value="{{old('merchant_email')}}">

                                    @error('merchant_email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Client ID :</label>

                                    <input type="text" name="client_id" class="form-control" value="{{old('client_id')}}">

                                    @error('client_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                          <div class="col-md-6">
                                <div class="form-group">
                                    <label> Client Secret :</label>

                                    <input type="text" name="secret" class="form-control" value="{{old('secret')}}">

                                    @error('secret')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Sandbox Merchant Email :</label>

                                    <input type="email" name="merchant_email" class="form-control" value="{{old('merchant_email')}}">

                                    @error('merchant_email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Sandbox Client ID :</label>

                                    <input type="text" name="client_id" class="form-control" value="{{old('client_id')}}">

                                    @error('client_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                          <div class="col-md-6">
                                <div class="form-group">
                                    <label> Sandbox Client Secret :</label>

                                    <input type="text" name="secret" class="form-control" value="{{old('secret')}}">

                                    @error('secret')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>


                        <br>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Add Payment Method
                        </button>


                    </form>


                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')


@endsection
