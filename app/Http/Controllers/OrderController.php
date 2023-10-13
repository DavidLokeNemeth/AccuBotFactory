<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $orders = Order::all();

        return view('order.index', compact('orders'));
    }

    /**
     * Display the order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order): \Illuminate\View\View
    {
        return view('order.show', compact('order'));
    }

    /**
     * Show the form for editing the order robotic name.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function edit(Order $order): \Illuminate\View\View
    {
        return view('order.edit', compact('order'));
    }

    /**
     * Update the order robot_name in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $order): \Illuminate\Http\RedirectResponse
    {
        $order->robot_name = $request->input('robot_name');
        $order->save();

        return redirect()->route('order.show', ['order' => $order])
            ->with('success', 'Order updated successfully.');
    }
}
