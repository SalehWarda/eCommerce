@extends('layouts.admin')
@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Productc Coupons </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Productc Coupons </li>
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
                            <h5 class="card-title pb-0 border-0">Productc Coupons </h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-success icon left"

                                   href="{{route('admin.coupons.create')}}">Add new coupon <i class="fa fa-plus"></i></a>
                            </div>

                        </div>

                    </div>

                    @include('backend.coupons.filter.filter')
                    <div class="table-responsive">
                        <table class="table center-aligned-table mb-0">
                            <thead>
                            <tr class="text-dark">
                                <th>Code</th>
                                <th>Value</th>
                                <th>Description</th>
                                <th>Use Times</th>
                                <th>Validity date</th>
                                <th>Greater than</th>
                                <th>Status</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @forelse($coupons as $coupon)


                                    <td><strong>{{$coupon->code}}</strong><br>
                                        <small>{{$coupon->created_at->format('Y-m-d h:i a') }}</small>
                                    </td>
                                    <td>{{$coupon->value }} {{ $coupon->type == 'fixed'? '$' : '%' }}</td>
                                    <td>  {!!$coupon->description ?? '' !!}  </td>
                                    <td>{{$coupon->used_times. '/' . $coupon->use_times  }}</td>
                                    <td><small>{{$coupon->start_date != '' ? $coupon->start_date->format('Y-m-d'). ' - ' . $coupon->expire_date->format('Y-m-d') : '-' }}</small></td>
                                    <td>{{$coupon->greater_than ?? '-' }}</td>
                                    <td>{{$coupon->status() }}</td>
                                    <td>
                                        <a href="{{route('admin.coupons.edit',$coupon->id)}}"
                                           class="btn btn-info btn-sm" role="button" title="Edit" aria-pressed="true"><i
                                                class="fa fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#delete_coupon{{ $coupon->id }}" title="Delete"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                            </tr>

                            {{--delete Modal coupon --}}
                            <div class="modal fade" id="delete_coupon{{ $coupon->id }}" tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title">
                                                <div class="mb-30">

                                                    <h6>Delete {{$coupon->name}}</h6>

                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form class="form" action="{{ route('admin.coupons.delete') }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')

                                                <input type="hidden" name="delete_product_id" value="{{$coupon->id}}" id="id">

                                                <h6>Are you sure about deleting: <span class="text-danger">{{$coupon->code}}</span></h6>


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
                                    <td colspan="8" class="text-center">No coupons found</td>
                                </tr>




                            @endforelse





                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="8">
                                    <div class="float-right">

                                        {!! $coupons->appends(request()->all())->links() !!}

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
