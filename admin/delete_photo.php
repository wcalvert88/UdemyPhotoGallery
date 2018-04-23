<?php include("includes/init.php");
if(!$session->is_signed_in()) {
    redirect("login.php");
}
echo "it works";
?>