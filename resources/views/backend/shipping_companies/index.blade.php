@extends('layouts.admin')
@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Shipping Companies</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Shipping Companies</li>
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
                            <h5 class="card-title pb-0 border-0">Shipping Companies</h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-success icon left"

                                   href="{{route('admin.shipping_companies.create')}}">Add Shipping Company <i
                                        class="fa fa-plus"></i></a>
                            </div>

                        </div>

                    </div>

                    @include('backend.shipping_companies.filter.filter')
                    <div class="table-responsive mt-15">
                        <table class="table center-aligned-table mb-0">
                            <thead>
                            <tr class="text-dark">
                                <th>Name</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Fast</th>
                                <th>Cost</th>
                                <th>Countries Count</th>
                                <th>Status</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @forelse($shipping_companies as $shipping_company)

                                    <td>{{$shipping_company->name}}</td>
                                    <td>{{$shipping_company->code}} </td>
                                    <td>{{$shipping_company->description}}</td>
                                    <td>{{$shipping_company->fast}}</td>
                                    <td>{{$shipping_company->cost}}</td>
                                    <td>{{$shipping_company->countries_count}}</td>
                                    <td>{{$shipping_company->status()}}</td>
                                    <td>
                                        <a href="{{route('admin.shipping_companies.edit',$shipping_company->id)}}"
                                           class="btn btn-info btn-sm" role="button" title="Edit" aria-pressed="true"><i
                                                class="fa fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#delete_shipping_company{{ $shipping_company->id }}"
                                                title="Delete"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                            </tr>

                            {{--delete Modal Category --}}
                            <div class="modal fade" id="delete_shipping_company{{ $shipping_company->id }}"
                                 tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title">
                                                <div class="mb-30">

                                                    <h6>Delete {{$shipping_company->name}}</h6>

                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form class="form" action="{{ route('admin.shipping_companies.delete') }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')

                                                <input type="hidden" name="delete_shipping_companiesId"
                                                       value="{{$shipping_company->id}}" id="id">

                                                <h6>Are you sure about deleting this shipping company?: <span
                                                        class="text-danger">{{$shipping_company->name}}</span></h6>


                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit"
                                                            class="btn btn-danger">Delete
                                                    </button>

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

                                        {!! $shipping_companies->appends(request()->all())->links() !!}

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
