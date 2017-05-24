<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Reservation;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Getting all the data from user table
    public function index()
    {
        //list out all user objects
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //List out the data required for user role for input selection in creating user
    public function create()
    {
        //list all the role users
        $roleUser = RoleUser::lists('name', 'id')->all();
        return view('user.create', compact('roleUser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Storing the data input from create()
    public function store(UserStoreRequest $request)
    {
        //create the user object
        $input = $request -> all();
        User::create($input);
        Session::flash('created_user', 'User ' . $input['name'] .' successfully created');
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //list out data required with preset value with certain id
    public function edit($id)
    {
        //call the particular user object
        //list out the role user
        $user = User::findOrFail($id);
        $roleUser = RoleUser::lists('name', 'id')->all();
        return view('user.edit', compact('user', 'roleUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Updating the data input from edit()
    public function update(UserUpdateRequest $request, $id)
    {
        //call the particular user
        //update the users
        $user = User::findOrFail($id);

        $input = $request -> all();
        if(!trim($request->password)) {
            $input = $request->except('password');
        }

        $user->update($input);
        Session::flash('updated_user', 'User ' . $user->name .' successfully updated');
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Destroying the data
    public function destroy($id)
    {
        //delete everything related to user object
        //also delete associated reservations
        $user = User::findOrFail($id);
        $user->delete();
        $reservations = Reservation::where('user_id', $user->id)->get();
        foreach($reservations as $reservation) {
            $reservation->delete();
        }
        Session::flash('deleted_user', 'User ' . $user->name .' successfully deleted');
        return redirect(route('user.index'));
    }
}
