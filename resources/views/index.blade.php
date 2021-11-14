<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
   <title>Blog</title>
</head>
<body>

@if (Auth::check())
   @php
   $user_auth_data = [
       'isLoggedin' => true,
       'user' =>  Auth::user()
   ];
   @endphp
@else
   @php
   $user_auth_data = [
       'isLoggedin' => false
   ];
   @endphp
@endif
<script>
   window.Laravel = JSON.parse(atob('{{ base64_encode(json_encode($user_auth_data)) }}'));
</script>


   <div id="app">
      <router-view></router-view>
   </div>

   <script src="/js/app.js"></script>
</body>
</html>