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
    $guest_city = $_POST['guest_city'];
    $guest_pin = $_POST['guest_pin'];
    $query = "INSERT INTO guest_details (uid, guest_name, guest_relation, guest_contact, guest_address, guest_city, guest_pin) VALUES (?,?, ?, ?, ?, ?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('issssss', $uid, $guest_name, $guest_relation, $guest_contact, $guest_address, $guest_city, $guest_pin);
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

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Guest Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="guest_name" id="guest_name" class="form-control" placeholder="Enter Guest's Name" required>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Relation</h4>
                                    <div class="form-group">
                                        <input type="text" name="guest_relation" id="guest_relation" required class="form-control" placeholder="Member's Relation with Guest">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Contact Number</h4>
                                    <div class="form-group">
                                        <input type="text" name="guest_contact" id="guest_contact" required class="form-control" placeholder="Enter Guest's Contact No.">
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
                                    <h4 class="card-title">Drop Place</h4>
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


                                            <option value="Dormitory 100/day (Rs.)">Dormitory 100/day (Rs.)</option>
                                            <option value="Shared Room 700/day (Rs.)">Shared Room 700/day (Rs.)</option>
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
                                        <h4 class="card-title">Transport Details <h6>(Train/Flight Number)</h6></h4>
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
                                        <h4 class="card-title">Transport Details <h6>(Train/Flight Number)</h6></h4>
                                        <div class="form-group">
                                            <input type="text" name="trans_details" id="trans_details" class="form-control" value="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">10 Feb - Somnath</h4>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio10" value="Tea with sugar" name="feb10" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio10">Going</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio102" value="Tea without sugar" name="feb10" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="customRadio102">Not Going</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">11 Feb - Porbandar</h4>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio11" value="Tea with sugar" name="feb11" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio11">Going</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio112" value="Tea without sugar" name="feb11" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="customRadio112">Not Going</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">13 Feb - Junagadh</h4>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio13" value="Tea with sugar" name="feb13" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio13">Going</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio132" value="Tea without sugar" name="feb13" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="customRadio132">Not Going</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">14 Feb - Dwarika</h4>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio14" value="Tea with sugar" name="feb14" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio14">Going</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio142" value="Tea without sugar" name="feb14" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="customRadio142">Not Going</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Address</h4>
                                    <div class="form-group">
                                        <textarea name="guest_address" id="guest_address" class="form-control" placeholder="Enter Address" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">City</h4>
                                    <div class="form-group">
                                        <input type="text" name="guest_city" id="guest_city" class="form-control" placeholder="Enter City Name" required>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Postal Code</h4>
                                    <div class="form-group">
                                        <input type="text" name="guest_pin" id="guest_pin" class="form-control" placeholder="Enter Postal Code" required>
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