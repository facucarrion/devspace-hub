<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="<?= base_url('api/projects/imagen'); ?>" method="post" enctype="multipart/form-data">
    <input type="checkbox" name="admin" id="imagen" <?= $rol == 1 ? 'checked' : ''; ?>>
    <button type="submit">a</button>
  </form>
</body>

</html>