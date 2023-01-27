<?php
session_start();
include('../includes/dbconn.php');
date_default_timezone_set('America/Chicago');
include('../includes/check-login.php');
check_login();

if (isset($_POST['update'])) {

    $vid = $_POST['vid'];
    $name = $_POST['name'];
    $sub_team = $_POST['sub_team'];
    $no_days = $_POST['no_days'];
    $gender = $_POST['gender'];
    
    $status = $_POST['status'];
    $mobile = $_POST['mobile'];
    
    $arrival_date = $_POST['arrival_date'];
    $departure_date = $_POST['departure_date'];
    $udate = date('d-m-Y h:i:s', time());

    $adhar_number = $_POST['adhar_number'];
    $query = "UPDATE `abab_vyavastha` SET `name` = ?, `gender` = ?, `mobile` = ?, `sub_team` = ?, `no_days` = ?, `date_arrival` = ?, `date_depature` = ?, `status` = ? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ssssssssi', $name,$gender,$mobile ,$sub_team, $no_days, $arrival_date, $departure_date,$status,$vid);
    $stmt->execute();
   // echo "<script>alert('ABAB Yyavastha adhikari update Succssfully');</script>";
    //echo "<script>location.href='manage-vyavastha.php';</script>";
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
                    <h4 class="page-title center text-truncate text-dark font-weight-medium mb-4">Add User Profile</h4>
                </div>

                <?php
                    $aid = $_GET['uid'];
                    $ret = "select * from abab_vyavastha where id=?";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->bind_param('i', $aid);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    //$cnt=1;
                    while ($row = $res->fetch_object()) {
                    ?>

                <form name="registration" method="POST">
                    <div class="row">



                       

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card required">
                                <div class="card-body">
                                    <h4 class="card-title">Full Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $row->name; ?>"
                                            required="required">
                                            <input type="hidden" name="vid" id="vid" class="form-control" value="<?php echo $aid; ?>"
                                            >
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
                                        
                                        <option value="<?php echo $row->gender; ?>" ><?php echo $row->gender; ?></option>
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
                                    <h4 class="card-title">Mobile</h4>
                                    <div class="form-group">
                                        <input type="text" name="mobile" id="mobile" maxlength="10" require value="<?php echo $row->mobile; ?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card required">
                                <div class="card-body">
                                    <h4 class="card-title">Sub Team Name</h4>
                                    <div class="form-group"> 
                                    <input type="text" name="sub_team" id="sub_team"  placeholder="Sub Team Name" class="form-control"  value="<?php echo $row->sub_team; ?>"
                                            required="required">
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card required">
                                <div class="card-body">
                                    <h4 class="card-title">Number of Days</h4>
                                    <div class="form-group">
                                    <input type="number" name="no_days" min="1"  max="25" id="no_days"  placeholder="Sub Team Name" class="form-control"  value="<?php echo $row->no_days; ?>"
                                            required="required">
                                    </div>

                                </div>
                            </div>
                        </div>



                      
                        <!-- By Vkendra - Vkendra.com -->

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card required">
                                <div class="card-body">
                                    <h4 class="card-title">Arrival Date</h4>
                                    <div class="form-group">
                                        <input type="date" min="2023-02-01" min="2023-02-01" name="arrival_date"  value="<?php echo $row->date_arrival; ?>"
                                            id="arrival_date" class="form-control" required="required">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card required">
                                <div class="card-body">
                                    <h4 class="card-title">Departure Date</h4>
                                    <div class="form-group">
                                        <input type="date" min="2023-02-01" min="2023-02-01" name="departure_date"  value="<?php echo $row->date_depature; ?>"
                                            id="departure_date" class="form-control" required="required">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card required">
                                <div class="card-body">
                                    <h4 class="card-title">Status</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="status" name="status">
                                        <option value="<?php echo $row->status; ?>" ><?php echo $row->status; ?></option>
                                        
                                            <option value="Confirm">Confirm</option>
                                            <option value="Not Yet">Not Yet</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        


                    </div>
                    <?php } ?>
                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="update" class="btn btn-success">Update Vyavastha Adhikari</button>
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
<script type="text/javascript">
    $(document).ready(function() {
     
        var optionValues = [];
        $('#gender option').each(function() {
            if ($.inArray(this.value, optionValues) > -1) {
                $(this).remove()
            } else {
                optionValues.push(this.value);
            }
        });

        var optionValues = [];
        $('#status option').each(function() {
            if ($.inArray(this.value, optionValues) > -1) {
                $(this).remove()
            } else {
                optionValues.push(this.value);
            }
        });
    });
</script>

</html>