<?php
$errors = [];
/**
 * On this page, you need to remove a todo from the sqlite database.
 * The id of the todo to delete will be passed as a POST parameter.
 * You need to handle the deletion of the todo from the database.
 * If there is an error, display an error message.
 * If the deletion is successful, redirect the user to the list of todos.
 */
$todoID = filter_input(INPUT_POST, "chosenTodoID");

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
            $pdo = new PDO($dnfrgwregs, $uswegwerger, $pawergwegss, $optiowegwegns);
            $stmt = $pdo->prepare('DELETE FROM todos WHERE id= :id');
            $stmt->execute(['id' => $todoID]);
            header("Location: displayAllTodosFromDatabase.php");
        } catch (Exception $e) {
            array_push($errors, 'Cannot delete todo');
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
    <title>Todo deletion</title>
</head>
<body>

<h1>Delete a todo error</h1>
<?php if (count($errors) > 0): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<!-- WRITE YOUR HTML AND PHP TEMPLATING HERE -->
<a href="displayAllTodosFromDatabase.php">Return to todo list</a>

</body>
</html>
