<?php
require_once __DIR__ . '/layouts/head.php';

//populate select options
$sql_select_options = "SELECT `degrees`.`id`, `degrees`.`name` FROM `degrees`";
$result_select_options = $conn->query("$sql_select_options");


//Filters
if (empty($_POST['degree'])) {

    $sql = "SELECT  `courses`.`period` AS `semester`, `courses`.`year`, `courses`.`name` AS `course`, `degrees`.`name` AS `degree`
    FROM `courses`
    JOIN `degrees` ON `degrees`.`id` = `courses`.`degree_id`
    WHERE `courses`.`period`='I semestre' AND `courses`.`year`=1;";
    $result = $conn->query("$sql");
} else {

    $degree = $_POST['degree'];
    $sql = "SELECT  `courses`.`period` AS `semester`, `courses`.`year`, `courses`.`name` AS `course`, `degrees`.`name` AS `degree`
    FROM `courses`
    JOIN `degrees` ON `degrees`.`id` = `courses`.`degree_id`
    WHERE `courses`.`period`='I semestre' AND `courses`.`year`=1 AND `degrees`.`id`=$degree;";
    $result = $conn->query("$sql");
}

?>


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