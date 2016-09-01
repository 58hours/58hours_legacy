<?php
setcookie ("client_id_hash", "", time() - 3600);
setcookie ("client_pass_hash", "", time() - 3600);
header("Location: ".$_SERVER['HTTP_REFERER']); /* Redirect browser */
?>