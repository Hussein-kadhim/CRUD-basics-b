<?php
include('../Crud-basics/config/config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

$sql = "DELETE FROM rollercoaster WHERE Id = :id";

$statement = $pdo->prepare($sql);
$statement->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

if ($statement->execute()) {
    header("Refresh:3; url=index.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete-Basics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="alert alert-success" role="alert">
                    Het record is succesvol verwijderd. Je wordt doorgestuurd naar de overzichtspagina.
                </div>
            </div>
        </div>
    </div>
</body>
</html>