<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Récapitulatif de commande</title>
    <style>
        {!! file_get_contents(public_path('css/mail-new-order.css')) !!}
    </style>
</head>
<body bgcolor="#E8F3FF">
<main>
    <h1>Récapitulatif de votre commande n°{{ $order->id }}</h1>
    <p>Bonjour <strong>{{ $order->user->first_name }} {{ $order->user->last_name }}</strong>,</p>
    <h2>Détails de la commande :</h2>
    <table>
        <thead>
        <tr>
            <th>Article</th>
            <th>Quantité</th>
            <th>Prix</th>
        </tr>
        </thead>
        <tbody>
        @php
            $total = 0;
        @endphp
        @foreach($order->orderLines as $line)
            @php
                $total += $line->price;
            @endphp
            <tr>
                <td>{{ $line->product->name }}</td>
                <td>{{ $line->quantity }}</td>
                <td>{{ $line->price }}€</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2"><strong>Total</strong></td>
            <td><strong>{{ $total }}€</strong></td>
        </tr>
        </tbody>
    </table>
    <p>Si vous avez besoin d'aide, n'hésitez pas à nous contacter.</p>
    <p>L'équipe E-COMMERCE-API</p>
</main>
</body>
</html>
