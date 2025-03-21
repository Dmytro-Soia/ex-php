<?php

$errors = [];

/**
 * On this page, you will create a simple form that allows user to create todos (with a name and a date).
 * The form should be submitted to this PHP page.
 * Then get the inputs from the post request with `filter_input`.
 * Then, the PHP code should verify the user inputs (minimum length, valid date...)
 * If the user input is valid, insert the new todo information in the sqlite database
 * table `todos` columns `title` and `due_date`. Then redirect the user to the list of todos.
 * If the user input is invalid, display an error to the user
 */

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = filter_input(INPUT_POST, "name");
    $date = filter_input(INPUT_POST, "date");

    if ($name === "") {
        array_push($errors, "Missing ToDo Title");
    }
    if ($date === "") {
        array_push($errors, "Misssing ToDo Date");
    }

    if (count($errors) === 0) {
        $dns = "sqlite:../database.db";
        $user = "root";
        $pass = "";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dns, $user, $pass, $option);

            $stmt = $pdo->prepare("INSERT INTO todos (title, due_date) VALUES (:name, :date)");
            $stmt->execute(["name" => $name, "date" => $date]);

            header("Location: displayAllTodosFromDatabase.php");
            exit();
        } catch (Exception $e) {
            var_dump($e);
            array_push($errors, "Cannot add to database, connection problem");
        }
    }
}

function displayTodo($name, $date)
{
    if ($name && $date) {
        return "$name $date";
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
    <title>Create a new todo</title>
</head>

<body>

    <h1>
        Create a new todo
    </h1>

    <?php if (count($errors) > 0): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <!-- WRITE YOUR HTML AND PHP TEMPLATING HERE -->
    <form method="post" action="writeTodoToDatabase.php">
        <label for="title">Todo Title</label>
        <input type="text" name="name" id="title" value="<?= $name ?>"><br>
        <label for="date">Todo Date</label>
        <input type="date" name="date" id="date" value="<?= $date ?>"><br>
        <button type="submit">Submit</button>
    </form>

    <ul>
        <li>
            <?= displayTodo($name, $date) ?>
        </li>
    </ul>
</body>

</html>