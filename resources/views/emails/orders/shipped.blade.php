Спасибо за ваш заказ!
Количество: {{$orders->count()}}
Товары:
@foreach ($orders->unique('product_id') as $order)
    {{$order->product()->withTrashed()->first()->name}}
@endforeach
