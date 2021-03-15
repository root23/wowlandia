<h1>Уведомление о новом заказе</h1>

<p>Был оформлен новый заказ!</p>
<p><a href="https://wowlandia.ru/admin/order/{{ $mailData['orderId'] }}">Открыть данные заказа</a> </p>

<table style="border: 1px solid #0b0b0b;">
    <thead>
    <tr style="border: 1px solid #0b0b0b;">
        <td>Наименование товара</td>
        <td>Размер</td>
        <td>Цена</td>
        <td>Количество</td>
        <td>Сумма</td>
    </tr>
    </thead>

@foreach($cart as $item)
    <tr>
        <td>{{ $item->name }}</td>
        <td>{{ $item->options['size'] }}</td>
        @if ($item->options['sale_price'])
            <td>{{ $item->options['sale_price'] }}</td>
        @else
            <td>{{ $item->price }}</td>
        @endif
        <td>{{ $item->quantity }}</td>
        @if ($item->options['sale_price'])
            <td>{{ $item->options['sale_price'] * $item->quantity }}</td>
        @else
            <td>{{ $item->price * $item->quantity }}</td>
        @endif
    </tr>
@endforeach
</table>
