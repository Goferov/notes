<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>My Notes</title>
</head>

<body>
<head>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/?action=create">Dodaj notatkę</a></li>
        </ul>
    </nav>
</head>
<main>
    <?php
    require_once('templates/pages/'.$page.'.php');
    ?>

</main>
<footer>

</footer>
</body>

</html>