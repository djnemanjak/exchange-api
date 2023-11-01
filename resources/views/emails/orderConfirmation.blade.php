<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>

<div>
    <p>Foreign currency: {{ $order->foreign_currency }}</p>
    <p>Exchange rate: {{ $order->exchange_rate }}</p>
    <p>Amount of foreign currency: {{ $order->foreign_amount }}</p>
    <p>Amount: {{ $order->amount }}</p>
</div>
</body>
</html>
