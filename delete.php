<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $id = $_GET['id'];

    include($_SERVER["DOCUMENT_ROOT"]."/config/connection_database.php");
    global $pdo;
    $sql = "DELETE FROM categories WHERE id = '$id'";
    $command = $pdo->prepare($sql);
    $command->execute();
    header("Location: " . "/");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete form</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        .center {
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            margin: auto;
            position: absolute;
            width: fit-content;
            height: fit-content;
        }

        #pop {
            padding: 15px;
            width: 20%;
            gap: 15px;
            border-radius: 10px;
            color: black;
            font-size: 32px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $path = $_SERVER["DOCUMENT_ROOT"];
        include($path . "/_header.php");
        ?>

        <form method="post">
            <div id="pop" class="d-flex flex-column center align-items-center">
                <label>Are you sure?</label>
                <div>
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <a href="/index.php" class="btn btn-success">No</a>
                </div>
            </div>
        </form>
    </div>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>