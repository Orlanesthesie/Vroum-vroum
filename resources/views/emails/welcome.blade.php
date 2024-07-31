<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue à Road2Love</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            font-size: 16px;
            line-height: 1.5;
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background-color: #007bff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/Road2Love.png') }}" alt="Road2Love">
        </div>
        <div class="content">
            <h1>Bienvenue sur Road2Love, {{ $user->firstname }} !</h1>
            <p>Merci de vous être inscrit sur Road2Love. Nous sommes ravis de vous accueillir dans notre communauté !</p>
            <p>Pour commencer, vous pouvez explorer notre plateforme et découvrir toutes les fonctionnalités qui vous aideront à trouver les meilleurs trajets en covoiturage.</p>
            <a href="{{ url('/') }}" class="button">Commencer</a>
        </div>
        <div class="footer">
            <p>Si vous avez des questions ou avez besoin d'aide, n'hésitez pas à nous contacter à <a href="mailto:support@carcovoit.com">support@Road2Love.com</a>.</p>
            <p>&copy; {{ date('Y') }} Road2Love. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
