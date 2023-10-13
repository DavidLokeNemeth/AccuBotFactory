@extends('layouts.app')

@section('title', 'Order Details')

@section('content')

    <h1 class="h3">Order details</h1>

    <table class="table table-striped">
        <tr>
            <td>Order ID</td>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <td>Customer Name</td>
            <td>{{ $order->customer_name }}</td>
        </tr>
        <tr>
            <td>Total Weight</td>
            <td>{{ $order->total_weight }}</td>
        </tr>
        <tr>
            <td>Robot Name</td>
            <td><a href="{{ route('order.edit', ['order' => $order->id]) }}">{{ $order->robot_name }}</a></td>
        </tr>
    </table>

    <h4>Items</h4>
    <table id="items" class="table table-striped">
        <thead>
        <tr>
            <th>Component ID</th>
            <th>SKU</th>
            <th>Description</th>
            <th>Category</th>
            <th>Weight</th>
            <th>Quantity</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->sku }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->category->category}}</td>
                <td>{{ $item->weight }}</td>
                <td>{{ $item->pivot->quantity }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('home') }}">Back to Orders</a>

@stop


@section('script')

    $().DataTable();
    new DataTable('#items');

@stop
