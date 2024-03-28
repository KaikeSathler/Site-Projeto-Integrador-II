<?php if (!isset($_SESSION['ARTESDB_SESSION'])){ session_start(); };

    session_destroy();
    header("Location: /index.php");
    
?>