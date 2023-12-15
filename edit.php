<?php
$errMsgN = $errImg = $errDesc = "";
$id = $_GET['id'];
$name = $_GET['name'];

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];

    $image_name="";
    if(isset($_FILES["image"])) {
        $image_name = uniqid().".jpg";
        $save_image = $_SERVER["DOCUMENT_ROOT"]."/images/".$image_name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $save_image); //зберігаємо фото на сервер
    }
    if (empty($_POST["name"])) {
        $errMsgN = "Error! You didn't enter the Name.";
    }
    if (empty($_POST["description"])) {
        $errDesc = "Error! You didn't enter the description.";
    }
    include($_SERVER["DOCUMENT_ROOT"]."/config/connection_database.php");
    global $pdo;
    $sql = "UPDATE categories set name = '$name', image = '$image_name', description = '$description' WHERE id = '$id' ";
    if(isset($_POST['submit'])) {
        if ($errMsgN == "" && $errImg == "" && $errDesc == "") {
            $command = $pdo->prepare($sql);
            $command->execute();
            header("Location: " . "/");
            exit;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit form</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <?php
    $path = $_SERVER["DOCUMENT_ROOT"];
    include($path . "/_header.php");
    ?>

    <?php echo "<h1 class='text-center'>Edit category</h1>" ?>

    <form method="post" enctype="multipart/form-data" class="offset-md-3 col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
            <span>* <?php echo $errMsgN; ?></span>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input required type="file" class="form-control" id="image" name="image">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" rows="5" id="description" name="description"></textarea>
            <span>* <?php echo $errDesc; ?></span>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
    </form>

</div>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>