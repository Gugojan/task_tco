@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('home') }}" class = "btn btn-primary">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="content flex-center">
            <div class="col-md-4 offset-md-5 text-danger">
                <h3>Create a assignment</h3>
            </div>
            <a href="{{url('assignment')}}" class = "btn btn-primary fa ">
               back
            </a>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{$err}}</li>
                        @endforeach
                    </ul>


                </div>
            @endif
            <div class="card-body col-md-8">
                <form action="/assignment" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">assigned name</label>
                        <div class="col-md-6">
                            <input type="text" name = "name" id ="name" class="form-control ">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">description</label>
                        <div class="col-md-6">
                            <textarea name="description" id="description" cols="56" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="assigned_to" class="col-md-4 col-form-label text-md-right">assigned to developer</label>
                        <div class="col-md-6">
                            <select name="assigned_to" id="assigned_to" class="form-control ">
                                @if($user->all() !== [])
                                    @foreach($user as $us)
                                        <option value="{{$us->id}}">{{$us->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <input type="submit" value="Save" class="btn btn-primary">
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection

