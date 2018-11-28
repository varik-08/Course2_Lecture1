@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Продукты:</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table" border="3">
                            <tr>
                                <th>№:</th>
                                <th>Название</th>
                                <th></th>
                            </tr>
                            @foreach ($products as $product )
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td><a href="{{route('DeleteProduct', $product->id)}}">Удалить</a></td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $products->links() }}

                        <br><br><br>

                        <h1>Создать продукт</h1>
                        <form action="{{ route('CreateProduct') }}" method="POST">
                            @csrf
                            <label for="name">Имя:</label>
                            <input id="name" name="name" type="text">
                            <button type="submit">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
