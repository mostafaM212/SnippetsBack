<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .message{
            background-color: antiquewhite;
            margin: 40px;
            text-decoration: brown;
        }
    </style>
</head>
<body>
    <div class="message" >
        <h1>Welcome Dear {{ $user->name }} in Snippets</h1>
        <p>sorry about your password your password is </p>
        <p>we put new password for you password {{$password}}</p>
    </div>
</body>
</html>
