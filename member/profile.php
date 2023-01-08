<?php
session_start();
include('../includes/dbconn.php');
date_default_timezone_set('America/Chicago');
include('../includes/check-login.php');
check_login();
$aid = $_SESSION['id'];
if (isset($_POST['update'])) {

    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $district = $_POST['district'];
    $udate = date('d-m-Y h:i:s', time());
    $query = "UPDATE  user_reg set fullname=?,gender=?,address_info=?,email=?,dob=?,district=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssssss', $fullname, $gender, $address, $email, $dob,$district, $aid);
    $stmt->execute();
    echo "<script>alert('Profile updated Succssfully');</script>";
    echo "<script>location.href='book-ABAB';</script>";
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
                    $aid = $_SESSION['id'];
                    $ret = "select * from user_reg where id=?";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->bind_param('i', $aid);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    //$cnt=1;
                    while ($row = $res->fetch_object()) {
                    ?>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Prant Name</h4>
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $row->pranat; ?>" class="form-control" required readonly>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- By Vkendra - Vkendra.com -->

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Category Name</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo $row->category; ?>" required readonly>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Vibhag Name</h4>
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $row->vibhag; ?>" class="form-control" required readonly>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Letter</h4>
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $row->letter; ?>" class="form-control" required readonly>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Dayitwa Name</h4>
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $row->dayitwa; ?>" class="form-control" required readonly>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Role Name</h4>
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $row->role; ?>" class="form-control" required readonly>
                                    </div>

                                </div>
                            </div>
                        </div>

                </div>


                <form name="registration" onSubmit="return valid();" method="POST">

                    <div class="row">

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Full Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo $row->fullname; ?>" required="required">
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Address Details</h4>
                                    <div class="form-group">
                                        <textarea name="address" id="address" class="form-control"><?php echo $row->address_info; ?></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Gender</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="gender" name="gender">
                                            <option value="<?php echo $row->gender; ?>"><?php echo $row->gender; ?></option>
                                            <option value="Brother">Brother</option>
                                            <option value="Sister">Sister</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Date of Birth</h4>
                                    <div class="form-group">
                                        <input type="date" name="dob" id="dob" max="2008-01-01" class="form-control" value="<?php echo $row->dob;?>" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">District</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="district" name="district">
                                            <?php if($row->district != "") { ?>
                                            <option value="<?php echo $row->district; ?>"><?php echo $row->district; ?></option>
                                            <?php } ?>
                                            <option value="Other">Other</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Email Address</h4>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $row->email;?>" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- By Vkendra - Vkendra.com -->

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Contact Number</h4>
                                    <div class="form-group">
                                        <input type="text" name="mobile" id="mobile" maxlength="10" class="form-control" value="<?php echo $row->mobile;?>" readonly>
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