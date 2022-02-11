@extends('layouts.admin')
@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Customers </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Customers</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- main body -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif


                    <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block">
                            <h5 class="card-title pb-0 border-0">Customers</h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-success icon left"

                                   href="{{route('admin.customers.create')}}">Add new Customer <i class="fa fa-plus"></i></a>
                            </div>

                        </div>

                    </div>

                        @include('backend.customers.filter.filter')
                    <div class="table-responsive mt-15">
                        <table class="table center-aligned-table mb-0">
                            <thead>
                            <tr class="text-dark">
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email & Mobile</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @forelse($customers as $customer)


                                    <td>
                                        @if($customer->user_image != '')
                                            <img src="{{asset('images/users/'.$customer->user_image)}}" width="60" height="60" alt="{{$customer->full_name}}">
                                            @else
                                           <img src="{{asset('images/users/avatar.png')}}" width="60" height="60" alt="{{$customer->name}}">
                                        @endif

                                        </td>
                                    <td>{{$customer->full_name}}
                                        <strong>{{$customer->username}}</strong>
                                    </td>
                                    <td>{{$customer->email}}<br>
                                        {{$customer->mobile}}
                                    </td>

                                    <td>{{$customer->status() }}</td>
                                    <td>{{$customer->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{route('admin.customers.edit',$customer->id)}}"
                                           class="btn btn-info btn-sm" role="button" title="Edit" aria-pressed="true"><i
                                                class="fa fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#delete_customer{{ $customer->id }}" title="Delete"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                            </tr>

                            {{--delete Modal Product --}}
                            <div class="modal fade" id="delete_customer{{ $customer->id }}" tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title">
                                                <div class="mb-30">

                                                    <h6>Delete {{$customer->full_name}}</h6>

                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form class="form" action="{{ route('admin.customers.delete') }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')

                                                <input type="hidden" name="delete_customer" value="{{$customer->id}}" id="id">

                                                <h6>Are you sure about deleting: <span class="text-danger">{{$customer->full_name}}</span></h6>


                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit"
                                                            class="btn btn-danger">Delete</button>

                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No products found</td>
                                </tr>




                            @endforelse





                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="float-right">

                                        {!! $customers->appends(request()->all())->links() !!}

                                    </div>

                                </td>
                            </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>


@endsection
