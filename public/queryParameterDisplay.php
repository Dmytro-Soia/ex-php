<?php
/**
 * Get the values from the GET parameters with filter_input function
 */
$name = filter_input(INPUT_GET, "name");
$age = filter_input(INPUT_GET,"age");
function cheking($name, $age) {
    if ($name && $age) {
    echo "$name is $age years old";
    } else {
    echo 'No query parameters found';
    }}
    
function chekingParam($name, $age) {
        if(!$name && !$age) {
            echo "<ul>";
            echo '<li>Missing name</li>';
            echo '<li>Missing age</li>';
        } else if (!$name) {
            echo '<li>Missing name</li>';
        }else if (!$age) {
            echo '<li>Missing age</li>';
        }
        echo "</ul>";
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
<h1><?=cheking($name, $age)?></h1>
<p><?=chekingParam($name, $age)?></p>    
<!-- Display message in list element in case of missing parameters -->

</body>
</html>