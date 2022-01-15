<?php
session_unset();
session_destroy();
unset($menu);
header("Location: index.php?menu=home");
?>