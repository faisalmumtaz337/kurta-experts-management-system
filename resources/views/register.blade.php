<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h2>Create User</h2>
  <form action="{{route('store')}}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="caste" placeholder="Caste">
    <input type="text" name="contact" placeholder="Contact">
    <input type="text" name="password" placeholder="Password">
    <input type="text" name="user_type" placeholder="User Type">
    <input type="submit" value="Create">
  </form>
</body>
</html>