<?php
$errMsgN = $errImg = $showImg = $errDesc = "";

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];

    $image_name="";
    if(isset($_FILES["image"])) {
        $image_name = uniqid().".jpg";
        $save_image = $_SERVER["DOCUMENT_ROOT"]."/images/".$image_name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $save_image);
    }
    if (empty($_POST["name"])) {
        $errMsgN = "Error! You didn't enter the Name.";
    }
    if (empty($_POST["description"])) {
        $errDesc = "Error! You didn't enter the description.";
    }
    include($_SERVER["DOCUMENT_ROOT"]."/config/connection_database.php");
    global $pdo;
    $sql = "INSERT INTO categories (name, image, description) VALUES (?, ?, ?)";
    if(isset($_POST['submit'])) {
        if ($errMsgN == "" && $errImg == "" && $errDesc == "") {
            $command = $pdo->prepare($sql);
            $command->execute([$name, $image_name, $description]);
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
    <title>Add form</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <?php
    $path = $_SERVER["DOCUMENT_ROOT"];
    include($path . "/_header.php");
    ?>

    <?php echo "<h1 class='text-center'>Add category</h1>" ?>

    <form method="post" enctype="multipart/form-data" class="offset-md-3 col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
            <span>* <?php echo $errMsgN; ?></span>
        </div>

        <div class="mb-3 d-flex flex-column gap-1 align-items-center">
            <label for="image" class="form-label">Image</label>
            <input onchange="addPhoto()" required type="file" class="form-control" id="image" name="image">
            <label for="image">
                <img src="" id="select_img" alt="select image" width="200" />
            </label>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" rows="5" id="description" name="description"></textarea>
            <span>* <?php echo $errDesc; ?></span>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Add</button>
    </form>

</div>
<script src="/js/bootstrap.bundle.min.js"></script>
<script>
    function addPhoto() {
        const reader = new FileReader()

        let files = document.getElementById('image').files
        reader.onload = async (event) => {
            document.getElementById('select_img').setAttribute('src', event.target.result)
        }
        reader.readAsDataURL(files[0])
    }
</script>
</body>
</html>