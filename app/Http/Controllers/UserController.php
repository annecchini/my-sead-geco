<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\Hash;
use App\Custom\GeCoLogger;

class UserController extends Controller
{

    public function __construct(User $user)
    {
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
    public function index(Request $request)
    {
        //
        $users_query = new User();
        $users_query = $users_query->AcceptRequest(User::$accepted_filters)->filter();
        $users_query = $users_query->sortable(['updated_at' => 'desc']);

        $users = $users_query->paginate(10);
        $users->withQueryString();

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
        return view('user.create', ['people' => $people]);
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

        //log create
        GeCoLogger::writeLog($user, 'create');

        $success_message = 'Usuário criado com sucesso.';
        return redirect()->route('user.index', ['user' => $user->id])->with('success_message', $success_message);
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
        return view('user.show', ['user' => $user]);
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
        return view('user.edit', ['people' => $people, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //field validation
        $options = $request->changePassword ? [] : ['password' => false];
        $request->validate($user->rules($options), $user->feedback());

        //mount $data to update
        $data = [];
        $data['person_id'] = $request->person_id;
        $data['email'] = $request->email;
        if ($request->changePassword) $data['password'] = Hash::make($request->password);

        //do the thing
        $user->update($data);

        //log update
        GeCoLogger::writeLog($user, 'update');


        //redirect to right place
        $success_message = 'Usuário atualizado com sucesso.';
        if ($request->input('to') == "user_show") return redirect()->route('user.show', ['user' => $user->id])->with('success_message', $success_message);
        return redirect()->route('user.index')->with('success_message', $success_message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        //log destroy
        GeCoLogger::writeLog($user, 'destroy');

        $success_message = 'Usuário excluído com sucesso.';
        return redirect()->route('user.index')->with('success_message', $success_message);
    }
}
