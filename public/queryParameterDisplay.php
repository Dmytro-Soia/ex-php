<?php

/**
 * Get the values from the GET parameters with filter_input function
 */
$name = filter_input(INPUT_GET, "name");
$age = filter_input(INPUT_GET, "age", FILTER_SANITIZE_NUMBER_INT);

$errors = [];

if ($name === null) {
    array_push($errors, "Missing name");
}
if ($age === null) {
    array_push($errors, "Missing age");
}
if ($age === false) {
    array_push($errors, "Invalid age (must be a number)");
}

function cheking($name, $age)
{
    if ($name && $age) {
        return "$name is $age years old";
    } else {
        return 'No query parameters found';
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>URL query parameters</title>
</head>

<body>

    <!-- Display parameters here in a h1 tag -->
    <h1><?= htmlspecialchars(cheking($name, $age)) ?></h1>
    <!-- Display message in list element in case of missing parameters -->

    <?php if (count($errors) > 0): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</body>

</html>