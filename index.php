<?php
require_once __DIR__ . '/layouts/head.php';



if (isset($_POST['year']) && !is_numeric($_POST['year'])) {

    $sql = "SELECT * FROM `students`;";
    $result = $conn->query("$sql");
    echo 'not a number';
} elseif (empty($_POST['year'])) {

    $sql = "SELECT * FROM `students`;"; //creo una query e la metto in una var
    $result = $conn->query("$sql"); //method query: mi da un'altro oggetto/istanza che va salvato in un'altra var
} else {
    $year = $_POST['year'];
    $sql = "SELECT * FROM `students` WHERE YEAR(date_of_birth)=$year;";
    $result = $conn->query("$sql");
}

?>


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