<?php
    require "Config.php";
    $obj=new Config();

    $error="";
    $step=0;
    $email_id="";
    $question="";
    $ide=0;
    $type="";
    if(isset($_POST['btn_send']))
    {
        $type=$_GET['type'];
        if ($type=="B") 
        {
            $IntData["password"]=md5($_POST['password']);
            $where['business_id']=$_GET['business_id'];
            $result= $obj->myUpdate("tbl_business",$IntData,$where);
            if ($result>0) 
            {
                $obj->Redirect("login-register.php");
            }
            else
            {
                $error="<div  class=\"alert alert-success\">Fail...</div>";
            }
        }
        elseif ($type=="U") 
        {
            $IntData["password"]=md5($_POST['password']);
            $where['registration_id']=$_GET['registration_id'];
            $result= $obj->myUpdate("tbl_registration",$IntData,$where);
            if ($result>0) 
            {
                $obj->Redirect("login-register.php");
            }
            else {
                   $error="<div  class=\"alert alert-success\">Fail...</div>";
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
                                <div class="input-group">
                                    <input type="hidden" value="<?php echo $step; ?>" name="step" class="form-control">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope theme-cl"></i></span>
                                    <input type="password" name="password" placeholder="New Password" data-bvalidator="required" required="" class="form-control" >
                                </div>                                
                                <div class="center">
                                    <?php
                                        echo $error;
                                    ?>
                                    <button type="submit" name="btn_send" class="btn theme-btn width-200 btn-radius">Enter</button>
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
