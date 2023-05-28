<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce</title>
</head>

<body>
    <div>
        <p>para receber o crédito na sua conta click neste link abaixo</p>
        <a href="http://127.0.0.1:8000/confirm-email?email={{$user->email}}">{{$user->email}}</a>
    </div>
</body>

</html>