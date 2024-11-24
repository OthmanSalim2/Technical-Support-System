<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny()
    {
        $user = Auth::user();
        $permission = Permission::where('guard_name', $user->guard)->get();
        $selected_permission = $permission->where('name', 'Read Orders')->first();

        if ($user->guard == 'normal') {
            if ($permission && $selected_permission->is_checked) {
                return true;
            }
            return false;
        } elseif ($user->guard == 'admin') {
            if ($permission && $selected_permission->is_checked) {
                return true;
            }
            return false;
        } elseif ($user->guard == 'super-admin') {
            if ($permission && $selected_permission->is_checked) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $user = Auth::user();
        $permission = Permission::where('guard_name', $user->guard)->get();
        $selected_permission = $permission->where('name', 'Create Order')->first();

        if ($user->guard == 'normal') {
            if ($permission && $selected_permission->is_checked) {
                return true;
            }
            return false;
        } elseif ($user->guard == 'admin') {
            if ($permission && $selected_permission->is_checked) {
                return true;
            }
            return false;
        } else {
            if ($permission && $selected_permission->is_checked) {
                return true;
            }
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update()
    {
        $user = Auth::user();
        $permission = Permission::where('guard_name', $user->guard)->get();
        $selected_permission = $permission->where('name', 'Edit Order')->first();

        if ($user->guard == 'normal') {
            if ($permission && $selected_permission->is_checked) {
                return true;
            }
            return false;
        } elseif ($user->guard == 'admin') {
            if ($permission && $selected_permission->is_checked) {
                return true;
            }
            return false;
        } else {
            if ($permission && $selected_permission->is_checked) {
                return true;
            }
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete()
    {
        $user = Auth::user();
        $permission = Permission::where('guard_name', $user->guard)->get();
        $selected_permission = $permission->where('name', 'Delete Order')->first();

        if ($user->guard == 'normal') {
            if ($permission && $selected_permission->is_checked) {
                return true;
            }
            return false;
        } elseif ($user->guard == 'admin') {
            if ($permission && $selected_permission->is_checked) {
                return true;
            }
            return false;
        } else {
            if ($permission && $selected_permission->is_checked) {
                return true;
            }
            return false;
        }
    }

}
