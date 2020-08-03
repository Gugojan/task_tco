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
                <h1>all assignments</h1>
            </div>


            @if(!empty( session('message')))
                <div class="alert alert-success">
                    {{session('message')}}
                    <button type="button" class="close" aria-label="Close">
                        <a href="/close/message" class="stretched-link"><span aria-hidden="true">&times;</span></a>
                    </button>
                </div>
            @endif



            <table class = "table table-striped">
                <thead>
                <tr class="bg-dark text-white">

                    <td>name</td>
                    <td>created by</td>
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
                            @if($us->id === $assigned->created_by)
                                <td>{{$us->name}}</td>
                            @endif
                        @endforeach

                        @foreach($user as $us)
                            @if($us->id === $assigned->assigned_to)
                                <td>{{$us->name}}</td>
                            @endif
                        @endforeach

                        <td>{{$assigned->status}}</td>
                        <td>{{$assigned->description}}</td>

                        <td>
                            <a href="{{url("dev/".$assigned->id )}}" class = "btn btn-primary">View</a>
                            @if(\Illuminate\Support\Facades\Auth::id() === $assigned->assigned_to)
                            <a href="{{url("dev/".$assigned->id.'/edit')}}" class = "btn btn-primary">edit status</a>
                                @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>
    </div>
@endsection


