<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class UserController extends Controller
{
    public readonly User $user;
    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->user->all();
        return view('users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'remember_token' => 'nullable',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $image = $request->file('photo');
            try {
            $path = $request->file('photo')->storeAs('photos', $request->file('photo')->getClientOriginalName());


                $created = $this->user->create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'remember_token' => $request->input('remember_token'),
                    'photo' => $path
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        if($created) {
            return redirect()->back()->with('message', 'Created Successfully');
        }

        return redirect()->back()->with('message', 'Error');

    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        return view('user_show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user_edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updated = $this->user->where('id', $id)->update($request->except(['_token', '_method']));

        if($updated) {
            return redirect()->back()->with('message', 'Updated Successfully');
        }

        return redirect()->back()->with('message', 'Error');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->user->where('id', $id)->delete();
        return redirect()->route('users.index');
    }
}
