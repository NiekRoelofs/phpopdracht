<?php
require APPROOT . "/views/includes/head.php";
require APPROOT . "/views/includes/navigation.php";
?>
<div class="pageinfo">
    <h1>Add book</h1>
</div>
<div>
    <form action="<?php echo URLROOT; ?>/books/addbook" method="POST">

        <table class="table">
            <tr>
                <td> Enter Title :</td>
                <td><input id="title" type="text" name="title" size="40"></td>
                <td class="invalidInput"><?php echo $data["titleError"]; ?></td>
            </tr>
            <tr>
                <td> Enter Author :</td>
                <td><input id="author" type="text" name="author" size="40"></td>
                <td class="invalidInput"><?php echo $data["authorError"]; ?></td>
            </tr>
            <tr>
                <td> Enter EAN :</td>
                <td><input id="EAN" type="text" name="EAN" size="40"></td>
                <td class="invalidInput"><?php echo $data["EANError"]; ?></td>
            </tr>
            <tr>
                <td> Enter Edition :</td>
                <td><input id="edition" type="text" name="edition" size="40"></td>
                <td class="invalidInput"><?php echo $data["editionError"]; ?></td>
            </tr>
            <tr>
                <td> Enter Publication:</td>
                <td><input id="publication" type="text" name="publication" size="40"></td>
                <td class="invalidInput"><?php echo $data["publicationError"]; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input id="addbook" type="submit" value="Add book">
                    <input id="clearfields" type="reset" value="Clear">
                </td>
            </tr>
        </table>
    </form>
</div>
<?php
if (isset($_POST["title"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $EAN = $_POST["EAN"];
    $edition = $_POST["edition"];
    $publication = $_POST["publication"];

    echo "<script>
            document.getElementById('title').value = '$title';
            document.getElementById('author').value = '$author';
            document.getElementById('EAN').value = '$EAN';
            document.getElementById('edition').value = '$edition';
            document.getElementById('publication').value = '$publication';
                </script>";
}

require APPROOT . "/views/includes/footer.php";
?>
