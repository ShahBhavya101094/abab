<?php
    include '../includes/dbconn.php';

    $sql = "SELECT id FROM user_reg";
                $query = $mysqli->query($sql);
                echo "$query->num_rows";
?>