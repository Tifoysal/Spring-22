@extends('frontend.master')

@section('page-content')

    <style type="text/css" xmlns="http://www.w3.org/1999/html">
        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            vertical-align: middle;
        }

        @media screen and (max-width: 600px) {
            table#cart tbody td .form-control {
                width: 20%;
                display: inline !important;
            }
            .actions .btn {
                width: 36%;
                margin: 1.5em 0;
            }
            .actions .btn-info {
                float: left;
            }
            .actions .btn-danger {
                float: right;
            }
            table#cart thead {
                display: none;
            }
            table#cart tbody td {
                display: block;
                padding: .6rem;
                min-width: 320px;
            }
            table#cart tbody tr td:first-child {
                background: #333;
                color: #fff;
            }
            table#cart tbody td:before {
                content: attr(data-th);
                font-weight: bold;
                display: inline-block;
                width: 8rem;
            }
            table#cart tfoot td {
                display: block;
            }
            table#cart tfoot td .btn {
                display: block;
            }
        }
    </style>

    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top: 100px;">


            @if(session()->has('message'))
                <p class="alert alert-success">{{session()->get('message')}}</p>
            @endif
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                    <th style="width:10%"></th>
                </tr>
                </thead>
                <tbody>
{{--@dd(session()->get('cart'))--}}
                @if(session()->has('cart'))
                @foreach(session()->get('cart') as $key=>$cartData)


                <tr>
                    <td data-th="Product">
                        <div class="row">
{{--                            <div class="col-sm-2 hidden-xs">--}}
{{--                                <img src="http://placehold.it/100x100" alt="..." class="img-responsive" /></div>--}}
                            <div class="col-sm-10">
                                <h4 class="nomargin">{{$cartData['name']}}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">{{$cartData['price']}}</td>
                    <td data-th="Quantity">
                        <form action="{{route('cart.update',$key)}}" method="post">
                            @csrf
                        <input name="quantity" type="number" class="form-control text-center" value="{{$cartData['quantity']}}">
                        <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                        </form>
                    </td>
                    <td data-th="Subtotal" class="text-center">{{$cartData['subtotal']}} .BDT</td>
                    <td class="actions" data-th="">

                        <a href="{{route('cart.delete',$key)}}"  style="color: white" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                    <td><a href="{{route('cart.clear')}}" class="btn btn-danger"> Clear Cart</a></td>
                    <td colspan="" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total {{array_sum(array_column(session()->get('cart'),'subtotal'))}} .BDT</strong></td>
                    <td><a href="{{route('checkout')}}" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                </tr>
                </tfoot>
                @else
                    <tr>
                        <td>
                        <h1>Your Cart is Empty.</h1>
                        </td>
                    </tr>


                @endif



            </table>
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection
