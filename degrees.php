<?php
require_once __DIR__ . '/layouts/head.php';


$sql = "SELECT `degrees`.`id`, `degrees`.`name` AS `degree`,`courses`.`name` AS `course`, `teachers`.`surname`, `teachers`.`name`
FROM `degrees`
JOIN `courses` ON `courses`.`degree_id` = degrees.id 
JOIN `course_teacher` ON `course_teacher`.`course_id`=`courses`.`id`
JOIN `teachers` ON `course_teacher`.`teacher_id`=`teachers`.`id`
ORDER BY `degrees`.`name`;";
$result = $conn->query("$sql");

?>



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