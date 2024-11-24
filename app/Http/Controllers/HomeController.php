<?php

namespace App\Http\Controllers;

use App\Models\Order;

class HomeController extends Controller
{
    public function home()
    {
        $pending_orders = Order::where('status', 'pending')->get();
        return view('front', [
            'pending_orders' => $pending_orders
        ]);
    }
}
