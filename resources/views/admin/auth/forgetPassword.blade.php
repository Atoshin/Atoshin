<html>
<head>
<title>Forgot Password</title>
</head>
<body>
<form action="{{route('forget.password.post')}}">
    <label for="">Email</label>
    <input type="email" name="email" placeholder="Email">
    <button type="submit">submit</button>
</form>
</body>
</html>
