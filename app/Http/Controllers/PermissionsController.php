<?php

namespace App\Http\Controllers;

//use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Permission::class);

        $permissions = Permission::paginate()->withQueryString();
        return view('pages.permissions.index', compact('permissions'));
    }

    public function create()
    {
        Gate::authorize('create', Permission::class);
        return view('pages.permissions.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Permission::class);

        $validator = Validator($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'guard_name' => ['required', 'string', 'in:admin,normal,super-admin'],
        ]);

        if (!$validator->fails()) {
            $permission = new Permission();
            $permission->name = $request->input('name');
            $permission->guard_name = $request->input('guard_name');
            $permission->save();

            toastr()->success('Permission added successfully!');
            return redirect()->route('permissions.create');
        }

        toastr()->error($validator->getMessageBag()->first());
        return redirect()->back();
    }

    public function userPermissions()
    {
        Gate::authorize('viewAny', Permission::class);

        $users = User::paginate()->withQueryString();
        return view('pages.permissions.user_permissions', compact('users'));
    }

    public function edit($id)
    {
        Gate::authorize('update', Permission::class);

        $user = User::findOrFail($id);
        $permissions = Permission::where('guard_name', '=', $user->guard)->paginate()->withQueryString();

        return view('pages.permissions.edit', compact('permissions', 'user'));
    }

    public function storePermission(Request $request)
    {
        Gate::authorize('create', Permission::class);

        $user = User::findOrFail($request->input('userId'));
        $permission = Permission::findOrFail($request->input('permissionId'));

        if (!$permission->is_checked) {
            $permission->update(['is_checked' => true]);

            return response()->json(['message' => 'Permission Added successfully!']);
        } else if ($permission->is_checked) {
            $permission->update(['is_checked' => false]);
            return response()->json(['message' => 'Permission Revoked successfully!']);
        }


    }

    public function editPermission(Request $request, $id)
    {
        Gate::authorize('update', Permission::class);

        $permission = Permission::findOrFail($id);
        return view('pages.permissions.edit-permission', compact('permission'));
    }

    public function updatePermission(Request $request, $id)
    {
        Gate::authorize('update', Permission::class);

        $validator = Validator($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'guard_name' => ['required', 'string', 'in:admin,normal,super-admin'],
        ]);

        if (!$validator->fails()) {
            $permission = Permission::findOrFail($id);
            $permission->name = $request->input('name');

            if ($permission->name == $request->input('name')) {
                toastr()->error('Permission already exists');
                return redirect()->back();
            }
            $permission->guard_name = $request->input('guard_name');
            $permission->save();
            toastr()->success('Updated Permission');
            return redirect()->route('permissions.index');
        }

        toastr()->error($validator->getMessageBag()->first());
        return redirect()->back();
    }

    public function destroy(Permission $permission)
    {
        Gate::authorize('delete', Permission::class);

        $is_deleted = DB::delete('DELETE FROM permissions WHERE id = ?', [$permission->id]);

        if ($is_deleted) {
            toastr()->success('Deleted Permission');
        } else {
            toastr()->error('Not Deleted');
        }
        return redirect()->route('permissions.index');
    }

}
