@extends('frontend.master')

@section('page-content')
    <form action="{{route('search')}}" method="get">
        <div style="margin: 100px; position: absolute">
            <input type="text" class="form-control" name="search" placeholder="search">
            <button type="submit" class="btn btn-success">
                Search
            </button>

            <div class="row">
                <ul>
                    @if($users)
                        @foreach($users as $data)
                            <li>{{$data->name}}</li>
                            <li>{{$data->email}}</li>
                        @endforeach
                    @endif
                </ul>

            </div>

        </div>
    </form>


    @endsection
