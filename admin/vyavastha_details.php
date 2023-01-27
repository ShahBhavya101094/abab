<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<!-- By Vkendra - Vkendra.com -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>ABAB Vyavastha Registration - PRINT</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">

    <script>
    function getSeater(val) {
        $.ajax({
            type: "POST",
            url: "get-seater.php",
            data: 'roomid=' + val,
            success: function(data) {
                //alert(data);
                $('#seater').val(data);
            }
        });

        $.ajax({
            type: "POST",
            url: "get-seater.php",
            data: 'rid=' + val,
            success: function(data) {
                //alert(data);
                $('#fpm').val(data);
            }
        });
    }
    </script>
    <style>
    .required .card-title:after {
        color: #d00;
        content: "*";
        position: absolute;
        margin-left: 3px;
        top: 7px;
    }
    </style>
    <!-- By Vkendra - Vkendra.com -->
    <style type="text/css">
    .tg {
        border-collapse: collapse;
        border-spacing: 0;
    }

    .tg td {
        border-color: black;
        border-style: solid;
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }

    .tg th {
        border-color: black;
        border-style: solid;
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }

    .tg .tg-0pky {
        border-color: inherit;
        text-align: left;
        vertical-align: top
    }

    .tg .tg-0lax {
        text-align: left;
        vertical-align: top
    }
    </style>
</head>
<div class="d-flex justify-content-center align-items-center" style="height:100px;">
    <div class="bg-primary"><input type="button"class="btn btn-danger center" onClick="window.print()" value="Print The Report"/></div>    
</div>
<div class="d-flex justify-content-center align-items-center" style="height:100px;">
    <div >Please keep Aadhaarcard with you during your visit to Somnath ABAB</div>    
</div>
<body>
    <?php
                   
                    $gid = $_GET['gid'];
                    $ret = "SELECT * FROM `abab_vyavastha` where id=? ";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->bind_param('i', $gid);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    //$cnt=1;
                    while ($row = $res->fetch_object()) {
                    ?>
    <table class="table" width="100%">
        
            <tr>
                <th  colspan="2" width="80%" >
                    <h1 class="d-flex justify-content-center align-items-center">ABAB Vyavastha Registration Details</h1>
                </th>
                <th class="tg-0lax"><img src="../includes/qrcodepic.php?data=GUEST:<?php echo $row->qr_code_id; ?>"></img></th>
            </tr>
    </table>
    <table class="table" width="100%">

        <tbody>
            <tr>
                <th class="tg-0pky">Full Name :</th>
                <td class="tg-0pky" colspan="2" width="80%"> <?php echo $row->name; ?></td>
            </tr>
            <tr>
                <th class="tg-0pky">Gender :</th>
                <td class="tg-0pky" colspan="2"> <?php echo $row->gender; ?></td>
            </tr>
            <tr>
                <th class="tg-0pky">Mobile : </th>
                <td class="tg-0pky" colspan="2"> <?php echo $row->mobile; ?></td>
            </tr>
            <tr>
                <th class="tg-0pky">Sub Team : </th>
                <td class="tg-0pky" colspan="2"> <?php echo $row->sub_team; ?></td>
            </tr>
            <tr>
                <th class="tg-0pky">No of Days : </th>
                <td class="tg-0pky" colspan="2"> <?php echo $row->no_days; ?></td>
            </tr>
            <tr>
                <th class="tg-0lax">Arrival Details</th>
                <td class="tg-0pky" colspan="2"> Date - <?php echo $row->date_arrival; ?> </td>
            </tr>
            <tr>
                <th class="tg-0lax">Departure Details</th>
                <td class="tg-0pky" colspan="2">  <?php echo $row->date_departure; ?> </td>
            </tr>
            <tr>
                <th class="tg-0lax">Status</th>
                <td class="tg-0pky" colspan="2"> Date - <?php echo $row->status; ?> </td>
            </tr>
        </tbody>
    </table>


    <?php
                    }
                    ?>

<div class="d-flex justify-content-center align-items-center" style="height:100px;">
    <div class="bg-primary"><input type="button"class="btn btn-danger center" onClick="window.print()" value="Print The Report"/></div>    
</div>