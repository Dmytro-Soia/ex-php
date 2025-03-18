<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to your first PHP page</title>
</head>
<body>
<h1>Some php exercises</h1>
<p>PHP is a dynamic language that can be used to generate html pages and respond to http requests.</p>
<p>You need to implement 3 special php pages</p>
<ul>
    <li>
        <a href="getCurrentTime.php">Get the current time</a>
        <p>
            <i>
                This page should return the current time with second precision. The page file is already created, you
                just have to complete it. The test expect two tag to be present in the page.
                A h1 with the time formatted in this format 2023-11-12 12:15:44.
            </i>
        </p>
    </li>
    <li>
        <a href="queryParameterDisplay.php?name=toto&age=20">Display url parameters</a>
        <p>
            <i>
                This page should display in a h1 the two parameters passed in the url query string
                formatted as follows : Toto is 20 years old.
                The query string parameters accepted are name and age. If there is no query string parameter
                the page should display in a h1 "No query parameters found". And the missing parameters should be
                indicated in a list just below the h1. Ex. if the name is missing, you display "Missing name" in the list.
            </i>
        </p>
    </li>
    <li>
        <a href="formManagement.php">Form management</a>
        <p>
            <i>
                On this page, you should display a form with two fields, one for the Name and one for the Age.
                The server should respond to the form submission by displaying the same page with the name and age in a h1 "Toto is 20 years old".
                If there is no submission or only one of the two fields, the h1 should display "Submit the form".
                If the user have a name with more than 6 characters, the name must be displayed in red (only the name, not all h1).
                If the user is more than 18 years old, you should display a list with one line per year of the age of the user.
                The data submitted should remain displayed in the form after the submission.
                (Your form should be semantically correct, use a label and name your fields)
            </i>
        </p>
    </li>
    <li>
        <a href="writeTodoToDatabase.php">Create a todo and insert it in the database</a>
        <p>
            <i>
                On this page, you will create a simple form that allows user to create todos (with a name and a date).
                The form should be submited to this PHP page.
                Then, the PHP code should verifiy the user inputs (html sanitize, minimum length...)
                If the user input is valid, add the todo information to the sqlite database (on the table todo)
                If the user input is invalid, display an error to the user
            </i>
        </p>
    </li>
    <li>
        <a href="displayAllTodosFromDatabase.php">Show the list of all todos (with sort filter)</a>
        <p>
            <i>
                On this page, have to display the list of todolists in chronlogical order.
                Get the todos from the sqlite database, and display them in a list.
                You need to add some query parameters to the page to order by date or name.
            </i>
        </p>
    </li>
    <li>
        <a href="deleteTodoFromDatabase.php?id=1">Delete a todo from the database</a>
        <p>
            <i>
                On this page, you need to handle the deletion of a todo from the database.
                The id of the todo to delete will be passed as a query parameter.
            </i>
        </p>
    </li>
</ul>
</body>
</html>