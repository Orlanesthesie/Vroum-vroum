<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation - Road2Love</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 20px;
            background-color: #e91e63;
            color: #ffffff;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }
        .content .trip-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .content .trip-info p {
            margin: 5px 0;
        }
        .content .trip-info p span {
            font-weight: bold;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f4f4f4;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            font-size: 14px;
            color: #777777;
        }
        .footer a {
            color: #e91e63;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Road2Love</h1>
        </div>
        <div class="content">
            <p>Bonjour {{ $trip->user->firstname }},</p>
            <p>Nous sommes ravis de confirmer l'annulation de la réservation pour le trajet suivant :</p>
            <div class="trip-info">
                <p><span>Départ:</span> {{ $trip->starting_point }}</p>
                <p><span>Arrivée:</span> {{ $trip->ending_point }}</p>
                <p><span>Date de départ:</span> {{ \Carbon\Carbon::parse($trip->starting_at)->format('d-m-Y H:i') }}</p>
                <p><span>Nombre de places annulées:</span> 1</p>
            </div>
            <p>Merci d'avoir choisi Road2Love. Nous espérons vous revoir!</p>
            <p>Si vous avez des questions ou des préoccupations, n'hésitez pas à nous <a href="#">contacter</a>.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Road2Love. Tous droits réservés.</p>
            <p>Vous recevez cet email car vous avez effectué une réservation sur notre site.</p>
        </div>
    </div>
</body>
</html>
