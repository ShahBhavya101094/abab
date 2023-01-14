<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

if (isset($_POST['submit'])) {

    $uid = $_SESSION['id'];
    $guest_name = $_POST['guest_name'];
    $guest_relation = $_POST['guest_relation'];
    $guest_contact = $_POST['guest_contact'];
    $guest_address = $_POST['guest_address'];
    $pick_point_place = $_POST['pick_point_place'];
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
    $feb10 = $_POST['feb10'];
    $feb11 = $_POST['feb11'];
    $feb12 = $_POST['feb12'];
    $feb13 = $_POST['feb13'];
    $feb14 = $_POST['feb14'];
    $status = $_POST['room_option'];
    $query = "INSERT INTO `abab_guest_booking` ( `uid`, `guest_name`, `guest_relation`, `guest_contact`, `guest_address`, `pick_point_place`, `drop_point_place`, `food_status`, `arrival_date`, `arrival_time`, `arrival_mode_transport`, `arrival_mode_details`, `departure_date`, `departure_time`, `departure_mode_transport`, `departure_mode_details`, `feb10`, `feb11`, `feb12`, `feb13`, `feb14`, `status`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('isssssssssssssssssssss', $uid, $guest_name, $guest_relation, $guest_contact, $guest_address,  $pick_point_place, $drop_point_place, $food_status, $arrival_date, $arrival_time, $arrival_mode_transport, $arrival_mode_details, $departure_date, $departure_time, $departure_mode_transport, $departure_mode_details, $feb10, $feb11,$feb12, $feb13, $feb14, $status);
    $stmt->execute();
    echo "<script>alert('Guest details has been added');</script>";
    echo "<script>location.href='manage-guest.php';</script>";
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

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
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Add Guest Details</h4>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                        </div>
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <?php if (isset($_POST['submit'])) { ?>
                <!-- <p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></p> -->
            <?php } ?>

            <div class="container-fluid">

                <form method="POST">

                    <h4 class="card-title mt-5">Guest's Information</h4>


                    <div class="row">



                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Guest Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="guest_name" id="guest_name" placeholder="Guest Name here.." class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Guest Relation</h4>
                                    <div class="form-group">
                                        <input type="text" name="guest_relation" id="guest_relation" placeholder="Guest Relation here.." class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Contact Number</h4>
                                    <div class="form-group">
                                        <input type="text" name="guest_contact" id="guest_contact" placeholder="Guest Contact here.." class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Address</h4>
                                    <div class="form-group">
                                        
                                            <textarea name="guest_address" id="guest_address" class="form-control" placeholder="Enter Address" required></textarea></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Room Option</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="room_option" name="room_option">


                                            <option value="Dormitory 100/day (Rs.)">Dormitory 100/day (Rs.)</option>
                                            <option value="Shared Room 700/day (Rs.)">Double Sharing 350/day (Rs.)</option>
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
                    <div class="row ">

                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Arrival Date</h4>
                                    <div class="form-group">
                                        <input type="date" min="2023-02-01" min="2023-02-01" name="arrival_date" id="arrival_date" class="form-control" required>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Arrival Time</h4>
                                    <div class="form-group">
                                        <input type="time" min="07:00" max="22:00" name="arrival_time" id="arrival_time" class="form-control" required>
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
                                        <input type="text" name="arrival_mode_details" id="arrival_mode_details" class="form-control">
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
                                        <input type="date" min="2023-02-01" min="2023-02-01" name="departure_date" id="departure_date" class="form-control" required>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Departure Time</h4>
                                    <div class="form-group">
                                        <input type="time" min="07:00" max="22:00" name="departure_time" id="departure_time" class="form-control" required>
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
                                        <input type="text" name="departure_mode_details" id="departure_mode_details" class="form-control">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">१०/२ - सोमनाथ (Somnath) <h6>( Free )</h6>
                                    </h4>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio10" value="Going" name="feb10" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio10">Going</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio102" value="Not Going" name="feb10" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="customRadio102">Not Going</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">११/२ - पोरबंदर (Porbandar) <h6>( Rs. 500/- )</h6>
                                    </h4>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio11" value="Going" name="feb11" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio11">Going</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio112" value="Not Going" name="feb11" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="customRadio112">Not Going</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">१२/२ - प्रभाष क्षेत्र (Near by Place) <h6>( Rs. 300/- )</h6>
                                    </h4>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio12" value="Going" name="feb12" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio12">Going</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio122" value="Not Going" name="feb12" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="customRadio122">Not Going</label>
                                    </div>

                                </div>
                            </div>
                        </div>

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


                    </div>


                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success">Insert</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </div>

                </form>


            </div>
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

</html>