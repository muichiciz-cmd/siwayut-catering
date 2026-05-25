<!-- File: src/Views/layouts/main.php -->
<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= htmlspecialchars((string)APP_NAME, ENT_QUOTES, 'UTF-8') ?>

    </title>

  </head>
  <body>
    <div style="font-family: sans-serif; padding: 20px;">
      <h1>Catering Admin</h1>
      <hr>
      <?= $content ?? '' ?>
    </div>
  </body>
</html>
