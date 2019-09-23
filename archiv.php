<?php
session_start();
include_once "_safety.php";
include '../AlteMenus/_funct.php';

if(isset($_POST["choose"])){
    $choose = $_POST["choose"];
}
else {
    $choose = false;
}
if(isset($_POST["all"])){ $choose = false;}

$data = getData($conn, $choose);
$counter = 0;

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Archiv</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/css.css" media="screen" /> 
        <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
        <link rel="shortcut icon" type="image/x-icon" href="http://lekker-lekker.ch/wp-content/uploads/2018/02/cropped-ms-icon-310x310.png"> 
    </head>
    <body>
        <?php include 'navi.html'; ?>
        <form method="post" target="self">
            <?php setChoose() ?>
            <table align="center" border="0">
                <tr>
                    <td><input type="submit" value="Sortieren"></td>
                    <td><input type="submit" value="Alle Anzeigen" name="all"></td>
                </tr>
            </table>            
        </form>
        <div class="warper">
            <table align="center" class="tg">
                <tr class="titelarchiv">
                  <th class="tg-0lax" style="text-align: center">Menü</th>
                  <th class="tg-0lax" style="text-align: center">Datum</th>
                  <th class="tg-0lax" style="text-align: center">#</th>
                </tr>

                <?php while($row = $data->fetch(PDO::FETCH_LAZY)){?>
                <tr style="color: #111; background:<?php echo ($counter & 1 ? '#cccccc' : 'aliceblue'); ?>">
                  <td class="tg-0lax"><?php echo nl2br($row->menu) ?></td>
                  <td class="tg-0lax"><?php echo $row->mydate ?></td>
                  <td class="tg-0lax"><a class="x" href="del.php?id=<?php echo $row->id ?>">X</a></td>
                </tr>
                <?php
                    $counter++;
                    };
                    ?>
            </table>
        </div>
    </body>
</html>
<?php
$conn->close();