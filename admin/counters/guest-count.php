<?php
    include '../includes/dbconn.php';

    $sql = "SELECT id FROM abab_guest_booking";
                $query = $mysqli->query($sql);
                echo "$query->num_rows";
?>