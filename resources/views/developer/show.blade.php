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

        <a href="{{url('dev')}}" class = "btn btn-primary">
            back</a>
        <div class="w-100"></div>
            <table class = "table table-striped">

                <thead>
                <tr class="bg-dark text-white">
                    <td>name</td>
                    <td>created by</td>
                    <td>assigned to</td>
                    <td>status</td>
                    <td>description</td>
                    <td>creat</td>
                    <td>updet</td>
                </tr>
                </thead>

                <tbody class="p-3 mb-2 bg-secondary text-white">
                    <tr>
                        <td>{{$assignment->name}}</td>
                                <td>{{$user1}}</td>
                                <td>{{$user}}</td>
                        <td>{{$assignment->status}}</td>
                        <td>{{$assignment->description}}</td>
                        <td>{{$assignment->created_at}}</td>
                        <td>{{$assignment->updated_at}}</td>
                            @if(\Illuminate\Support\Facades\Auth::id() === $assignment->assigned_to)
                            <td>
                                <a href="{{url("dev/".$assignment->id.'/edit')}}" class = "btn btn-primary">edit status</a>
                            </td>
                            @endif
                    </tr>
                </tbody>
            </table>
    </div>
@endsection


