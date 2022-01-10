<?php
session_start();
session_destroy();
header ('location:dem_acc.php');
?>