<?php
session_start();
require "_safety.php";
include '../AlteMenus/_funct.php';

if(isset($_POST['delete'])){
    header("Refresh:1.5; url=archiv.php");
    delData($_POST['delid'],$conn);
    echo'<div style="text-align: center; color:red">Eintrag wurde gelöscht</div><br><br>';
    $conn->close();
}
elseif (isset($_POST['nicht'])) {
    
    header('Location: archiv.php');
}

?>
<div style="text-align: center">Wirklich LÖSCHEN?</div>
<br>
<form method="post" target="self">
    <input type="hidden" value="<?php echo $_GET['id'] ?>" name="delid">
    <table align="center" border="0">
        <tr>
            <td><input type="submit" value="Ja" name="delete"></td>
            <td><input type="submit" value="Nicht Löschen" name="nicht"></td>
        </tr>
    </table>
</form>

