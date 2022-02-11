@extends('layouts.admin')

@section('content')



    <div class="d-block d-md-flex justify-content-between">
        <div class="d-block">
            <h5 class="card-title pb-0 border-0">Rivews: <span class="text-danger">{{$review->name}}</span></h5>
        </div>

        <div class="d-block d-md-flex justify-content-between">
            <div class="d-block">
                <a class="btn btn-success icon left"

                   href="{{route('admin.reviews')}}">Rivews <i class="fa fa-arrow-right"></i></a>
            </div>

        </div>

    </div>

    <br>
    <br>


    <div class="table-responsive ">
        <table class="table">

            <tr class="text-dark">
                <th>Name:</th>
                <td>{{$review->name}}</td>
            </tr>
            <tr class="text-dark">
                <th>Email:</th>
                <td>{{$review->email}}</td>
            </tr>
            <tr class="text-dark">
                <th>Customer Name:</th>

                <td>{{$review->user_id != '' ? $review->user->name : ''}}</td>
            </tr>
            <tr class="text-dark">
                <th>Rating:</th>
                <td>{{$review->rating}}</td>
            </tr>
            <tr class="text-dark">
                <th>Title:</th>
                <td colspan="3">{{$review->title}}</td>
            </tr>
            <tr class="text-dark">
                <th>Message:</th>
                <td colspan="3">{{$review->message}}</td>
            </tr>
            <tr class="text-dark">
                <th>Created at:</th>
                <td colspan="3">{{$review->created_at}}</td>

            </tr>

            <tbody>
            <tr>


            </tbody>


        </table>
    </div>



@endsection


