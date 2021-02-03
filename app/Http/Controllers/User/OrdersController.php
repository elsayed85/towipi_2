<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(5);
        return view('user.orders.index' , [
            'orders' => $orders
        ]);
    }
}
