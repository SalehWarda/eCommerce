@extends('layouts.admin')
@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Customers Addresses </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Customers Addresses </li>
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
                            <h5 class="card-title pb-0 border-0">Customers Addresses </h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-success icon left"

                                   href="{{route('admin.customers_addresses.create')}}">Add Address <i class="fa fa-plus"></i></a>
                            </div>

                        </div>

                    </div>

                        @include('backend.customers_addresses.filter.filter')
                    <div class="table-responsive mt-15">
                        <table class="table center-aligned-table mb-0">
                            <thead>
                            <tr class="text-dark">
                                <th>Customer</th>
                                <th>Title</th>
                                <th>Shipping Info</th>
                                <th>Location</th>
                                <th>Address</th>
                                <th>Zip code</th>
                                <th>POBox</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @forelse($addresses as $address)

                                    <td> <a class="text-primary" href="{{route('admin.customers_addresses.show',$address->id)}}">{{$address->user->full_name}}</a> </td>

                                    <td>
                                        <a class="text-primary" href="{{route('admin.customers_addresses.show',$address->id)}}">{{$address->address_title}}</a>
                                        <p class="text-gray-400"><b>{{$address->defaultAddress()}}</b></p>
                                    </td>

                                    <td>
                                        {{$address->first_name .' '. $address->last_name}}
                                        <p class="text-gray-400">{{$address->email}}<br/>{{$address->mobile}}</p>
                                    </td>
                                    <td>{{$address->country->name.' - '.$address->state->name.' - '.$address->city->name }}</td>
                                    <td>{{$address->address }}</td>
                                    <td>{{$address->zip_code}}</td>
                                    <td>{{$address->po_box}}</td>
                                    <td>
                                        <a href="{{route('admin.customers_addresses.edit',$address->id)}}"
                                           class="btn btn-info btn-sm" role="button" title="Edit" aria-pressed="true"><i
                                                class="fa fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#delete_address{{ $address->id }}" title="Delete"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                            </tr>

                            {{--delete Modal Category --}}
                            <div class="modal fade" id="delete_address{{ $address->id }}" tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title">
                                                <div class="mb-30">

                                                    <h6>Delete {{$address->address_title}}</h6>

                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form class="form" action="{{ route('admin.customers_addresses.delete') }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')

                                                <input type="hidden" name="delete_customer_address_id" value="{{$address->id}}" id="id">

                                                <h6>Are you sure about deleting this address?: <span class="text-danger">{{$address->address_title}}</span></h6>


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
                                    <td colspan="8" class="text-center">No Customers Addresses found</td>
                                </tr>




                            @endforelse





                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="8">
                                    <div class="float-right">

                                        {!! $addresses->appends(request()->all())->links() !!}

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
