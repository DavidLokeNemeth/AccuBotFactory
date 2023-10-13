@extends('layouts.app')

@section('title', 'Edit Order')

@section('content')

    <h1 class="h3">Edit Robot Name</h1>

    <table class="table table-striped">
        <tr>
            <td>Order ID</td>
            <td><a href="{{ route('order.show', ['order' => $order->id]) }}">{{ $order->id }}</a></td>
        </tr>
        <tr>
            <td>Customer Name</td>
            <td>{{ $order->customer_name }}</td>
        </tr>
        <tr>
            <td>Total Weight</td>
            <td>{{ $order->total_weight }}</td>
        </tr>
    </table>

    <form method="POST" action="{{ route('order.update', ['order' => $order->id]) }}">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <label for="robot_name" class="col-sm-2 col-form-label col-form-label-sm">New Robot Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="robot_name" id="robot_name" value="{{ $order->robot_name }}" minlength="5" required>
            </div>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update Robot Name</button>
        </div>
    </form>

    <a href="{{ route('home') }}">Back to Orders</a>

@stop
