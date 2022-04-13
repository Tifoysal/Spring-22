@extends('master')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Order</h1>

            </div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Customer name</th>
      <th scope="col">Customer Email</th>
      <th scope="col">Total</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($orders as $order)
    <tr>
      <th scope="row">{{$order->id}}</th>
      <td>{{$order->receiver_first_name}}</td>
      <td>{{$order->receiver_email}}</td>
      <td>
       {{$order->total}} .BDT
      </td>
      <td>
        <span class="btn btn-success">{{$order->status}}</span>
      </td>
      <td>

          <a class="btn btn-success" href="{{route('order.view',$order->id)}}">View</a>
      </td>

    </tr>
    @endforeach
  </tbody>
</table>
@endsection
