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

$sql_select_options = "SELECT `degrees`.`id`, `degrees`.`name` FROM `degrees`";
$result_select_options = $conn->query("$sql_select_options");

/* $sql = "SELECT  `courses`.`period` AS `semester`, `courses`.`year`, `courses`.`name` AS `course`, `degrees`.`name` AS `degree`
FROM `courses`
JOIN `degrees` ON `degrees`.`id` = `courses`.`degree_id`
WHERE `courses`.`period`='I semestre' AND `courses`.`year`=1 AND `degrees`.`name`='Corso di Laurea in Biologia';"; //creo una query e la metto in una var
$result = $conn->query("$sql"); //method query: mi da un'altro oggetto/istanza che va salvato in un'altra var
 */
//var_dump($result);

//var_dump($result->fetch_all(MYSQLI_ASSOC));
//var_dump($result->fetch_assoc());
var_dump($_POST);
var_dump(empty($_POST));
var_dump(empty($_POST['degree']));

if (empty($_POST['degree'])) {

    $sql = "SELECT  `courses`.`period` AS `semester`, `courses`.`year`, `courses`.`name` AS `course`, `degrees`.`name` AS `degree`
    FROM `courses`
    JOIN `degrees` ON `degrees`.`id` = `courses`.`degree_id`
    WHERE `courses`.`period`='I semestre' AND `courses`.`year`=1;"; //creo una query e la metto in una var
    $result = $conn->query("$sql"); //method query: mi da un'altro oggetto/istanza che va salvato in un'altra var
} else {

    $degree = $_POST['degree'];
    $sql = "SELECT  `courses`.`period` AS `semester`, `courses`.`year`, `courses`.`name` AS `course`, `degrees`.`name` AS `degree`
    FROM `courses`
    JOIN `degrees` ON `degrees`.`id` = `courses`.`degree_id`
    WHERE `courses`.`period`='I semestre' AND `courses`.`year`=1 AND `degrees`.`id`=$degree;"; //creo una query e la metto in una var
    $result = $conn->query("$sql"); //method query: mi da un'altro oggetto/istanza che va salvato in un'altra var
}

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
    <header class="p-3 d-flex justify-content-between">


        <form action="" method="post">

            <select class="form-select" name="degree" id="degree">
                <option value="" selected>All Degrees</option>
                <?php while ($option = $result_select_options->fetch_assoc()) :
                    ['id' => $id, 'name' => $name] = $option ?>
                    <option value="<?= $id ?>"><?= $name ?></option>
                <?php endwhile ?>
            </select>

            <button class="btn btn-dark" type="submit">Select</button>

        </form>


        <div>
            <a href="index.php">Students</a>
            <a href="firstSem.php">First-Semester</a>
            <a href="degrees.php">Degrees</a>
        </div>

    </header>
    <main>
        <div class="container my-3">
            <div>Tot Results: <?= $result->num_rows ?></div>
            <div class="row row-cols-6">
                <?php while ($course = $result->fetch_assoc()) :
                    ['semester' => $semester, 'year' => $year, 'course' => $course_name, 'degree' => $degree] = $course ?>
                    <div class="col border border-1 border-black">
                        <p>degree: <strong><?= $degree ?></strong></p>
                        <p>course: <strong><?= $course_name ?></strong></p>
                        <p>semester: <strong><?= $semester ?></strong></p>
                        <p>year: <strong><?= $year ?></strong></p>
                    </div>
                <?php endwhile ?>
            </div>
        </div>
    </main>




</body>

</html>