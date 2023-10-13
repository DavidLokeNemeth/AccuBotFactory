@extends('layouts.app')

@section('title', 'List of orders')

@section('content')

    <h1>Order Details</h1>

    <table id="orders" class="table table-striped" style="width:100%">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Total Weight</th>
            <th>Robot Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->total_weight }}</td>
                <td>{{ $order->robot_name }}</td>
                <td>
                    <a href="{{ route('order.show', ['order' => $order->id]) }}">View Details</a> | <a href="{{ route('order.edit', ['order' => $order->id]) }}">Edit Robot Name</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop

@section('script')

    $().DataTable();
    new DataTable('#orders');

@stop
