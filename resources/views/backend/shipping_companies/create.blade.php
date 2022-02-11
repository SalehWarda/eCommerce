@extends('layouts.admin')
@section('style')

    <link rel="stylesheet" href="{{asset('backend/vendor/select-2/css/select2.min.css')}}">
@endsection
@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Add Shipping Company</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                   class="default-color">Main</a></li>
                    <li class="breadcrumb-item active">Add Shipping Company</li>
                </ol>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">

                <div class="card-body">


                    <form method="post" action="{{route('admin.shipping_companies.store')}}" autocomplete="off">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name"> Name:</label>

                                    <input type="text" name="name" class="form-control" value="{{old('name')}}">

                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="code"> Code:</label>

                                    <input type="text" name="code" class="form-control" value="{{old('code')}}">

                                    @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                          <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description"> Description:</label>

                                    <input type="text" name="description" class="form-control" value="{{old('description')}}">

                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fast">Fast :</label>
                                    <br>
                                    <select class="form-control form-control-lg mb-15" name="fast">

                                        <option selected disabled> Choose...</option>
                                        <option value="1" {{old('fast') == '1' ? 'selected' : null}}>Yes</option>
                                        <option value="0" {{old('fast') == '0' ? 'selected' : null}}>No</option>

                                    </select>
                                    @error('fast')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cost"> Cost:</label>

                                    <input type="text" name="cost" class="form-control"
                                           value="{{old('cost')}}">

                                    @error('cost')
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
                                        <option value="1" {{old('status') == '1' ? 'selected' : null}}>Active</option>
                                        <option value="0" {{old('status') == '0' ? 'selected' : null}}>Inactive</option>

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
                                    <label for="countries"> Countries:</label>

                                    <select class="form-control select-multiple_tags"  name="countries[]" multiple="multiple">

                                        <option value=""> ---</option>
                                        @foreach($countries as $country)
                                            <option
                                                value="{{$country->id}}" {{ in_array($country->id ,old('countries',[])) ? 'selected' : null}}>{{$country->name}}</option>

                                        @endforeach

                                    </select>
                                    @error('countries')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>





                        </div>




                        <br>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Add Shipping Company </button>


                    </form>



            </div>
        </div>
    </div>


@endsection


@section('script')

            <script src="{{asset('backend/vendor/select-2/js/select2.full.min.js')}}"></script>
            <script>
                $(function (){



                    function matchStart(params, data) {
                        // If there are no search terms, return all of the data
                        if ($.trim(params.term) === '') {
                            return data;
                        }

                        // Skip if there is no 'children' property
                        if (typeof data.children === 'undefined') {
                            return null;
                        }

                        // `data.children` contains the actual options that we are matching against
                        var filteredChildren = [];
                        $.each(data.children, function (idx, child) {
                            if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                                filteredChildren.push(child);
                            }
                        });

                        // If we matched any of the timezone group's children, then set the matched children on the group
                        // and return the group object
                        if (filteredChildren.length) {
                            var modifiedData = $.extend({}, data, true);
                            modifiedData.children = filteredChildren;

                            // You can return modified objects from here
                            // This includes matching the `children` how you want in nested data sets
                            return modifiedData;
                        }

                        // Return `null` if the term should not be displayed
                        return null;
                    }

                    $(".select-multiple_tags").select2({

                        minimumResultsForSearch: Infinity,
                        tags:true,
                        closeOnSelect: false,
                        matcher: matchStart
                    });



                })

            </script>
@endsection
