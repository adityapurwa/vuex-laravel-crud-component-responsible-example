<?php

namespace App\Http\Controllers\Rest;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::create($request->only([
            'name',
            'email',
            'password'
        ]));

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::query()->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->whereNot('id', $id)]
        ]);

        $user->fill($request->only([
            'name',
            'email'
        ]));
        if (!empty($request->get('password'))) {
            $user->password = bcrypt($request->get('password'));
        }

        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::query()->findOrFail($id);
        $user->delete();

        return [
            'status' => 'ok',
            'deleted' => $id
        ];
    }
}
