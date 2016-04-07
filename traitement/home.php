<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <p><?php echo 'Salut ' . $_SESSION['username']; ?></p>
    </body>
</html>