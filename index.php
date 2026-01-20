<?php
include('../Crud-basics/config/config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

$sql = "SELECT HAVE.Id
              ,HAVE.Rollercoaster
              ,HAVE.AmusementPark
              ,HAVE.Country
              ,HAVE.Topspeed
              ,HAVE.Height
              ,DATE_FORMAT(HAVE.YearOfConstruction, '%d-%m-%Y') AS YOFC
        FROM rollercoaster AS HAVE
        ORDER BY HAVE.Height DESC";

$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD-Basics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-10">
                <h2><u>Hoogste achtbanen van Europa</u></h2>
            </div>
        </div>

        <div class="row justify-content-center my-3">
    <div class="col-10">
        <h5>
            Nieuwe achtbaan
            <a href="./create.php">
                <i class="bi bi-plus-square text-danger"></i>
            </a>
        </h5>
    </div>
</div>

        <div class="row justify-content-center mt-3">
            <div class="col-10">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Naam Achtbaan</th>
                            <th>Naam Pretpark</th>
                            <th>Land</th>
                            <th>Topsnelheid (km/u)</th>
                            <th>Hoogte (m)</th>
                            <th>Bouwjaar</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $rollercoaster): ?>
                            <tr>
                                <td><?= $rollercoaster->Rollercoaster; ?></td>
                                <td><?= $rollercoaster->AmusementPark; ?></td>
                                <td><?= $rollercoaster->Country; ?></td>
                                <td><?= $rollercoaster->Topspeed; ?></td>
                                <td><?= $rollercoaster->Height; ?></td>
                                <td><?= $rollercoaster->YOFC; ?></td>
                                <td class="text-center">
    <a href="update.php?id=<?= $rollercoaster->Id; ?>">
        <i class="bi bi-pencil-square text-success"></i>
    </a>
</td>

                                <td>
                                    <a href="delete.php?id=<?= $rollercoaster->Id; ?>">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>