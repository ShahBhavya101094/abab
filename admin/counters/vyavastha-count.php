<?php
    include '../includes/dbconn.php';

    $sql = "SELECT id FROM abab_vyavastha";
                $query = $mysqli->query($sql);
                echo "$query->num_rows";
?>