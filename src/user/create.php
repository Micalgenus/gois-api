<?php
echo $_POST['admin_id'];
echo $_POST['admin_pw'];
?>

<form action="https://api.gois.me/user/create" method="post">
  <input type="text" name="admin_id" />
  <input type="text" name="admin_pw" />
  <input type="submit" />
</form>