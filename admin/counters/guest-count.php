<?php
    include '../includes/dbconn.php';

    $sql = "SELECT id FROM guest_details";
                $query = $mysqli->query($sql);
                echo "$query->num_rows";
?>