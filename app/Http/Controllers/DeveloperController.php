<?php

namespace App\Http\Controllers;

use App\assignment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $assignment = assignment::all();
        return response()->view('developer.index',
            compact('assignment','user')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { $a = new User();
        return response()->view("",compact('a'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignment = assignment::find($id);
        $user = User::all()->where('id',$assignment->assigned_to);
        foreach ($user as $us){
            $user = $us->name;
        }
        $user1 = User::all()->where('id',$assignment->created_by);
        foreach ($user1 as $us){
            $user1 = $us->name;
        }
        return response()->view('developer.show',
            compact('assignment','user','user1'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assignment = assignment::find($id);
        $user = User::all()->where('id',$assignment->assigned_to);
        foreach ($user as $us){
            $user = $us->name;
        }
        $user1 = User::all()->where('id',$assignment->created_by);
        foreach ($user1 as $us){
            $user1 = $us->name;
        }
        return response()->view('developer.edit',
            compact('assignment','user','user1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function featch($status, $id){

        assignment::where('id', $id)->update([
            'status'=>$status,
        ]);
              return  redirect('dev');
    }
}
