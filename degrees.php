<?php

define('DB_SERVERNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'sql_1_university');

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn && $conn->connect_error) {
    echo 'connection failed: ' . $conn->connect_error;
}

//var_dump($conn);

$sql = "SELECT `degrees`.`id`, `degrees`.`name` AS `degree`
FROM `degrees`;"; //creo una query e la metto in una var
$result = $conn->query("$sql"); //method query: mi da un'altro oggetto/istanza che va salvato in un'altra var

var_dump($result);

//var_dump($result->fetch_all(MYSQLI_ASSOC));
var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc());


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

    <header class="p-3">
        <a href="index.php">Students</a>
        <a href="firstSem.php">First-Semester</a>
        <a href="degrees.php">Degrees</a>
    </header>

    <main>
        <div class="container my-3">
            <div>Tot Results: <?= $result->num_rows ?></div>
            <div class="row row-cols-3">
                <?php while ($degree = $result->fetch_assoc()) :
                    ['degree' => $degree, 'id' => $id] = $degree ?>
                    <div class="col border border-1 border-black">


                        <p><strong><?= $id . '. ' . $degree ?></strong></p>

                        <?php


                        $sql_courses = "SELECT `courses`.`name` AS `course` FROM `degrees` JOIN `courses` ON `courses`.`degree_id` = degrees.id WHERE `degrees`.`id`= $id;"; //creo una query e la metto in una var
                        $result_courses = $conn->query("$sql_courses");

                        while ($course = $result_courses->fetch_assoc()) : ?>

                            <div><?= $course['course'] ?></div>

                        <?php endwhile ?>


                    </div>
                <?php endwhile ?>
            </div>
        </div>
    </main>




</body>

</html>