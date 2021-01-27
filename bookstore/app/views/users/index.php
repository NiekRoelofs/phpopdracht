<?php
require APPROOT . "/views/includes/head.php";
require APPROOT . "/views/includes/navigation.php";
?>
<h1>User List</h1>
<form method="get">
<input type="text" name="search">
    <label for="filterDropdown">Choose filter:</label>
    <select id="filterDropdown" name="filtertype">
        <option value="username">Username</option>
        <option value="email">Email</option>
        <option value="date">Date</option>
    </select>
<button type="submit">Filter</button>
</form>
<p id="formatdate">Use the yyyy/mm/dd format to filter on registration dates</p>

<div id="table">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Username</th>
      <th scope="col">Email Address</th>
      <th scope="col">Registration Date </th>
    </tr>
  </thead>
  <tbody>
  <?php if(is_array($data["users"])) { //check if there are multiple users or just 1
      foreach ($data["users"] as $user) { ?>
    <tr>
      <td><?php echo $user->getId(); ?></td>
      <td><?php echo $user->getName(); ?></td>
      <td><?php echo $user->getEmail(); ?></td>
      <td><?php echo $user->getRegistrationDate(); ?></td>
    </tr>
  <?php } } elseif($data["users"] != null) { ?>
        <td><?php echo $data["users"]->getId(); ?></td>
        <td><?php echo $data["users"]->getName(); ?></td>
        <td><?php echo $data["users"]->getEmail(); ?></td>
        <td><?php echo $data["users"]->getRegistrationDate(); ?></td>
  <?php } ?>

  </tbody>
</table>
</div>



