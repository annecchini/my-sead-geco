<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(User $user){
        //
        $this->user = $user;

        //middleware
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(10);
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $people = Person::all();
        return view('user.create', [ 'people' => $people ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //field validation
        $request->validate($this->user->rules(), $this->user->feedback());

        //do the thing
        $user = User::create([
            'person_id' => $request->person_id,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('user.show', [ 'user' => $user->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return view('user.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $people = Person::all();
        return view('user.edit', [ 'people' => $people, 'user'=>$user ]);
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
        //dd($request->all());

        //load resource
        $user = $this->user->find($id);

        //field validation
        $options = $request->changePassword ? [] : ['password'=>false];
        $request->validate($user->rules($options), $user->feedback());

        //mount $data to update
        $data = [];
        $data['person_id'] = $request->person_id;
        $data['email'] = $request->email;
        if ($request->changePassword) $data['password'] = Hash::make($request->password);

        //do the thing
        $user->update($data);
        return redirect()->route('user.show', ['user' => $user->id ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //

        $user->delete();
        return redirect()->route('user.index',['message' => 'Usuário excluido com sucesso!']);
    }
}