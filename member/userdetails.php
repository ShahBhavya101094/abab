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
    <title>ABAB Adhikari Registration - PRINT</title>
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
    <div class="bg-primary"><input type="button" class="btn btn-danger center" onClick="window.print()" value="Print The Report" /></div>
</div>
<div class="d-flex justify-content-center align-items-center" style="height:100px;">
    <div>Please keep Aadhaarcard with you during your visit to Somnath ABAB</div>
</div>

<body>
    <?php
    $aid = $_SESSION['id'];
    $ret = "SELECT d.*,p.* from user_reg as d,abab_booking as p where d.id = p.uid and uid=?";
    $stmt = $mysqli->prepare($ret);
    $stmt->bind_param('i', $aid);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    //$cnt=1;
    while ($row = $res->fetch_object()) {
    ?>
        <table class="table" width="100%">

            <tr>
                <th colspan="2" width="80%">
                    <h1 class="d-flex justify-content-center align-items-center">ABAB Adhikari Registration Details</h1>
                </th>
                <th class="tg-0lax"><img src="../includes/qrcodepic.php?data=USER:<?php echo $row->qr_code_id; ?>"></img></th>
            </tr>
        </table>
        <table class="table" width="100%">

            <tbody>
                <tr>
                    <th class="tg-0pky">Full Name :</th>
                    <td class="tg-0pky" colspan="2" width="80%"> <?php echo $row->fullname; ?></td>
                </tr>
                <tr>
                    <th class="tg-0pky">Dayitwa :</th>
                    <td class="tg-0pky" colspan="2"> Prant - <?php echo $row->pranat; ?> | Vibhag - <?php echo $row->vibhag; ?> | Dayitwa - <?php echo $row->dayitwa; ?></td>
                </tr>
                <tr>
                    <th class="tg-0pky">Mobile : </th>
                    <td class="tg-0pky" colspan="2"> <?php echo $row->mobile; ?></td>
                </tr>
                <tr>
                    <th class="tg-0pky">Email : </th>
                    <td class="tg-0pky" colspan="2"> <?php echo $row->email; ?></td>
                </tr>
                <tr>
                    <th class="tg-0pky">Address : </th>
                    <td class="tg-0pky" colspan="2"> <?php echo $row->address_info; ?></td>
                </tr>
                <tr>
                    <th class="tg-0pky">Gender : </th>
                    <td class="tg-0pky" colspan="2"> <?php echo $row->gender; ?></td>
                </tr>
                <tr>
                    <th class="tg-0lax">Arrival Details</th>
                    <td class="tg-0pky" colspan="2"> Place - <?php echo $row->pick_point_place; ?> | Date - <?php echo $row->arrival_date; ?> | Time - <?php echo $row->arrival_time; ?> | Mode - <?php echo $row->arrival_mode_transport; ?> | Details - <?php echo $row->arrival_mode_details; ?></td>
                </tr>
                <tr>
                    <th class="tg-0lax">Departure Details</th>
                    <td class="tg-0pky" colspan="2"> Place - <?php echo $row->drop_point_place; ?> | Date - <?php echo $row->departure_date; ?> | Time - <?php echo $row->departure_time; ?> | Mode - <?php echo $row->departure_mode_transport; ?> | Details - <?php echo $row->departure_mode_details; ?></td>
                </tr>
                <tr>
                    <th class="tg-0lax">Food Option</th>
                    <td class="tg-0pky" colspan="2"> <?php echo $row->food_status; ?></td>
                </tr>
                <tr>
                    <th class="tg-0lax">??????/??? - ???????????? ?????? ?????????????????? (Junagadh)</th>
                    <td class="tg-0pky" colspan="2"> <?php echo $row->feb13; ?></td>
                </tr>
                <tr>
                    <th class="tg-0lax">??????/??? - ???????????????????????? (Dwarika)</th>
                    <td class="tg-0pky" colspan="2"> <?php echo $row->feb14; ?></td>
                </tr>
                <tr>
                    <th class="tg-0lax">Guest Count</th>
                    <td class="tg-0pky" colspan="2"> Brother - <?php echo $row->total_member_bro; ?> | Sister - <?php echo $row->total_member_sis; ?></td>
                </tr>
            </tbody>
        </table>


    <?php
    }
    ?>

    <div class="d-flex justify-content-center align-items-center" style="height:100px;">
        <div>Guest Details</div>
    </div>

    <table id="zero_config" class="table table-striped table-hover table-bordered no-wrap">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Guest Name</th>
                <th>Relation</th>
                <th>Gender</th>
                <th>Contact Number</th>
            </tr>
        </thead>

        <?php
        $aid = $_SESSION['id'];
        $gid = $_GET['gid'];
        $ret = "SELECT * FROM `abab_guest_booking` where  uid=?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('i', $aid);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        //$cnt=1;
        while ($row = $res->fetch_object()) {
        ?>

            <tr>
                <td><?php echo $cnt;; ?></td>
                <td><?php echo $row->guest_name; ?></td>
                <td><?php echo $row->guest_relation; ?></td>                
                <td><?php echo $row->guest_gender; ?></td>
                <td><?php echo $row->guest_contact; ?></td>
                
            </tr>
        <?php
            $cnt = $cnt + 1;
        } ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-center align-items-center" style="height:100px;">
        <div class="bg-primary"><input type="button" class="btn btn-danger center" onClick="window.print()" value="Print The Report" /></div>
    </div>