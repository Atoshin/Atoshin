<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <h4>Someone send the following message through contact-us page:</h4>

        <p><b>Name:</b></p> <p>{{$data['name']}}</p>
        <p><b>email:</b></p> <p>{{$data['email']}}</p>
        <p><b>Subject:</b></p> <p>{{$data['subject']}}</p>
        <p><b>Message:</b></p> <p>{{$data['message']}}</p>
</body>
</html>
