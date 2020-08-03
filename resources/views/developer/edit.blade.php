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
                    <h1>edit status</h1>
                </div>

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
            </tr>
            </thead>

            <tbody class="p-3 mb-2 bg-secondary text-white">
            <tr>
                <td>{{$assignment->name}}</td>
                <td>{{$user1}}</td>
                <td>{{$user}}</td>
                <td>

                    <label for="status"></label>
                    <select name="status" id="my_status">
                        <option value="assigned">assigned</option>
                        <option value="in_progres">in_progres</option>
                        <option value="done">done</option>
                    </select>

                </td>
                <td>{{$assignment->description}}</td>
                <td>  <button type="button" class = "btn btn-primary" id="button">send</button></td>
                <input type="hidden" id="id" value="{{$assignment->id}}">
            </tr>
            </tbody>

        </table>
    </div>
    </div>
    <script>

        let button = document.getElementById('button');
        let status = document.getElementById('my_status');
        let my_id = document.getElementById('id');
        let id = my_id.value;
        button.addEventListener('mouseup',mystatus);
        function mystatus(e) {
           let  statusText = status.value;
           let formdata = new FormData;
            formdata.append('status',statusText);
            formdata.append('id',id);
            console.log(statusText);
            const urlReq = window.location.origin+"/featch/"+statusText+"/"+id;
            let promis = fetch(urlReq,{
                method:'get',
                // method:'post',
                // body: formdata,
            }).then((r)=>{
                if(r.ok){
                    return r;
                }
                throw new Error('invalid status code exav')
            })
            promis
            .then(r=>{
                console.log(r.text())
                window.location.href = '/dev';
            })
        }
    </script>
@endsection


