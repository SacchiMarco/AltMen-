<?php
session_start();
require "_safety.php";
include '../AlteMenus/_funct.php';
$dailyMsg = "";

if (isset ($_POST["submit"]) && !empty ($_POST["submit"]))
{
    $dailyText = $_POST["daily"];
    $dailyPreis = $_POST["chf"];
    $dailySuppe = $_POST["daily-suppe"];
    $dailyDay = $_POST["daily-day"];
    $archivEintrag = $dailyText . "\nCHF " . $dailyPreis;


    if ($_POST["daily-to-archiv"] === "on")
    {
        newAltMenu($archivEintrag, $conn, 1);
    }

    setDailyMenu($conn, $dailyText, $dailyPreis, $dailySuppe, $dailyDay);
    $dailyMsg = "Menü wurde Gespeichert.";
}

$data = getDailyMenu($conn);
$row = $data->fetch(PDO::FETCH_LAZY);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/daily.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link rel="shortcut icon" type="image/x-icon"
        href="http://lekker-lekker.ch/wp-content/uploads/2018/02/cropped-ms-icon-310x310.png">
    <title>Daily Special</title>
</head>

<body>
    <?php
    include 'navi.html';
    ?>
    <div class="daily-msg">
        <p><?php echo $dailyMsg; ?></p>
    </div>
    <div class="daily-form">
        <form action="daily.php" method="POST">
            <div class="daily-day">
                <p>Tag:</p>
                <select class="daily-box" name="daily-day">
                    <option value="Montag" <?php checkTag("Montag", $row->tag); ?>>Montag</option>
                    <option value="Dienstag" <?php checkTag("Dienstag", $row->tag); ?>>Dienstag</option>
                    <option value="Mittwoch" <?php checkTag("Mittwoch", $row->tag); ?>>Mittwoch</option>
                    <option value="Donnerstag" <?php checkTag("Donnerstag", $row->tag); ?>>Donnerstag</option>
                    <option value="Freitag" <?php checkTag("Freitag", $row->tag); ?>>Freitag</option>
                    <option value="Samstag" <?php checkTag("Samstag", $row->tag); ?>>Samstag</option>
                    <option value="Sonntag" <?php checkTag("Sonntag", $row->tag); ?>>Sonntag</option>
                </select>
            </div>
            <p>Daily Menü:</p>
            <textarea class="daily-box" name="daily" id="daily" cols="30" rows="10"><?php echo $row->menu; ?></textarea>
            <div class="daily-preis">
                <p>Menüpreis - CHF:</p>
                <input class="daily-box" type="tel" name="chf" id="chf" value="<?php echo $row->preis; ?>">
            </div>

            <div class="daily-to-archiv-text">Menü im Archiv speichern?
                <input class="daily-checkbox daily-box" type="checkbox" name="daily-to-archiv" id="daily-to-archiv">
            </div>

            <div class="daily-suppe">
                <p>Tagessuppe:</p>
                <input class="daily-box" type="text" name="daily-suppe" id="daily-suppe"
                    value="<?php echo $row->suppe; ?>">
            </div>
            <button class="daily-box" name="submit" value="true" type="submit">Speichern</button>
        </form>
    </div>

</body>

</html>