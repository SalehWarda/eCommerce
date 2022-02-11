@extends('layouts.admin')
@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Edit City: <span class="text-danger">  {{$cities->name}}</span></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                   class="default-color">Main</a></li>
                    <li class="breadcrumb-item active">Edit City</li>
                </ol>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">

                <div class="card-body">


                    <form method="post" action="{{route('admin.cities.update')}}" autocomplete="off" >
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" value="{{$cities->id}}">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Name :</label>

                                    <input type="text" name="name" class="form-control" value="{{old('name',$cities->name)}}">

                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="state_id">State :</label>
                                    <br>
                                    <select class="form-control form-control-lg mb-15" name="state_id">

                                        <option selected disabled> Choose...</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}" {{old('state_id',$cities->state_id) == $state->id ? 'selected' : null}}>
                                                {{$state->name}}</option>

                                        @endforeach

                                    </select>
                                    @error('state_id')
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
                                        <option value="1" {{old('status',$cities->status) == '1' ? 'selected' : null}}>Active</option>
                                        <option value="0" {{old('status',$cities->status) == '0' ? 'selected' : null}}>Inactive</option>

                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>


                        <br>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Save Changes
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
                overwriteInitial: false



            })
        })

    </script>
@endsection
