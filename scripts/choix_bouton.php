<?php
if (isset($_POST['btnAction'])) {
switch($_POST['btnAction']) {
  case "Refuser":
    include 'ajoutSuppressionPendingBlacklist.php';
    break;
  case "Accepter":
    include 'ajoutSuppressionBlacklist.php?add=';
    break;
}
}
?>