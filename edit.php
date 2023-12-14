<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $id = $_GET['id'];

    $image_name="";
    if(isset($_FILES["image"])) {
        $image_name = uniqid().".jpg";
        $save_image = $_SERVER["DOCUMENT_ROOT"]."/images/".$image_name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $save_image); //зберігаємо фото на сервер
    }
    include($_SERVER["DOCUMENT_ROOT"]."/config/connection_database.php");
    global $pdo;
    $sql = "UPDATE categories set name = '$name', image = '$image_name', description = '$description' WHERE id = '$id' ";
    $command = $pdo->prepare($sql);
    $command->execute();
    header("Location /");
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
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" rows="5" id="description" name="description"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>

</div>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>