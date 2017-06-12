<!DOCTYPE html>

<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description" />
        <meta content="" name="author" />


        <!-- BEGIN GLOBAL MANDATORY STYLES -->
            
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url(); ?>assets/plugins/socicon/socicon.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/animate/animate.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN: BASE PLUGINS  -->
        <link href="<?php echo base_url(); ?>assets/plugins/revo-slider/css/settings.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/revo-slider/css/layers.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/revo-slider/css/navigation.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/owl-carousel/assets/owl.carousel.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/slider-for-bootstrap/css/slider.css" rel="stylesheet" type="text/css" />
        <!-- END: BASE PLUGINS -->
        <!-- BEGIN THEME STYLES -->
        <link href="<?php echo base_url(); ?>assets/base/css/plugins.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/base/css/components.css" id="style_components" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/base/css/themes/default.css" rel="stylesheet" id="style_theme" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/base/css/custom.css" rel="stylesheet" type="text/css" />
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
<script src="basejs/index.js"></script>
        </head>

    <body class="" >
        <!-- BEGIN: LAYOUT/HEADERS/HEADER-ONEPAGE -->
        <!-- BEGIN: HEADER -->
        <header class="c-layout-header c-layout-header-6" id="home" data-minimize-offset="80">

            <div class="c-topbar">
                <div class="container">
                    
                    <div class="">
                        <a href="index.html" class="c-logo" style="font-size:30px;">
                                <span class="c-desktop-logo" style=""><b>INVENTORY SYSTEM</b></span><!-- 
                                <img src="base/img/layout/logos/logo-2.png" alt="JANGO" class="c-desktop-logo">
                                <img src="base/img/layout/logos/logo-2.png" alt="JANGO" class="c-desktop-logo-inverse">
                                <img src="base/img/layout/logos/logo-2.png" alt="JANGO" class="c-mobile-logo"> --> 
                            </a>
                        <!-- <ul class="c-icons c-theme-ul">
                            <li>
                                <a href="#">
                                    <i class="icon-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-social-dribbble"></i>
                                </a>
                            </li>
                        </ul> -->
                        
                        <!-- <button class="c-search-toggler" type="button">
                            <i class="fa fa-search"></i>
                        </button> -->
                    </div>
                </div>
            </div>
            
        </header>
       <!--  <div  style=" background: #fafafa url('assets/images/BACK 1.png');"> -->
        <!-- END: HEADER -->


            <!-- BEGIN: PAGE CONTAINER -->
        <div class="c-layout-page">
            <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
            
            <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
            <!-- BEGIN: PAGE CONTENT -->
            <div class="c-content-box c-size-md c-bg-white">
            <div class="container">
             
               <div class="c-content-title-1">
                        <h3 class="c-center c-font-uppercase c-font-bold">Login</h3>
                        <div class="c-line-center c-theme-bg"></div>
           
                    </div>
                             
  
                        <div class="row">
                        <div class="col-md-12">
                        <div class="c-content-panel">
                        <div class="c-body">
                        <div class="c-content-title-1 c-title-md c-margin-b-20 clearfix">
                      <h3 class="c-center c-font-uppercase c-font-bold">Enter Your Credentials</h3>
                        <div class="c-line-center c-theme-bg"></div>
                        </div>
                       
                        <div class="form-horizontal">
                       
                       <form method="POST" action="<?php echo base_url(); ?>index.php/Login/loginuser">
                            
                            <div class="form-group">
                                <label for="Username"  class="col-md-5 control-label input-lg">Username</label>
                                <div class="col-md-4">
                                    <input type="text" name="username" class="form-control  c-square c-theme" id="username" placeholder="Username" value="<?php echo set_value('username'); ?>" required> 
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputPassword3" class="col-md-5 control-label input-lg">Password</label>
                                <div class="col-md-4">
                                    <input type="password" class="form-control  c-square c-theme" id="inputPassword3" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" required> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-md-4 control-label input-lg"></label>
                                <div class="col-md-8" style="color:red;font-weight:bold;">
                                    <?php if(isset($msg)) echo $msg; ?>
                                   <?php echo validation_errors(); ?>
                               </div>
                            </div>
                            

                            <br>
                            
                            <div class="form-group">
                                <label for="inputPassword3" class="col-md-5 control-label input-lg">&nbsp;</label>
                                <div class="col-md-2 text-center">
                        
                                    <button type="submit" name="btn_login" class="btn btn-primary btn-lg btn-block">Login</button>
                                </div>
                            </div>
                        
                        </form>

                        </div>
                        
                        </div>
                        </div>
                        </div>
                        </div>
          
           </div>
           </div>
        
            <!-- END: PAGE CONTENT -->
        </div>


 
    <!-- /snippets/ajax-cart-template.liquid -->



        <!-- END: PAGE CONTAINER -->
        <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-2 -->
        <a name="footer"></a>
        <footer class="c-layout-footer c-layout-footer-1" >
            <div class="c-postfooter" style="background-color:#ADC2EB">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 text-center">
                            <p class="c-copyright c-font-oswald c-font-14" style="color:black"> Copyright &copy; 2017 </p>
                        </div>
                        <!-- <div class="col-md-6 col-sm-6">
                            <ul class="c-socials">
                                <li>
                                    <a href="#">
                                        <i class="icon-social-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-social-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-social-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-social-dribbble"></i>
                                    </a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </footer>
        <!-- END: LAYOUT/FOOTERS/FOOTER-2 -->
        <!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
        
        
   
       <?php require('footer.php'); ?>

</body>

</html>