<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Redirecting ...</title>
</head>
<body>

  <h3>Redirecting ...</h3>

  <form action="{{$gateway}}" method="post" id="payment">
      <input type="hidden" name="Token" value="{{$token}}"/>
      <input type="hidden" name="RedirectURL" value="{{$redirect}}"/>
  </form>

  <script>
      document.getElementById("payment").submit();
  </script>
</body>
</html>
