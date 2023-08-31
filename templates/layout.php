<html lang="pl">

<head>
  <title>NOTEBOOK</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <link href="/public/style.css" rel="stylesheet">
</head>

<body class="body">
  <div class="wrapper">
    <div class="header">
      <h1><i class="far fa-clipboard"></i>My notes</h1>
    </div>

    <div class="container">
      <div class="menu">
        <ul>
          <li><a href="/">Notes list</a></li>
          <li><a href="/?action=create">Create note</a></li>
        </ul>
      </div>

      <div class="page">
        <?php require_once "templates/pages/$page.php"; ?>
      </div>
    </div>

    <div class="footer">
      <p>Notes project in PHP</p>
    </div>
  </div>
</body>

</html>