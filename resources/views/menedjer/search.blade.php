@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('home') }}" class = "btn btn-primary">Home</a>
                @else
                    <a href="{{ route('login') }}" class = "btn btn-primary">
                        login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                            register</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="content">
            <div  class="col-md-4 offset-md-5 text-danger">
                <h1>search</h1>
            </div>

            <form class="navbar-form navbar-left" method="GET" action="{{url('assignment/search/edit')}}">
                <div class="input-group col-md-4 offset-md-7">
                    <label for="filter" class="col-md-4 col-form-label text-md-right">filter</label>
                    <input type="text" class="m-0 form-control" id="filter" name="search">
                    <button class="btn btn-primary" type="submit">
                        creat
                    </button>
                </div>
            </form>

            @if(!empty( session('message')))
                <div class="alert alert-success">
                    {{session('message')}}
                    <button type="button" class="close" aria-label="Close">
                        <a href="/close/message" class="stretched-link"><span aria-hidden="true">&times;</span></a>
                    </button>
                </div>
            @endif

            <a href="{{url('assignment ')}}" class = "btn btn-primary">
                back</a>
            <div class="w-100"></div>
            <table class = "table table-striped">
                <thead>
                <tr class="bg-dark text-white">

                    <td>name</td>
                    <td>assigned to</td>
                    <td>status</td>
                    <td>description</td>
                    <td></td>
                </tr>
                </thead>
                <tbody class="p-3 mb-2 bg-secondary text-white">
                @foreach($assignment as $assigned)

                    <tr>
                        <td>{{$assigned->name}}</td>
                        @foreach($user as $us)
                            @if($us->id == $assigned->assigned_to)

                                <td>{{$us->name}}</td>
                            @endif
                        @endforeach
                        <td>{{$assigned->status}}</td>
                        <td>{{$assigned->description}}</td>

                        <td>
                            <a href="{{url("assignment/".$assigned->id )}}" class = "btn btn-primary">View</a>
                            <form action="{{url("assignment/".$assigned->id)}}" method = "post">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Delete" class="btn btn-danger" >
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>
    </div>
@endsection


