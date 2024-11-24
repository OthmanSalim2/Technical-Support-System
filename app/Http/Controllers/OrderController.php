<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Order::class);

        $orders = Order::with('user')->paginate()->withQueryString();
        return view('pages.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Order::class);

        $departments = Department::all();
        $users = User::all();
        return view('pages.orders.create', compact('departments', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Order::class);

        $validator = Validator($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'username' => ['required', 'int'],
            'department' => ['required', 'string', 'max:255', 'exists:departments,id'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        if (!$validator->fails()) {
            $order = new Order();
            $order->name = $request->title;
            $order->description = $request->description;
            $order->department_id = $request->department;
            $order->user_id = $request->username;
            $order->save();

            toastr()->success('Order created successfully!');
            return redirect()->route('home');
        }

        toastr()->error($validator->getMessageBag()->first());
        return redirect()->route('orders.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        Gate::authorize('update', Order::class);

        $users = User::all();
        $departments = Department::all();

        return view('pages.orders.edit', compact('order', 'users', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        Gate::authorize('update', Order::class);

        $validator = Validator($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255', 'exists:departments,id'],
        ]);

        if (!$validator->fails()) {
            $order->name = $request->input('title');
            $order->user->department_id = $request->input('department');
            $order->description = $request->input('description');
            $order->save();

            toastr()->success('Order updated successfully!');
            return redirect()->route('orders.index');
        }
        toastr()->error($validator->getMessageBag()->first());
        return redirect()->route('orders.edit', ['order' => $order]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        Gate::authorize('delete', Order::class);

        $is_deleted = $order->delete();
        if ($is_deleted) {
            toastr()->success('Order deleted successfully!');
            return redirect()->route('orders.index');
        }
        toastr()->error('Error Deleted Order!');
        return redirect()->route('orders.index');
    }

    public function getOrdersCompleted()
    {
        $completed_orders = Order::where('status', '=', 'completed')->with('user')->paginate()->withQueryString();

        return view('pages.orders.order_completed', compact('completed_orders'));
    }

    public function deleteOrdersCompleted($id)
    {
        Gate::authorize('delete', Order::class);

        $is_deleted = $order = Order::findOrFail($id);
        if ($is_deleted) {
            toastr()->success('Order deleted successfully!');
            return redirect()->route('orders.index');
        }
        toastr()->error('Error Deleted Order!');
        return redirect()->route('orders.index');

    }

    public function getOrdersProcessed()
    {

        $pending_orders = Order::where('status', '=', 'pending')->with('user')->paginate()->withQueryString();

        return view('pages.orders.order_processed', compact('pending_orders'));
    }

    public function convertOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();
        toastr()->success('Order converted to completed!');
        return redirect()->route('orders.index');
    }

    public function deleteOrdersProcessed($id)
    {
        Gate::authorize('delete', Order::class);

        $is_deleted = $order = Order::findOrFail($id);
        if ($is_deleted) {
            toastr()->success('Order deleted successfully!');
            return redirect()->route('orders.index');
        }
        toastr()->error('Error Deleted Order!');
        return redirect()->route('orders.index');

    }
}
