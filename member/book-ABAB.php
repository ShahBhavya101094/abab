<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();
if (isset($_POST['submit'])) {
    $uid = $_SESSION['id'];
    $attend_event = $_POST['attend_event'];
    $pick_point_place = $_POST['pick_point_place'];
    $drop_point_place = $_POST['drop_point_place'];
    $food_status = $_POST['food_status'];
    $arrival_date = $_POST['arrival_date'];
    $arrival_time = $_POST['arrival_time'];
    $arrival_mode_transport = $_POST['arrival_mode_transport'];
    $arrival_mode_details = $_POST['arrival_mode_details'];
    $departure_date = $_POST['departure_date'];
    $departure_time = $_POST['departure_time'];
    $departure_mode_transport = $_POST['departure_mode_transport'];
    $departure_mode_details = $_POST['departure_mode_details'];
    $feb13 = $_POST['feb13'];
    $feb14 = $_POST['feb14'];
    $total_member_sis = $_POST['total_member_sis'];
    $total_member_bro = $_POST['total_member_bro'];
    $status = $_POST['reg_status'];
    if ($status == "1") {
        $query = "INSERT INTO `abab_booking` ( `uid`, `attend_event`, `pick_point_place`, `drop_point_place`, `food_status`, `arrival_date`, `arrival_time`, `arrival_mode_transport`, `arrival_mode_details`, `departure_date`, `departure_time`, `departure_mode_transport`, `departure_mode_details`, `feb13`, `feb14`, `total_member_sis`, `total_member_bro`, `status`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('isssssssssssssssss', $uid, $attend_event, $pick_point_place, $drop_point_place, $food_status, $arrival_date, $arrival_time, $arrival_mode_transport, $arrival_mode_details, $departure_date, $departure_time, $departure_mode_transport, $departure_mode_details, $feb13, $feb14, $total_member_sis, $total_member_bro, $status);
        $stmt->execute();
        $query = "UPDATE user_reg set reg_status=? where id=?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ii',   $status, $uid);
        $stmt->execute();
        echo "<script>alert('ABAB Details has Been Registered!');</script>";
        echo "<script>location.href='manage-guest.php';</script>";
    } else {
        $query = "UPDATE abab_booking set attend_event=?,pick_point_place=?,drop_point_place=?,food_status=?,arrival_date=?,arrival_time=?,arrival_mode_transport=?,arrival_mode_details=?,departure_date=?,departure_time=?,departure_mode_transport=?,departure_mode_details=?,feb13=?,feb14=?,total_member_sis=?,total_member_bro=?,status=? where uid=?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sssssssssssssssssi',  $attend_event, $pick_point_place, $drop_point_place, $food_status, $arrival_date, $arrival_time, $arrival_mode_transport, $arrival_mode_details, $departure_date, $departure_time, $departure_mode_transport, $departure_mode_details, $feb13, $feb14, $total_member_sis, $total_member_bro, $status, $uid);
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
                                                <select class="custom-select mr-sm-2" id="attend_evente" name="attend_event">
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
                                                <select class="custom-select mr-sm-2" id="pick_point_place" name="pick_point_place">
                                                    <option selected value="<?php echo $row->pick_point_place; ?>"><?php echo $row->pick_point_place; ?></option>
                                                    <option value="Veraval Railway Station">Veraval Railway Station</option>
                                                    <option value="Rajkot Railway Station ">Rajkot Railway Station </option>
                                                    <option value="Rajkot Airport">Rajkot Airport</option>
                                                    <option value="Ahmedabad Railway Station">Ahmedabad Railway Station</option>
                                                    <option value="Ahmedabad Airport">Ahmedabad Airport</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Drop Place</h4>
                                            <div class="form-group mb-4">
                                                <select class="custom-select mr-sm-2" id="drop_point_place" name="drop_point_place">
                                                    <option selected value="<?php echo $row->drop_point_place; ?>"><?php echo $row->drop_point_place; ?></option>
                                                    <option value="Veraval Railway Station">Veraval Railway Station</option>
                                                    <option value="Rajkot Railway Station ">Rajkot Railway Station </option>
                                                    <option value="Rajkot Airport">Rajkot Airport</option>
                                                    <option value="Ahmedabad Railway Station">Ahmedabad Railway Station</option>
                                                    <option value="Ahmedabad Airport">Ahmedabad Airport</option>

                                                    <option value="Other">Other</option>
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
                                                <input type="radio" id="customRadio1" value="Tea with sugar" <?php echo $row->food_status == "Tea with sugar" ? "checked" : ""; ?> name="food_status" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio1">Tea with sugar</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" value="Tea without sugar" <?php echo $row->food_status == "Tea without sugar" ? "checked" : ""; ?> name="food_status" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio2">Tea without sugar</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio3" value="Coffee" <?php echo $row->food_status == "Coffee" ? "checked" : ""; ?> name="food_status" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio3">Coffee</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio4" value="Milk" <?php echo $row->food_status == "Milk" ? "checked" : ""; ?> name="food_status" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio4">Milk</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio5" value="Falahar" <?php echo $row->food_status == "Falahar" ? "checked" : ""; ?> name="food_status" class="custom-control-input">
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
                                                <input type="date" min="2023-02-01" min="2023-02-01" name="arrival_date" id="arrival_date" class="form-control" value="<?php echo $row->arrival_date; ?>" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Arrival Time</h4>
                                            <div class="form-group">
                                                <input type="time" min="07:00" max="22:00" name="arrival_time" id="arrival_time" class="form-control" value="<?php echo $row->arrival_time; ?>" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Mode of Transport</h4>
                                            <div class="form-group">
                                                <select class="custom-select mr-sm-2" id="arrival_mode_transport" name="arrival_mode_transport">
                                                    <option selected value="<?php echo $row->arrival_mode_transport; ?>"><?php echo $row->arrival_mode_transport; ?></option>
                                                    <option value="By Road">By Road</option>
                                                    <option value="By Flight">By Flight</option>
                                                    <option value="By Train">By Train</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Transport Details <h6>(Train/Flight Number)</h6>
                                            </h4>
                                            <div class="form-group">
                                                <input type="text" name="arrival_mode_details" id="arrival_mode_details" class="form-control" value="<?php echo $row->arrival_mode_details; ?>">
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
                                                <input type="date" min="2023-02-01" min="2023-02-01" name="departure_date" id="departure_date" class="form-control" value="<?php echo $row->departure_date; ?>" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Departure Time</h4>
                                            <div class="form-group">
                                                <input type="time" min="07:00" max="22:00" name="departure_time" id="departure_time" class="form-control" value="<?php echo $row->departure_time; ?>" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Mode of Transport</h4>
                                            <div class="form-group">
                                                <select class="custom-select mr-sm-2" id="departure_mode_transport" name="departure_mode_transport">
                                                    <option selected value="<?php echo $row->departure_mode_transport; ?>"><?php echo $row->departure_mode_transport; ?></option>
                                                    <option value="By Road">By Road</option>
                                                    <option value="By Flight">By Flight</option>
                                                    <option value="By Train">By Train</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Transport Details <h6>(Train/Flight Number)</h6>
                                            </h4>
                                            <div class="form-group">
                                                <input type="text" name="departure_mode_details" id="departure_mode_details" class="form-control" value="<?php echo $row->departure_mode_details; ?>">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">


                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">१३/२ - सासण और गिरनार (Junagadh) <h6>( Rs. 1000/- ) ( Rope way + Lion Safari charges included )</h6>
                                            </h4>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio13" value="Going" <?php echo $row->feb13 == "Going" ? "checked" : ""; ?> name="feb13" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio13">Going</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio132" value="Not Going" <?php echo $row->feb13 == "Not Going" ? "checked" : ""; ?> name="feb13" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio132">Not Going</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">१४/२ - द्वारिका (Dwarika) <h6>( Rs. 800/- )</h6>
                                            </h4>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio14" value="Going" <?php echo $row->feb14 == "Going" ? "checked" : ""; ?> name="feb14" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio14">Going</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio142" value="Not Going" <?php echo $row->feb14 == "Not Going" ? "checked" : ""; ?> name="feb14" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio142">Not Going</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Guest Count(Brother)</h4>
                                            <div class="form-group">
                                                <input type="number" min="0" max="10" name="total_member_sis" id="total_member_sis" placeholder="Guest Brother Member here.." class="form-control" value="<?php echo $row->total_member_sis; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Guest Count(Sister)</h4>
                                            <div class="form-group">
                                                <input type="number" min="0" max="10" name="total_member_bro" id="total_member_bro" placeholder="Guest Sister Member here.." required class="form-control" value="<?php echo $row->total_member_bro; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>





                            <div class="form-actions">
                                <div class="text-center">
                                    <input type="hidden" name="reg_status" id="reg_status" value="2">
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
                                            <select class="custom-select mr-sm-2" id="attend_eventa" name="attend_event">
                                                <option selected>Choose...</option>
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
                                            <select class="custom-select mr-sm-2" id="pick_point_place" name="pick_point_place">
                                                <option value="Veraval Railway Station">Veraval Railway Station</option>
                                                <option value="Rajkot Railway Station ">Rajkot Railway Station </option>
                                                <option value="Rajkot Airport">Rajkot Airport</option>
                                                <option value="Ahmedabad Railway Station">Ahmedabad Railway Station</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Drop Place</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="drop_point_place" name="drop_point_place">
                                                <option value="Veraval Railway Station">Veraval Railway Station</option>
                                                <option value="Rajkot Railway Station ">Rajkot Railway Station </option>
                                                <option value="Rajkot Airport">Rajkot Airport</option>
                                                <option value="Ahmedabad Railway Station">Ahmedabad Railway Station</option>
                                                <option value="Ahmedabad Airport">Ahmedabad Airport</option>
                                                <option value="Other">Other</option>
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
                                            <input type="date" min="2023-02-01" min="2023-02-01" name="arrival_date" id="arrival_date" class="form-control" value="<?php echo $row->From_Date; ?>" required>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Arrival Time</h4>
                                        <div class="form-group">
                                            <input type="time" min="07:00" max="22:00" name="arrival_time" id="arrival_time" class="form-control" value="<?php echo $row->From_Time; ?>" required>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Mode of Transport</h4>
                                        <div class="form-group">
                                            <select class="custom-select mr-sm-2" id="arrival_mode_transport" name="arrival_mode_transport">
                                                <option value="By Road">By Road</option>
                                                <option value="By Flight">By Flight</option>
                                                <option value="By Train">By Train</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Transport Details <h6>(Train/Flight Number)</h6>
                                        </h4>
                                        <div class="form-group">
                                            <input type="text" name="arrival_mode_details" id="arrival_mode_details" class="form-control" value="">
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
                                            <input type="date" min="2023-02-01" min="2023-02-01" name="departure_date" id="departure_date" class="form-control" value="<?php echo $row->From_Date; ?>" required>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Departure Time</h4>
                                        <div class="form-group">
                                            <input type="time" min="07:00" max="22:00" name="departure_time" id="departure_time" class="form-control" value="<?php echo $row->From_Time; ?>" required>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Mode of Transport</h4>
                                        <div class="form-group">
                                            <select class="custom-select mr-sm-2" id="departure_mode_transport" name="departure_mode_transport">
                                                <option value="By Road">By Road</option>
                                                <option value="By Flight">By Flight</option>
                                                <option value="By Train">By Train</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Transport Details <h6>(Train/Flight Number)</h6>
                                        </h4>
                                        <div class="form-group">
                                            <input type="text" name="departure_mode_details" id="departure_mode_details" class="form-control" value="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">


                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">१३/२ - सासण और गिरनार (Junagadh) <h6>( Rs. 1000/- ) ( Rope way + Lion Safari charges included )</h6>
                                        </h4>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio13" value="Going" name="feb13" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio13">Going</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio132" value="Not Going" name="feb13" class="custom-control-input" checked>
                                            <label class="custom-control-label" for="customRadio132">Not Going</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">१४/२ - द्वारिका (Dwarika) <h6>( Rs. 800/- )</h6>
                                        </h4>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio14" value="Going" name="feb14" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio14">Going</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio142" value="Not Going" name="feb14" class="custom-control-input" checked>
                                            <label class="custom-control-label" for="customRadio142">Not Going</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Guest Count(Brother)</h4>
                                        <div class="form-group">
                                            <input type="number" min="0" max="10" name="total_member_sis" id="total_member_sis" placeholder="Guest Brother Member here.." class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Guest Count(Sister)</h4>
                                        <div class="form-group">
                                            <input type="number" min="0" max="10" name="total_member_bro" id="total_member_bro" placeholder="Guest Sister Member here.." required class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="form-actions">
                            <div class="text-center">
                                <input type="hidden" name="reg_status" id="reg_status" value="1">
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

        $("#attend_eventa").change(function() {
            if (this.value == "No"){
                $ans = confirm("Are you sure ?");
                if($ans == true){
                    location.href='not_attend.php';
                }
            }

        });
       
    });
</script>

</html>