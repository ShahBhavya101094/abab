<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();
if (isset($_POST['submit'])) {
    $uid = $_SESSION['id'];
    $attend_event = $_POST['attend_event'];
    $pick_point = $_POST['pick_point'];
    $food_status = $_POST['food_status'];
    $From_Date = $_POST['From_Date'];
    $From_Time = $_POST['From_Time'];
    $To_Date = $_POST['To_Date'];
    $To_Time = $_POST['To_Time'];
    $Emergancy_contact = $_POST['Emergancy_contact'];
    $total_member = $_POST['total_member'];
    $status = $_POST['status'];
    if ($status != "1") {
        $query = "INSERT INTO abab_booking ( uid, attend_event, pick_point, food_status, From_Date, From_Time, To_Date, To_Time, Emergancy_contact, total_member, status) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('issssssssii', $uid, $attend_event, $pick_point, $food_status, $From_Date, $From_Time, $To_Date, $To_Time, $Emergancy_contact, $total_member, $status);
        $stmt->execute();
        echo "<script>alert('ABAB Details has Been Registered!');</script>";
        echo "<script>location.href='manage-guest.php';</script>";
    } else {
        $query = "UPDATE  abab_booking set attend_event=?,pick_point=?,food_status=?,From_Date=?,From_Time=?,To_Date=?,To_Time=?,Emergancy_contact=?,total_member=?,status=? where uid=?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssssssssiii', $attend_event, $pick_point, $food_status, $From_Date, $From_Time, $To_Date, $To_Time, $Emergancy_contact, $total_member, $status, $uid);
        $stmt->execute();
        echo "<script>alert('ABAB Details has Been updated Succssfully');</script>";
        echo "<script>location.href='manage-guest.php';</script>";
    }
}
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
    <title>ABAB Management System</title>
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
    <!-- By Vkendra - Vkendra.com -->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <?php include '../includes/member-navigation.php' ?>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include '../includes/member-sidebar.php' ?>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">

            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->

            <?php
            $uid = $_SESSION['id'];
            $stmt = $mysqli->prepare("SELECT uid FROM abab_booking WHERE uid=? ");
            $stmt->bind_param('i', $uid);
            $stmt->execute();
            $stmt->bind_result($email);
            $rs = $stmt->fetch();
            $stmt->close();

            if ($rs) { ?>
                <div class="alert alert-primary alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Info: </strong> You have already booked a ABAB!
                </div>

                <div class="container-fluid">
                    <?php
                    $aid = $_SESSION['id'];
                    $ret = "select * from abab_booking where uid=?";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->bind_param('i', $aid);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    //$cnt=1;
                    while ($row = $res->fetch_object()) {
                    ?>
                        <form method="POST">




                            <div class="col-7 align-self-center">
                                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">ABAB Bookings</h4>
                            </div>


                            <div class="row">




                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Attend Event</h4>
                                            <div class="form-group mb-4">
                                                <select class="custom-select mr-sm-2" id="attend_event" name="attend_event">
                                                    <option selected value="<?php echo $row->attend_event; ?>"><?php echo $row->attend_event; ?></option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="May Be">May Be</option>
                                                    <option value="No">No</option>

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Pickup Place</h4>
                                            <div class="form-group mb-4">
                                                <select class="custom-select mr-sm-2" id="pick_point" name="pick_point">
                                                    <option selected value="<?php echo $row->pick_point; ?>"><?php echo $row->pick_point; ?></option>
                                                    <option value="Somnath">Somnath Railway Station</option>
                                                    <option value="Vyara">Vyara Railway Station</option>
                                                    <option value="Rajkot">Rajkot Railway Station </option>
                                                    <option value="Rajkot">Rajkot Airport</option>
                                                    <option value="Ahmedabad">Ahmedabad Railway Station</option>

                                                    <option value="Ahmedabad">Ahmedabad Airport</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Room Option</h4>
                                            <div class="form-group mb-4">
                                                <select class="custom-select mr-sm-2" id="pick_point" name="pick_point">


                                                    <option value="Option">Option</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Food option</h4>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Tea with sugar" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Tea with sugar" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Tea with sugar</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Tea without sugar" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Tea without sugar" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Tea without sugar</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Coffee" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Coffee" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Coffee</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Milk" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Milk" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Milk</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Falahar" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Falahar" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Falahar</label>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <!-- By Vkendra - Vkendra.com -->
                            </div>
                            <div class="row">

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Arrival Date</h4>
                                            <div class="form-group">
                                                <input type="date" name="From_Date" id="From_Date" class="form-control" value="<?php echo $row->From_Date; ?>" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Arrival Time</h4>
                                            <div class="form-group">
                                                <input type="time" name="From_Time" id="From_Time" class="form-control" value="<?php echo $row->From_Time; ?>" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Mode of Transport</h4>
                                            <div class="form-group">
                                                <select class="custom-select mr-sm-2" id="pick_point" name="pick_point">
                                                    <option selected value="<?php echo $row->pick_point; ?>"><?php echo $row->pick_point; ?></option>
                                                    <option value="Somnath">By Road</option>
                                                    <option value="Vyara">By Flight</option>
                                                    <option value="Rajkot">By Train</option>
                                                    <option value="Ahmedabad">Other</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Transport Details</h4>
                                            <div class="form-group">
                                                <input type="text" name="trans_details" id="trans_details" class="form-control" value="<?php echo $row->From_Time; ?>" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Departure Date</h4>
                                            <div class="form-group">
                                                <input type="date" name="From_Date" id="From_Date" class="form-control" value="<?php echo $row->From_Date; ?>" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Departure Time</h4>
                                            <div class="form-group">
                                                <input type="time" name="From_Time" id="From_Time" class="form-control" value="<?php echo $row->From_Time; ?>" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Mode of Transport</h4>
                                            <div class="form-group">
                                                <select class="custom-select mr-sm-2" id="pick_point" name="pick_point">
                                                    <option selected value="<?php echo $row->pick_point; ?>"><?php echo $row->pick_point; ?></option>
                                                    <option value="Somnath">By Road</option>
                                                    <option value="Vyara">By Flight</option>
                                                    <option value="Rajkot">By Train</option>
                                                    <option value="Ahmedabad">Other</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Transport Details</h4>
                                            <div class="form-group">
                                                <input type="text" name="trans_details" id="trans_details" class="form-control" value="<?php echo $row->From_Time; ?>" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>

                            </div>
                            <div class="row">

                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">10 Feb - Somnath</h4>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Tea with sugar" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Tea with sugar" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Going</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Tea without sugar" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Tea without sugar" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Not Going</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">11 Feb - Porbandar</h4>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Tea with sugar" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Tea with sugar" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Going</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Tea without sugar" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Tea without sugar" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Not Going</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">13 Feb - Junagadh</h4>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Tea with sugar" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Tea with sugar" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Going</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Tea without sugar" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Tea without sugar" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Not Going</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">14 Feb - Dwarika</h4>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Tea with sugar" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Tea with sugar" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Going</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" value="Tea without sugar" name="food_status" class="custom-control-input" <?php echo $row->food_status == "Tea without sugar" ? "checked" : ""; ?>>
                                                <label class="custom-control-label" for="customRadio1">Not Going</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Emergancy Number</h4>
                                            <div class="form-group">
                                                <input type="text" name="Emergancy_contact" id="Emergancy_contact" placeholder="Your Emergancy Number" value="<?php echo $row->Emergancy_contact; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Total Member</h4>
                                            <div class="form-group">
                                                <input type="text" name="total_member" id="total_member" placeholder="Total Member here.." value="<?php echo $row->total_member; ?>" required class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="form-actions">
                                <div class="text-center">
                                    <input type="hidden" name="status" id="status" value="2">
                                    <button type="submit" name="submit" class="btn btn-success">Update</button>
                                    <button type="reset" class="btn btn-dark">Reset</button>
                                </div>
                            </div>


                        </form>
                    <?php } ?>
                </div>
            <?php } else { ?>


                <div class="container-fluid">

                    <form method="POST">




                        <div class="col-7 align-self-center">
                            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">ABAB Bookings</h4>
                        </div>


                        <div class="row">




                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Attend Event</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="attend_event" name="attend_event">
                                                <option selected>Choose...</option>
                                                <option value="Y">Yes</option>
                                                <option value="M">May Be</option>
                                                <option value="N">No</option>

                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Pickup Place</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="pick_point" name="pick_point">
                                                <option value="Somnath">Somnath Railway Station</option>
                                                <option value="Vyara">Vyara Railway Station</option>
                                                <option value="Rajkot">Rajkot Railway Station </option>
                                                <option value="Rajkot">Rajkot Airport</option>
                                                <option value="Ahmedabad">Ahmedabad Railway Station</option>

                                                <option value="Ahmedabad">Ahmedabad Airport</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Room Option</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="pick_point" name="pick_point">


                                                <option value="Option">Option</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Food option</h4>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" value="Tea with sugar" name="food_status" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio1">Tea with sugar</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" value="Tea without sugar" name="food_status" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio2">Tea without sugar</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3" value="Coffee" name="food_status" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio3">Coffee</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio4" value="Milk" name="food_status" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio4">Milk</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio5" value="Falahar" name="food_status" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio5">Falahar</label>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <!-- By Vkendra - Vkendra.com -->


                        </div>
                        <div class="row">

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Arrival Date</h4>
                                        <div class="form-group">
                                            <input type="date" name="From_Date" id="From_Date" class="form-control" value="<?php echo $row->From_Date; ?>" required>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Arrival Time</h4>
                                        <div class="form-group">
                                            <input type="time" name="From_Time" id="From_Time" class="form-control" value="<?php echo $row->From_Time; ?>" required>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Mode of Transport</h4>
                                        <div class="form-group">
                                            <select class="custom-select mr-sm-2" id="pick_point" name="pick_point">
                                                <option value="Somnath">By Road</option>
                                                <option value="Vyara">By Flight</option>
                                                <option value="Rajkot">By Train</option>
                                                <option value="Ahmedabad">Other</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Transport Details</h4>
                                        <div class="form-group">
                                            <input type="text" name="trans_details" id="trans_details" class="form-control" value="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Departure Date</h4>
                                        <div class="form-group">
                                            <input type="date" name="From_Date" id="From_Date" class="form-control" value="<?php echo $row->From_Date; ?>" required>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Departure Time</h4>
                                        <div class="form-group">
                                            <input type="time" name="From_Time" id="From_Time" class="form-control" value="<?php echo $row->From_Time; ?>" required>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Mode of Transport</h4>
                                        <div class="form-group">
                                            <select class="custom-select mr-sm-2" id="pick_point" name="pick_point">
                                                <option value="Somnath">By Road</option>
                                                <option value="Vyara">By Flight</option>
                                                <option value="Rajkot">By Train</option>
                                                <option value="Ahmedabad">Other</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Transport Details</h4>
                                        <div class="form-group">
                                            <input type="text" name="trans_details" id="trans_details" class="form-control" value="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">


                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">13 Feb - Junagadh</h4>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio13" value="Tea with sugar" name="feb13" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio13">Going</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio132" value="Tea without sugar" name="feb13" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio132">Not Going</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">14 Feb - Dwarika</h4>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio14" value="Tea with sugar" name="feb14" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio14">Going</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio142" value="Tea without sugar" name="feb14" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio142">Not Going</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Emergancy Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="Emergancy_contact" id="Emergancy_contact" placeholder="Your Emergancy Number" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Total Member</h4>
                                        <div class="form-group">
                                            <input type="text" name="total_member" id="total_member" placeholder="Total Member here.." required class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="form-actions">
                            <div class="text-center">
                                <input type="hidden" name="total_member" id="total_member" value="1">
                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-dark">Reset</button>
                            </div>
                        </div>


                    </form>

                </div>
            <?php   }
            ?>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include '../includes/footer.php' ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>


</body>

<!-- Custom Ft. Script Lines -->
<script type="text/javascript">
    $(document).ready(function() {
        $('input[type="checkbox"]').click(function() {
            if ($(this).prop("checked") == true) {
                $('#paddress').val($('#address').val());
                $('#pcity').val($('#city').val());
                $('#ppincode').val($('#pincode').val());
            }

        });
    });
</script>

<script>
    function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check-availability.php",
            data: 'roomno=' + $("#room").val(),
            type: "POST",
            success: function(data) {
                $("#room-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#duration').keyup(function() {
            var fetch_dbid = $(this).val();
            $.ajax({
                type: 'POST',
                url: "ins-amt.php?action=userid",
                data: {
                    userinfo: fetch_dbid
                },
                success: function(data) {
                    $('.result').val(data);
                }
            });


        })
    });
</script>

</html>