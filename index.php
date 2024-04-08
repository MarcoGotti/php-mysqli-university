<?php

define('DB_SERVERNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'sql_1_university');

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn && $conn->connect_error) {
    echo 'connection failed: ' . $conn->connect_error;
}


/* $sql = "SELECT * FROM `students` WHERE YEAR(date_of_birth)=1990;"; //creo una query e la metto in una var
$result = $conn->query("$sql"); //method query: mi da un'altro oggetto/istanza che va salvato in un'altra var */

//var_dump($result->fetch_assoc());
//var_dump(empty($_POST['year']));

if (empty($_POST['year'])) {

    $sql = "SELECT * FROM `students`;"; //creo una query e la metto in una var
    $result = $conn->query("$sql"); //method query: mi da un'altro oggetto/istanza che va salvato in un'altra var
} else {
    $year = $_POST['year'];
    $sql = "SELECT * FROM `students` WHERE YEAR(date_of_birth)=$year;";
    $result = $conn->query("$sql");
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
            <input type="text" name="year" id="year" placeholder="Type a year YYYY">
            <button type="submit">search</button>
            <a href="./">Reset</a>
        </form>

        <div>
            <a href="index.php">Students</a>
            <a href="firstSem.php">First-Semester</a>
            <a href="degrees.php">Degrees</a>
        </div>

    </header>
    <main>
        <div class="container my-3">
            <div>Tot Results: <?php echo $result->num_rows ?></div>
            <div class="row row-cols-6">
                <?php while ($student = $result->fetch_assoc()) :
                    ['name' => $name, 'surname' => $lastname, 'date_of_birth' => $birthdate] = $student ?>
                    <div class="col border border-1 border-black">
                        <p>name: <strong><?= $name ?></strong></p>
                        <p>lastname: <strong><?= $lastname ?></strong></p>
                        <p>birthdate: <strong><?= $birthdate ?></strong></p>
                    </div>
                <?php endwhile ?>
            </div>
        </div>
    </main>




</body>

</html>