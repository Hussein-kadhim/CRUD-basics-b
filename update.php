<?php
/**
 * update.php
 * - Haalt record op via GET id (eerste keer laden)
 * - Toont record in formulier
 * - Bij submit: update record met bindValue()
 * - Toont succesmelding en stuurt na 3 sec door naar index.php
 */

include('../Crud-basics/config/config.php');

$display = 'none';
$result  = null;

/**
 * DSN + PDO verbinding
 */
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/**
 * Check submit
 */
if (isset($_POST['submit'])) {

    // POST opschonen
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    /**
     * Update-query met placeholders
     */
    $sql = "UPDATE rollercoaster
            SET Rollercoaster      = :rollerCoaster,
                AmusementPark      = :amusementPark,
                Country            = :country,
                Topspeed           = :topSpeed,
                Height             = :height,
                YearOfConstruction = :yearOfConstruction
            WHERE Id = :id";

    $statement = $pdo->prepare($sql);

    /**
     * Koppel placeholders aan POST-waarden + datatype
     */
    $statement->bindValue(':rollerCoaster', $_POST['naamAchtbaan'], PDO::PARAM_STR);
    $statement->bindValue(':amusementPark', $_POST['naamPretpark'], PDO::PARAM_STR);
    $statement->bindValue(':country', $_POST['land'], PDO::PARAM_STR);
    $statement->bindValue(':topSpeed', $_POST['topsnelheid'], PDO::PARAM_INT);
    $statement->bindValue(':height', $_POST['hoogte'], PDO::PARAM_INT);
    $statement->bindValue(':yearOfConstruction', $_POST['bouwjaar'], PDO::PARAM_STR);
    $statement->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

    /**
     * Voer de geprepareerde sql-query uit
     */
    $statement->execute();

    /**
     * Zet de melding aan dat de update is gelukt + stuur door
     */
    $display = 'flex';
    header("Refresh:3; index.php");

} else {

    /**
     * Geen submit: record ophalen via GET id
     */
    $id = $_GET['id'] ?? null;

    if ($id === null) {
        die("Geen id meegegeven.");
    }

    $sql = "SELECT Id,
                   Rollercoaster,
                   AmusementPark,
                   Country,
                   Topspeed,
                   Height,
                   YearOfConstruction
            FROM rollercoaster
            WHERE Id = :id";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_OBJ);

    if (!$result) {
        die("Record niet gevonden.");
    }

    // Commentarieer de var_dump weer uit (opdracht)
    // var_dump($result);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
<div class="container mt-3">

    <!-- Titel van de pagina -->
    <div class="row justify-content-center">
        <div class="col-6">
            <h3 class="text-primary">Wijzig de achtbaangegevens:</h3>
        </div>
    </div>

    <!-- Melding naar de gebruiker dat de update is gelukt (opdracht regel 127 t/m 134) -->
    <div class="row justify-content-center" style="display: <?= $display ?? 'none' ?>;">
        <div class="col-6">
            <div class="alert alert-success text-center" role="alert">
                De gegevens zijn gewijzigd. U wordt teruggestuurd naar de index-pagina.
            </div>
        </div>
    </div>

    <!-- Het update-formulier -->
    <div class="row justify-content-center">
        <div class="col-6">

            <form action="update.php" method="POST">

                <!-- Hidden id (opdracht) -->
                <input name="id" type="hidden" value="<?= $result->Id ?? ($_POST['id'] ?? '') ?>">

                <div class="mb-3">
                    <label for="inputNaamAchtbaan" class="form-label">Naam Achtbaan:</label>
                    <input name="naamAchtbaan"
                           placeholder="Vul de naam van de achtbaan in"
                           type="text"
                           class="form-control"
                           id="inputNaamAchtbaan"
                           value="<?= $result->Rollercoaster ?? ($_POST['naamAchtbaan'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="inputNaamPretpark" class="form-label">Naam Pretpark:</label>
                    <input name="naamPretpark"
                           placeholder="Vul de naam van het pretpark in"
                           type="text"
                           class="form-control"
                           id="inputNaamPretpark"
                           value="<?= $result->AmusementPark ?? ($_POST['naamPretpark'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="inputLand" class="form-label">Land:</label>
                    <input name="land"
                           placeholder="Vul de naam van het land in"
                           type="text"
                           class="form-control"
                           id="inputLand"
                           value="<?= $result->Country ?? ($_POST['land'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="inputTopsnelheid" class="form-label">Topsnelheid:</label>
                    <input name="topsnelheid"
                           placeholder="Vul de topsnelheid in"
                           type="number"
                           min="0"
                           max="255"
                           class="form-control"
                           id="inputTopsnelheid"
                           value="<?= $result->Topspeed ?? ($_POST['topsnelheid'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="inputHoogte" class="form-label">Hoogte:</label>
                    <input name="hoogte"
                           placeholder="Vul de hoogte in"
                           type="number"
                           min="0"
                           max="255"
                           class="form-control"
                           id="inputHoogte"
                           value="<?= $result->Height ?? ($_POST['hoogte'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="inputYearOfConstruction" class="form-label">Bouwjaar:</label>
                    <input name="bouwjaar"
                           placeholder="Vul het bouwjaar in"
                           type="date"
                           class="form-control"
                           id="inputYearOfConstruction"
                           value="<?= $result->YearOfConstruction ?? ($_POST['bouwjaar'] ?? '') ?>">
                </div>

                <div class="d-grid gap-2">
                    <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2">
                        Verstuur
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Terugknop -->
    <div class="row justify-content-center mt-3">
        <div class="col-6">
            <a href="index.php">
                <i class="bi bi-arrow-left-square-fill text-danger" style="font-size: 1.5em"></i>
            </a>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
