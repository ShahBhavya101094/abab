<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();
//code for registration
if (isset($_POST['submit'])) {
    $roomno = $_POST['room'];
    $seater = $_POST['seater'];
    $feespm = $_POST['fpm'];
    $foodstatus = $_POST['foodstatus'];
    $stayfrom = $_POST['stayf'];
    $duration = $_POST['duration'];
    $course = $_POST['course'];
    $regno = $_POST['regno'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $contactno = $_POST['contact'];
    $emailid = $_POST['email'];
    $emcntno = $_POST['econtact'];
    $gurname = $_POST['gname'];
    $gurrelation = $_POST['grelation'];
    $gurcntno = $_POST['gcontact'];
    $caddress = $_POST['address'];
    $ccity = $_POST['city'];
    $cpincode = $_POST['pincode'];
    $paddress = $_POST['paddress'];
    $pcity = $_POST['pcity'];
    $ppincode = $_POST['ppincode'];
    $query = "INSERT into  registration(roomno,seater,feespm,foodstatus,stayfrom,duration,course,regno,firstName,middleName,lastName,gender,contactno,emailid,egycontactno,guardianName,guardianRelation,guardianContactno,corresAddress,corresCIty,corresPincode,pmntAddress,pmntCity,pmntPincode) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('iiiisissssssisissississi', $roomno, $seater, $feespm, $foodstatus, $stayfrom, $duration, $course, $regno, $fname, $mname, $lname, $gender, $contactno, $emailid, $emcntno, $gurname, $gurrelation, $gurcntno, $caddress, $ccity, $cpincode, $paddress, $pcity, $ppincode);
    $stmt->execute();
    echo "<script>alert('Success: Booked!');</script>";
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
            <?php include 'includes/navigation.php' ?>
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
                <?php include 'includes/sidebar.php' ?>
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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">ABAB Bookings</h4>
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
                                    <h4 class="card-title">Arrival Option</h4>
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
                                    <h4 class="card-title">Departure Option</h4>
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

</body>

</html>