@extends('layouts.admin')
@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Edit Address</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                   class="default-color">Main</a></li>
                    <li class="breadcrumb-item active">Edit Address</li>
                </ol>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">

                <div class="card-body">


                    <form method="post" action="{{route('admin.customers_addresses.update')}}" autocomplete="off">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" value="{{$addresses->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="customer_name"> Customer :</label>

                                    <input type="text" name="customer_name" class="form-control typeahead"
                                           id="customer_name"
                                           value="{{$addresses->user->full_name}}" readonly>
                                    <input type="hidden" name="user_id" class="form-control" readonly id="user_id"
                                           value="{{$addresses->user_id}}">

                                    @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="address_title"> Address Title :</label>

                                    <input type="text" name="address_title" class="form-control "
                                           value="{{old('address_title',$addresses->address_title)}}">

                                    @error('address_title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="default_address"> Default Address :</label>

                                    <select class="form-control form-control-lg mb-15" name="default_address">

                                        <option value=""> ---</option>
                                        <option value="1" {{old('default_address',$addresses->default_address) == '1' ? 'selected' : null}}>Yes
                                        </option>
                                        <option value="0" {{old('default_address',$addresses->default_address) == '0' ? 'selected' : null}}>No
                                        </option>

                                    </select>
                                    @error('default_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="first_name"> First Name :</label>

                                    <input type="text" name="first_name" class="form-control"
                                           value="{{old('first_name',$addresses->first_name)}}">

                                    @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="last_name"> Last Name :</label>

                                    <input type="text" name="last_name" class="form-control"
                                           value="{{old('last_name',$addresses->last_name)}}">

                                    @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="email"> Email :</label>

                                    <input type="text" name="email" class="form-control" value="{{old('email',$addresses->email)}}">

                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="mobile"> Mobile :</label>

                                    <input type="text" name="mobile" class="form-control" value="{{old('mobile',$addresses->mobile)}}">

                                    @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>


                        <div class="row">


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="country_id"> Country :</label>

                                    <select class="form-control form-control-lg mb-15" id="country_id" name="country_id">

                                        <option value=""> ---</option>
                                        @foreach($countries as $country)
                                            <option
                                                value="{{$country->id}}" {{old('country_id',$addresses->country_id) == $country->id ? 'selected' : null}}>{{$country->name}}</option>

                                        @endforeach

                                    </select>
                                    @error('country_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="state_id"> State :</label>

                                    <select class="form-control form-control-lg mb-15" id="state_id" name="state_id">

                                        <option
                                            value="{{$addresses->state_id}}" {{old('state_id',$addresses->state_id) == $addresses->state_id ? 'selected' : null}}>{{$addresses->state->name}}</option>

                                    </select>
                                    @error('state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="city_id"> City :</label>

                                    <select class="form-control form-control-lg mb-15" id="city_id" name="city_id">

                                        <option  value="{{$addresses->city_id}}" {{old('city_id',$addresses->city_id) == $addresses->city_id ? 'selected' : null}}>{{$addresses->city->name}}</option>

                                    </select>
                                    @error('city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="address"> Address :</label>

                                    <input type="text" name="address" class="form-control" value="{{old('address',$addresses->address)}}">

                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="address2"> Address2 :</label>

                                    <input type="text" name="address2" class="form-control" value="{{old('address2',$addresses->address2)}}">

                                    @error('address2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="zip_code"> ZIP Code :</label>

                                    <input type="text" name="zip_code" class="form-control" value="{{old('zip_code',$addresses->zip_code)}}">

                                    @error('zip_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="po_box"> P.O.Box :</label>

                                    <input type="text" name="po_box" class="form-control" value="{{old('po_box',$addresses->po_box)}}">

                                    @error('po_box')
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


        @endsection


        @section('script')

            <script src="{{asset('backend/vendor/Typeahead/bootstrap3-typeahead.min.js')}}"></script>
            <script>

                $(function () {

                    $(".typeahead").typeahead({

                        autoSelect: true,
                        minLength: 3,
                        delay: 400,
                        displayText: function (item) {
                            return item.full_name + ' - ' + item.email;
                        },
                        source: function (query, process) {
                            return $.get("{{route('admin.customers.get_customers')}}", {'query': query}, function (data) {
                                return process(data);
                            });
                        },
                        afterSelect: function (data) {
                            $('#user_id').val(data.id);
                        }
                    });





                    {{-- populateStates();--}}
                    {{-- populateCities();--}}


                    {{-- $("#country_id").change(function (){--}}

                    {{--     populateStates();--}}
                    {{--     populateCities();--}}

                    {{--     return false;--}}
                    {{-- });--}}


                    {{--$("#state_id").change(function (){--}}

                    {{--     populateCities();--}}

                    {{--     return false;--}}
                    {{-- });--}}

                    {{-- function populateStates()--}}
                    {{-- {--}}

                    {{--     let countryIdVal = $('#country_id').val() != null ? $('#country_id').val() : '{{old('country_id')}}';--}}
                    {{--     $.get("{{route('admin.states.get_states')}}", {country_id: countryIdVal}, function(data){--}}
                    {{--         $('option', $('#state_id')).remove();--}}
                    {{--         $('#state_id').append($('<option></option>').val('').html('---'));--}}
                    {{--         $.each(data, function(val, text){--}}
                    {{--             let selectedVal = val == '{{old('state_id')}}' ? "selected" : "";--}}
                    {{--             $("state_id").append($('<option'+ selectedVal + '></option>').val(val).html(text));--}}
                    {{--         });--}}

                    {{--     }, "json");--}}
                    {{-- }--}}

                    {{-- function populateCities()--}}
                    {{-- {--}}

                    {{--     let stateIdVal = $('#state_id').val() != null ? $('#state_id').val() : '{{old('state_id')}}';--}}
                    {{--     $.get("{{route('admin.cities.get_cities')}}", {state_id: stateIdVal}, function(data){--}}
                    {{--         $('option', $('#city_id')).remove();--}}
                    {{--         $('#city_id').append($('<option></option>').val('').html('---'));--}}
                    {{--         $.each(data, function(val, text){--}}
                    {{--             let selectedVal = val == '{{old('city_id')}}' ? "selected" : "";--}}
                    {{--             $('city_id').append($('<option'+ selectedVal + '></option>').val(val).html(text));--}}
                    {{--         });--}}

                    {{--     }, "json");--}}

                    {{-- }--}}



                });

            </script>

            <script>
                $(document).ready(function () {
                    $('select[name="country_id"]').on('change', function () {
                        var country_id = $(this).val();
                        if (country_id) {
                            $.ajax({
                                url: "{{ URL::to('admin/customers_addresses/get_states') }}/" + country_id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('select[name="state_id"]').empty();
                                    $('select[name="state_id"]').append('<option selected disabled >Choose...</option>');

                                    $.each(data, function (key, value) {
                                        $('select[name="state_id"]').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                },
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });
            </script>

            <script>
                $(document).ready(function () {
                    $('select[name="state_id"]').on('change', function () {
                        var state_id = $(this).val();
                        if (state_id) {
                            $.ajax({
                                url: "{{ URL::to('admin/customers_addresses/get_cities') }}/" + state_id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('select[name="city_id"]').empty();
                                    $('select[name="city_id"]').append('<option selected disabled >Choose...</option>');

                                    $.each(data, function (key, value) {
                                        $('select[name="city_id"]').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                },
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });
            </script>

@endsection
