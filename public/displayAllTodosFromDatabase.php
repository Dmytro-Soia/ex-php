<?php

/**
 * Get the todos from the sqlite database, and display them in a list.
 * You need to add a sort query parameter to the page to order by date or name.
 * If the query parameter is not set, the todos should be displayed in the order they were added.
 * If the request to the database fails, display an error message.
 * If the user wants to delete a todo, a form that sends a POST request to the deleteTodoFromDatabase.php page should be displayed on each todo elements.
 * The sort option selected must be remembered after the form submission (use a query parameter).
 * The todo title and date should be displayed in a list (date in american format).
 */
$errors = [];

$sort = filter_input(INPUT_GET, "sort");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
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
            $pdo = new PDO($dns, $user, $pass, $options);

            $todosArray = [];
            $query = "SELECT * FROM todos";
            if ($sort === "name") {
                $query .= " ORDER BY title";
            } elseif ($sort === "date") {
                $query .= " ORDER BY due_date";
            }

            $stmtSortByDate = $pdo->query($query);
            $todosArray = $stmtSortByDate->fetchAll();
        } catch (Exception $e) {
            array_push($errors, "Cannot display todos");
        }
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
    <title>List of todos</title>
</head>

<body>
    <?php if (count($errors) > 0): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <h1>
        All todos
    </h1>
    <form action="displayAllTodosFromDatabase.php" method="get">
        <select name="sort" id="">
            <option value="base" <?php if ($_GET['sort'] == "base") echo 'selected="selected" '; ?>>Basic</option>
            <option value="name" <?php if ($_GET['sort'] == "name") echo 'selected="selected" '; ?>>Name</option>
            <option value="date" <?php if ($_GET['sort'] == "date") echo 'selected="selected" '; ?>>Date</option>
        </select>
        <input value='Select sort type' type="submit">
    </form>
    <ul>
        <?php foreach ($todosArray as $todo): ?>
            <li>
                <?= $todo['title'] ?> <time><?= $todo['due_date'] ?></time>
                <form action='deleteTodoFromDatabase.php' method='post'>
                    <input type='hidden' name='chosenTodoID' value=<?= $todo['id'] ?>>
                    <button type='submit'>Delete ToDo</button><br><br>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="writeTodoToDatabase.php">Ajouter une nouvelle todo</a>

    <!-- WRITE YOUR HTML AND PHP TEMPLATING HERE -->

</body>

</html>