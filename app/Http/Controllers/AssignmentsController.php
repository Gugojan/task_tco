<?php

namespace App\Http\Controllers;

use App\assignment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all()->where('position','developer');
        $assignment = assignment::with('developer')->where('created_by',Auth::id())->get();
        return response()->view('menedjer.index',
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
//        $order = Order::with('product')->where('user_id', Auth::id())->get();

        $user = User::all()->where('position','developer');
        return response()->view('menedjer.create',
            compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'alpha',
            'assigned_to' => 'integer',
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $this->validate($request, $rules, $customMessages);

        $assignment = assignment::create([
            'name' =>  $request->name,
            'created_by' => Auth::id(),
            'assigned_to' => $request->assigned_to,
            'status' => 'created',
            'description' => $request->description,
        ]);


        return  redirect('assignment')
            ->with(['message' => 'The product was successfully created']);
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
        return response()->view('menedjer.show',
            compact('assignment','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $search)
    {
        $assignment =assignment::with('developer')->where('name',$search->search)->get();
        $user = User::all();
//        dd($user->all());
        return response()->view('menedjer.search',
            compact('assignment','user'));
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
        assignment::destroy($id);
        return redirect('assignment');
    }
}
