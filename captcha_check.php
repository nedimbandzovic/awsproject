<html>
  <head>
    <title>hCaptcha Demo</title>
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
  </head>
  <body>
    <form action="check.php" method="POST">
      <input type="text" name="email" placeholder="Email" />
      <input type="password" name="password" placeholder="Password" />
      <div class="h-captcha" data-sitekey="46dadd7b-79cc-402b-b06d-949e19fc0a16"></div>
      <br />
      <input type="submit" value="Submit" />
    </form>
  </body>
</html>