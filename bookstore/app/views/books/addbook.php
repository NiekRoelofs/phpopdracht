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
                <td><input type="text" name="title" size="40"></td>
                <td class="invalidInput"><?php echo $data["titleError"]; ?></td>
            </tr>
            <tr>
                <td> Enter Author :</td>
                <td><input type="text" name="author" size="40"></td>
                <td class="invalidInput"><?php echo $data["authorError"]; ?></td>
            </tr>
            <tr>
                <td> Enter EAN :</td>
                <td><input type="text" name="EAN" size="40"></td>
                <td class="invalidInput"><?php echo $data["EANError"]; ?></td>
            </tr>
            <tr>
                <td> Enter Edition :</td>
                <td><input type="text" name="edition" size="40"></td>
                <td class="invalidInput"><?php echo $data["editionError"]; ?></td>
            </tr>
            <tr>
                <td> Enter Publication:</td>
                <td><input type="text" name="publication" size="40"></td>
                <td class="invalidInput"><?php echo $data["publicationError"]; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Add book">
                    <input type="reset" value="Clear">
                </td>
            </tr>
        </table>
    </form>
</div>
