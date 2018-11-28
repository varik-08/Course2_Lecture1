@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Заказы:</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table" border="3">
                            <tr>
                                <th>Email:</th>
                                <th>Телефон:</th>
                                <th>Товар:</th>
                            </tr>
                            @foreach ($orders as $order )
                                <tr>
                                    <td>{{$order->email}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{$order->product()->withTrashed()->first()->name}}</td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
