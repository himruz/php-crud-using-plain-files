<?php
require_once "inc/functions.php";

$task = $_GET['task'] ?? "report";
$error = $_GET['error'] ?? '0';
$info = "";

if ("seed" == $task) {
    seed();
    $info = "Seeding Complete !";
}
;

if (isset($_POST['submit'])) {
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $roll = $_POST['roll'];

    if ($fname != '' && $lname != '' && $roll != '') {
        $isStudentAdded = addStudent($fname, $lname, $roll);

        if ($isStudentAdded) {
            header('location: index.php?task=report');
        }else{
            header('location: index.php?task=report&error=1');
        }

        
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Example</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
    <style>
        body {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="column column-60 column-offset-20">
                <h2>Project- CRUD</h2>
                <p>A sample project to perform CRUD operations using plain files and PHP</p>

                <?php include_once('inc/templates/nav.php'); ?>
                <hr />
                <?php
                if ($info !== "") {
                    echo "<p>{$info}</p>";
                }
                ;
                ?>
            </div>
        </div>

        <?php if ("1" == $error): ?>
            <div class="row">
                <div class="column column-60 column-offset-20">
                    <blockquote>Duplicate Roll Found !</blockquote>
                </div>
            </div>
        <?php endif; ?>

        <?php if ("report" == $task): ?>
            <div class="row">
                <div class="column column-60 column-offset-20">
                    <?php generateReport(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ('add' == $task): ?>
            <div class="row">
                <div class="column column-60 column-offset-20">
                    <form action="index.php?report" method="POST">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname">
                        <label for="roll">Roll</label>
                        <input type="number" name="roll" id="roll">
                        <button type="submit" class="button-primary" value="save" name="submit">Save</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>