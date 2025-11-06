<?php
session_start();
session_unset();
session_destroy();
?>

<script>
    alert('Logout successful!');
    window.location.href = 'index.php';
</script>
