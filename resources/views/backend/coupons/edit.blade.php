@extends('layouts.admin')


@section('style')
    <link rel="stylesheet" href="{{asset('backend/vendor/datepick/themes/classic.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor/datepick/themes/classic.date.css')}}">

    <style>
        .picker__select--month, .picker__select--year{

            padding: 0 !important;
        }
    </style>
@endsection

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Edit Coupon: <span class="text-danger">{{$coupons->code}}</span></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                   class="default-color">Main</a></li>
                    <li class="breadcrumb-item active">Edit Coupon</li>
                </ol>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">

                <div class="card-body">


                    <form method="post" action="{{route('admin.coupons.update')}}" autocomplete="off">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="coupon_id" value="{{$coupons->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Code :</label>

                                    <input type="text" name="code" id="code" class="form-control" value="{{old('code',$coupons->code)}}">

                                    @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="type">Type : </label>
                                    <br>
                                    <select class="form-control form-control-lg mb-15" name="type">
                                        <option selected disabled> Choose...</option>


                                        <option value="fixed" {{old('type',$coupons->type) == 'fixed' ?'selected' : null}}>Fixed
                                        </option>
                                        <option value="percentage" {{old('type',$coupons->type) == 'percentage' ?'selected' : null}}>
                                            Percentage
                                        </option>


                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Value :</label>

                                    <input type="number" name="value" class="form-control" value="{{old('value',$coupons->value)}}">

                                    @error('value')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Use Times :</label>

                                    <input type="number" name="use_times" class="form-control"
                                           value="{{old('use_times',$coupons->use_times)}}">

                                    @error('use_times')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Start date :</label>

                                    <input type="text" name="start_date" id="start_date" class="form-control"
                                           value="{{old('start_date',$coupons->start_date->format('Y-m-d'))}}">

                                    @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Expire date :</label>

                                    <input type="text" name="expire_date" id="expire_date" class="form-control"
                                           value="{{old('expire_date',$coupons->expire_date->format('Y-m-d'))}}">

                                    @error('expire_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Greater than :</label>

                                    <input type="number" name="greater_than" class="form-control"
                                           value="{{old('greater_than',$coupons->greater_than)}}">

                                    @error('greater_than')
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
                                        <option value="1" {{old('status',$coupons->status) == '1' ? 'selected' : null}}>Active</option>
                                        <option value="0" {{old('status',$coupons->status) == '0' ? 'selected' : null}}>Inactive</option>

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
                                    <label> Description :</label>

                                    <textarea name="description" rows="3" id="description" class="form-control">

                                     {!!old('description',$coupons->description)!!}
                                 </textarea>

                                    @error('description')
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

    <script src="{{asset('backend/vendor/datepick/picker.js')}}"></script>
    <script src="{{asset('backend/vendor/datepick/picker.date.js')}}"></script>

    <script>
        $(function () {

            $('#code').keyup(function (){

                this.value = this.value.toUpperCase();

            });

            $('#start_date').pickadate({

                format: 'yyyy-mm-dd',
                selectMonths: true,
                selectYears: true,
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true,
            });
            var startdate = $('#start_date').pickadate('picker');
            var enddate = $('#expire_date').pickadate('picker');

            $('#start_date').change(function () {


                selected_ci_date = "";
                selected_ci_date = $('#start_date').val();
                if (selected_ci_date != null) {

                    var cidate = new Date(selected_ci_date);
                    min_codate = "";
                    min_codate = new Data();
                    min_codate.setData(cidate.getDate() + 1);
                    enddate.set('min', min_codate);
                }

            });




            $('#expire_date').pickadate({

                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true,
                selectYears: true,
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true,
            });


        });


    </script>
@endsection
