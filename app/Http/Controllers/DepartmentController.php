<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Department::class);
        $departments = Department::paginate()->withQueryString();
        return view('pages.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Department::class);

        return view('pages.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Department::class);

        $validator = Validator($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if (!$validator->fails()) {
            $department = new Department();
            $department->name = $request->input('name');
            $department->save();

            toastr()->success('Department created successfully!');
            return redirect()->route('departments.index');
        }

        toastr()->error($validator->getMessageBag()->first());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        Gate::authorize('update', Department::class);

        return view('pages.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        Gate::authorize('update', Department::class);

        $validator = Validator($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if (!$validator->fails()) {
            $department->name = $request->input('name');
            $department->save();
            toastr()->success('Department updated successfully!');
            return redirect()->route('departments.index');
        }
        toastr()->error($validator->getMessageBag()->first());
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        Gate::authorize('delete', Department::class);

        $is_deleted = $department->delete();
        if ($is_deleted) {
            toastr()->success('Department deleted successfully!');
            return redirect()->route('departments.index');
        }
        toastr()->error('Department could not be deleted!');
        return redirect()->back();
    }
}
