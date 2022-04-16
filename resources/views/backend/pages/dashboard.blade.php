@extends('master')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>

            </div>


    <div class="row">
        <div class="col-md-3">
            <div class="card" >
                <h5 class="card-header" style="background-color: green">Total Order</h5>
                <div class="card-body" style="background-color: greenyellow">

                    <h2>{{$total_order}}</h2>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <h5 class="card-header">Sale (Today)</h5>
                <div class="card-body">

                    <h2>10</h2>

                </div>
            </div>
        </div>
        <div class="col-md-3" >
            <div class="card"  style="background-color: purple">
                <h5 class="card-header">Total Customer</h5>
                <div class="card-body">

                    <h2>{{$total_customer}}</h2>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card"  style="background-color: blue">
                <h5 class="card-header">Total Product</h5>
                <div class="card-body">

                    <h2>10</h2>

                </div>
            </div>
        </div>
    </div>



@endsection
