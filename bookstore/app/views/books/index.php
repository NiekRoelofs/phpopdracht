<?php
require APPROOT . "/views/includes/head.php";
require APPROOT . "/views/includes/navigation.php";
?>
<div class="pageinfo">
    <h1>Books list</h1>
</div>
<div id="table">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">EAN</th>
            <th scope="col">Edition</th>
            <th scope="col">Publication</th>
            <th scope="col">User</th>
        </tr>
        </thead>
        <tbody>
        <?php if (is_array($data["books"])) { //check if there are multiple books or just 1
            foreach ($data["books"] as $book) { ?>
                <tr>
                    <td><?php echo $book->getTitle(); ?></td>
                    <td><?php echo $book->getAuthor(); ?></td>
                    <td><?php echo $book->getEAN(); ?></td>
                    <td><?php echo $book->getEdition(); ?></td>
                    <td><?php echo $book->getPublication(); ?></td>
                    <td><?php echo $book->getUser(); ?></td>
                </tr>
            <?php }
        } elseif ($data["books"] != null) { ?>
            <td><?php echo $data["books"]->getTitle(); ?></td>
            <td><?php echo $data["books"]->getAuthor(); ?></td>
            <td><?php echo $data["books"]->getEAN(); ?></td>
            <td><?php echo $data["books"]->getEdition(); ?></td>
            <td><?php echo $data["books"]->getPublication(); ?></td>
            <td><?php echo $data["books"]->getUser(); ?></td>
        <?php } ?>

        </tbody>
    </table>
</div>
<?php if (isset($_SESSION["user_id"])) : ?>
    <form class="bookforms" action="<?php echo URLROOT; ?>/books/addbook">
        <input type="submit" value="Add book">
    </form>
    <form class="bookforms" action="<?php echo URLROOT; ?>/books/deletebook" method="POST">
        <label>Delete book from list with EAN code:</label>
        <input type="text" name="bookEAN" placeholder="EAN">
        <input type="submit" value="Delete book">
    </form>
<?php endif; ?>

