<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
    <div class="container">

        <?php
        $path = $_SERVER["DOCUMENT_ROOT"];
        include($path."/_header.php");
        include($path."/config/connection_database.php");

        global $pdo;
        // Prepare and execute the SELECT query
        $stmt = $pdo->prepare('SELECT id, name, description, image FROM categories');
        $stmt->execute();

        // Fetch all rows as an associative array
        $result = $stmt->fetchAll();
        ?>

        <?php echo "<h1 class='text-center'>Categories list</h1>" ?>
        <a href="/create.php" class="btn btn-success">Add</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($result as $item) {
            ?>
                <tr>
                    <th scope="row"><?php echo $item["id"]; ?></th>
                    <td>
                        <img src="/images/<?php echo $item["image"]; ?>" alt="Nature" width="100">
                    </td>
                    <td><?php echo $item["name"]; ?></td>
                    <td><?php echo $item["description"]; ?></td>
                    <td>
                        <a href="/edit.php?id=<?php echo $item["id"] ?>" class="btn btn-info">Edit</a>
                        <a href="/delete.php?id=<?php echo $item["id"] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>