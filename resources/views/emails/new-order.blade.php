<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmation de commande</title>
    <style>
        {!! file_get_contents(public_path('css/mail-new-order.css')) !!}
    </style>
</head>
<body bgcolor="#E8F3FF">
<main>
    <h1>Confirmation de votre commande n°{{ $order->id }}</h1>
    <p>Bonjour <strong>{{ $order->user->first_name }} {{ $order->user->last_name }}</strong>, 👋</p>
    @switch($order->status)
        @case('pending')
            <p><strong>Votre commande est en attente de traitement. ⏳</strong></p>
            @break
        @case('processing')
            <p><strong>Votre commande est en cours de traitement. 🔄</strong></p>
            @break
        @case('completed')
            <p><strong>Votre commande a été complétée avec succès. ✅</strong></p>
            @break
        @case('declined')
            <p><strong>Désolé, votre commande a été refusée. ❌</strong></p>
            @break
        @case('cancelled')
            <p><strong>Votre commande a été annulée. 🚫</strong></p>
            @break
        @default
            <p><strong>Statut de commande inconnu. ❓</strong></p>
    @endswitch
    <p>Nous avons bien reçu votre commande du
        <strong>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</strong>. 📅</p>
    <h2>Détails de la commande : 📝</h2>
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
    <p>Si vous avez besoin d'aide, n'hésitez pas à nous contacter. 💬</p>
    <p>L'équipe E-COMMERCE-API</p>
</main>
</body>
</html>
