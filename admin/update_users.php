<?php
session_start();
include('../includes/dbconn.php');
date_default_timezone_set('America/Chicago');
include('../includes/check-login.php');
check_login();
if (isset($_POST['update'])) {
    
    $aid = $_POST['uid'];
    $pranat = $_POST['pranat'];
    $vibhag = $_POST['vibhag'];
    $dayitwa = $_POST['dayitwa'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    
    $mobile = $_POST['mobile'];
    $district = $_POST['district'];

    $udate = date('d-m-Y h:i:s', time());

    $adhar_number = $_POST['adhar_number'];
    // $query = "UPDATE  user_reg set fullname=?,gender=?,address_info=?,email=?,dob=?,district=?,adhar_number=?,dayitwa=,vibhag=?,pranat=?,mobile=? where id=?";
    // $stmt = $mysqli->prepare($query);
    // $rc = $stmt->bind_param('ssssssssssss', $fullname, $gender, $address, $email, $dob, $district, $adhar_number,$dayitwa,$vibhag,$pranat,$mobile, $aid);
    // $stmt->execute();
    echo "<script>alert('Adhikari profile updated Succssfully');</script>";
    echo "<script>location.href='view-members-acc.php';</script>";
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

    <!-- <script type="text/javascript">
    function valid(){
        if(document.registration.password.value!= document.registration.cpassword.value){
            alert("Password and Re-Type Password Field do not match !!");
            document.registration.cpassword.focus();
        return false;
            } return true;
     }
    </script> -->
    <style>
    .required .card-title:after {
        color: #d00;
        content: "*";
        position: absolute;
        margin-left: 3px;
        top: 7px;
    }
    </style>
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
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
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
            <!-- By Vkendra - Vkendra.com -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                <div class="align-self-center text-center">
                    <h4 class="page-title center text-truncate text-dark font-weight-medium mb-4">My User Profile</h4>
                </div>
                <div class="row">

                    <?php
                    $aid = $_GET['uid'];
                    $ret = "select * from user_reg where id=?";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->bind_param('i', $aid);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    //$cnt=1;
                    while ($row = $res->fetch_object()) {
                    ?>




                    <form name="registration" method="POST">

                        <div class="row">



                            <div class="col-md-4">
                                <div class="card required">
                                    <div class="card-body">
                                        <h4 class="card-title">Prant Name</h4>
                                        <div class="form-group">
                                            <select class="custom-select mr-sm-2" required name="pranat"
                                                placeholder="Select Prant Name">
                                                <?php

$ret1 = "SELECT DISTINCT`pranat` FROM `user_reg`";
$stmt1 = $mysqli->prepare($ret1);
$stmt1->execute(); //ok
$res1 = $stmt1->get_result();
//$cnt=1;
while ($row1 = $res1->fetch_object()) {
?>
                                                <option value="<?php echo $row1->pranat; ?>"
                                                    <?php echo $row1->pranat == $row->pranat?"selected":""; ?>>
                                                    <?php echo $row1->pranat; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- By Vkendra - Vkendra.com -->



                            <div class="col-md-4">
                                <div class="card required">
                                    <div class="card-body">
                                        <h4 class="card-title">Vibhag Name</h4>
                                        <div class="form-group">
                                            <select class="custom-select mr-sm-2" name="vibhag">
                                                <?php

$ret1 = "SELECT DISTINCT`vibhag` FROM `user_reg`";
$stmt1 = $mysqli->prepare($ret1);
$stmt1->execute(); //ok
$res1 = $stmt1->get_result();
//$cnt=1;
while ($row1 = $res1->fetch_object()) {
?>
                                                <option value="<?php echo $row1->vibhag; ?>"
                                                    <?php echo $row1->vibhag == $row->vibhag?"selected":""; ?>>
                                                    <?php echo $row1->vibhag; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="card required">
                                    <div class="card-body">
                                        <h4 class="card-title">Dayitwa Name</h4>
                                        <div class="form-group">
                                            <select class="custom-select mr-sm-2" name="dayitwa">
                                                <?php

$ret1 = "SELECT DISTINCT`dayitwa` FROM `user_reg`";
$stmt1 = $mysqli->prepare($ret1);
$stmt1->execute(); //ok
$res1 = $stmt1->get_result();
//$cnt=1;
while ($row1 = $res1->fetch_object()) {
?>
                                                <option value="<?php echo $row1->dayitwa; ?>"
                                                    <?php echo $row1->dayitwa == $row->dayitwa?"selected":""; ?>>
                                                    <?php echo $row1->dayitwa; ?>
                                                </option>
                                                <?php } ?>
                                            </select>

                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="row">

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card required">
                                    <div class="card-body">
                                        <h4 class="card-title">Full Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="fullname" id="fullname" class="form-control"
                                                value="<?php echo $row->fullname; ?>" required="required">
                                                <input type="hidden" name="uid" id="uid" 
                                                value="<?php echo $row->$aid; ?>" >
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card required">
                                    <div class="card-body">
                                        <h4 class="card-title">Address Details</h4>
                                        <div class="form-group">
                                            <textarea name="address" id="address"
                                                class="form-control"><?php echo $row->address_info; ?></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>







                            <!-- By Vkendra - Vkendra.com -->

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card required">
                                    <div class="card-body">
                                        <h4 class="card-title">Mobile</h4>
                                        <div class="form-group">
                                            <input type="text" name="mobile" id="mobile" maxlength="10"
                                                class="form-control" value="<?php echo $row->mobile; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card required">
                                    <div class="card-body">
                                        <h4 class="card-title">Email Address</h4>
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="<?php echo $row->email; ?>" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card required">
                                    <div class="card-body">
                                        <h4 class="card-title">AadhaarCard :</h4>
                                        <div class="form-group mb-4">
                                            <input type="text" class="form-control" id="adhar_number"
                                                title="Enter Valid 12 Digit AadhaarCard Number"
                                                value="<?php echo $row->adhar_number; ?>" name="adhar_number"
                                                pattern="[0-9]{12}" require minlength="12" maxlength="12"
                                                placeholder="Enter AadhaarCard..." />

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card required">
                                    <div class="card-body">
                                        <h4 class="card-title">Gender</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="gender" name="gender">
                                                <option value="<?php echo $row->gender; ?>"><?php echo $row->gender; ?>
                                                </option>
                                                <option value="Brother">Brother</option>
                                                <option value="Sister">Sister</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card required">
                                    <div class="card-body">
                                        <h4 class="card-title">Date of Birth</h4>
                                        <div class="form-group">
                                            <input type="date" name="dob" id="dob" max="2008-01-01" class="form-control"
                                                value="<?php echo $row->dob; ?>" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4 d-none">
                                <div class="card required">
                                    <div class="card-body">
                                        <h4 class="card-title">District</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="district" name="district">
                                                <?php if ($row->district != "") { ?>
                                                <option value="<?php echo $row->district; ?>">
                                                    <?php echo $row->district; ?>
                                                </option>
                                                <?php } ?>
                                                <option value="Other">Other</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>

                        </div>

                        <div class="form-actions">
                            <div class="text-center">
                                <button type="submit" name="update" class="btn btn-success">Make Changes</button>
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
        <!-- By Vkendra - Vkendra.com -->
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