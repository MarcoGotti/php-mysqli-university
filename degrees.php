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

$sql = "SELECT `degrees`.`id`, `degrees`.`name` AS `degree`,`courses`.`name` AS `course`, `teachers`.`surname`, `teachers`.`name`
FROM `degrees`
JOIN `courses` ON `courses`.`degree_id` = degrees.id 
JOIN `course_teacher` ON `course_teacher`.`course_id`=`courses`.`id`
JOIN `teachers` ON `course_teacher`.`teacher_id`=`teachers`.`id`
ORDER BY `degrees`.`name`;"; //creo una query e la metto in una var
$result = $conn->query("$sql"); //method query: mi da un'altro oggetto/istanza che va salvato in un'altra var

//var_dump($result);

//var_dump($result->fetch_all(MYSQLI_ASSOC));
//var_dump($result->fetch_assoc());
//var_dump($result->fetch_assoc());


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

            <div class="row">
                <?php $currentDegree = '';
                while ($item = $result->fetch_assoc()) :

                    ['degree' => $degree, 'id' => $id, 'course' => $course, 'name' => $name, 'surname' => $surname] = $item;


                    if ($degree != $currentDegree) {
                        echo '<div class="col-12"><h4>' . $degree . '</h4></div>';
                        $currentDegree = $degree;
                    } ?>


                    <div class="col-6 d-flex justify-content-between  border border-1 border-black">

                        <span><strong><?= $course ?></strong></span>
                        <span class="">Prof. <?= $name . ' ' . $surname ?></span>

                    </div>
                <?php endwhile ?>
            </div>
        </div>
    </main>




</body>

</html>