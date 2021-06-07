<?php
    require "Config.php";
    $obj=new Config();

    $error="";
    $step=0;
    if(isset($_POST['chk_email']))
    {
        $email_id=$_POST["email_id"];
        $Business=$obj->MyQuery("SELECT * FROM `tbl_business` WHERE `email_id`='$email_id'");
        $Business_Count=$Business->num_rows;
        if ($Business_Count!=0) 
        {
            $step=1;
            $obj->Redirect("admin/mail/forgot-password.php?email_id=$email_id");
        }
        else
        {
            $User=$obj->MyQuery("SELECT * FROM `tbl_registration` WHERE `email_id`='$email_id'");
            $User_Count=$User->num_rows;
            if ($User_Count!=0) 
            {
                $step=1;
                 
                $obj->Redirect("admin/mail/forgot-password.php?email_id=$email_id");
            }
            else
            {
                $step=0;
                $error="<span class='text-danger'>Sorry, This Email Is Wrong..</span>";
            }
        }      
    }

    if (isset($_GET['email_id'])) 
    {
        $step=1;
    }

    if (isset($_POST['chk_otp']) && isset($_POST['otp']) && isset($_GET['email_id']) && $step==1) 
    {
        $BusinessData=$obj->MyQuery("SELECT `business_id` FROM `tbl_business` WHERE `email_id`='".$_GET['email_id']."' and `otp`='".$_POST['otp']."'");
        $Business_Otp_Count=$BusinessData->num_rows;
        if ($Business_Otp_Count!=0) 
        {
            $business_fetch_data=$BusinessData->fetch_assoc();
            $business_id=$business_fetch_data['business_id'];
            $obj->Redirect("update-password.php?type=B&business_id=$business_id");
        }
        else
        {
            $UserData=$obj->MyQuery("SELECT `registration_id` FROM `tbl_registration` WHERE `email_id`='".$_GET['email_id']."' and `otp`='".$_POST['otp']."'");
            $User_Otp_Count=$UserData->num_rows;
            if ($User_Otp_Count!=0) 
            {
                $registration_fetch_data=$UserData->fetch_assoc();
                $registration_id=$registration_fetch_data['registration_id'];
                $obj->Redirect("update-password.php?type=U&registration_id=$registration_id");
            }
            else
            {
                $error="<span class='text-danger'>Sorry, Wrong OTP Input...</span>";
            }
        }   
    }
    


?>

<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:00:10 GMT -->
<head>
    <?php
        require "header.php";
    ?>
    
    </head>
    <body>
        <div class="wrapper">  
            <!-- Start Navigation -->
            <?php
                require "navigation.php";
            ?>
            <!-- End Navigation -->
            <div class="clearfix"></div>
            
            <!-- Start Login Section -->
            <section class="log-wrapper">
                <div class="container">
                    <div class="col-md-6 col-sm-10 col-md-offset-3 col-sm-offset-1">
                        <div class="log-box">
                            <h2>Forgot<span class="theme-cl">Password!</span></h2>
                            <form method="post">
                               <?php
                                    if ($step==0) 
                                    {
                                        ?>
                                            <input class="form-control" type="email" name="email_id" placeholder="Enter Email Address" data-bvalidator="required">
                                            <div class="submit-btn">
                                                <button type="submit" name="chk_email" class="btn theme-btn width-200 btn-radius">Send Otp</button>
                                            </div>
                                        <?php
                                    }
                                    else if($step==1)
                                    {
                                        ?>
                                            <input class="form-control" type="text" name="otp" placeholder="Enter Otp" data-bvalidator="required">
                                            <div class="submit-btn">
                                                <button type="submit" name="chk_otp" class="btn theme-btn width-200 btn-radius">Submit</button>
                                            </div>
                                        <?php
                                    }
                               ?>
                              
                                <div class="center">
                                    
                                    <?php
                                        echo $error;
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Login Section -->

            <!-- ================ Start Footer ======================= -->
<?php
                require "footer.php";
            ?>
            <!-- ================== Login & Sign Up Window ================== -->
             
            <!-- ===================== End Login & Sign Up Window =========================== -->
            <!-- Switcher -->
            
            
            <!-- /Switcher -->
            <a id="back2Top" class="theme-bg" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>

            
            <!-- START JAVASCRIPT -->
            <?php
                require "script.php";
            ?>            
        </div>
    </body>

<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:00:10 GMT -->
</html>
