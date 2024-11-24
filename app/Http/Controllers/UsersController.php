<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', User::class);
        $users = User::paginate()->withQueryString();
        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', User::class);

        $departments = Department::all();
        return view('pages.users.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', User::class);

        $validator = Validator($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'department' => ['required', 'int', 'exists:departments,id'],
            'guard' => ['string', 'in:normal,admin,super-admin'],
        ]);

        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->department_id = $request->input('department');
            $user->guard = $request->input('guard');
            $user->save();

            toastr()->success('User created successfully!');
            return redirect()->route('users.index');
        }

        toastr()->error($validator->getMessageBag()->first());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Gate::authorize('update', User::class);

        $user = User::where('id', '=', $id)->first();
        $departments = Department::all();
        $selectedDepartment = $user->department_id;

        return view('pages.users.edit', compact('user', 'departments', 'selectedDepartment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('update', User::class);

        $validator = Validator($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email, ' . $id],
            'guard' => ['string', 'in:normal,admin,super-admin'],
            'department' => ['required', 'int', 'exists:departments,id'],
        ]);

        if (!$validator->fails()) {
            $user = User::where('id', '=', $id)->first();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
//            $user->department_id = $request->input('department');

            if ($request->input('password') != null) {
                $user->password = Hash::make($request->input('password'));
            }

            if ($request->input('guard') != $user->guard) {
                $user->guard = $request->input('guard');
            }

            if ($request->input('department') != $user->department_id) {
                $user->department_id = $request->input('department');
            }
            $user->save();

            toastr()->success('User updated successfully!');
            return redirect()->route('users.index');
        }

        toastr()->error($validator->getMessageBag()->first());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete', User::class);

        $user = User::findOrFail($id);
        $user->delete();

        toastr()->success('User deleted successfully!');
        return redirect()->route('users.index');
    }
}
