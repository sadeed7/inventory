<!DOCTYPE html>

<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="utf-8" />
        <title>Users</title>
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
<script src="<?php echo base_url(); ?>assets/basejs/index.js"></script>
        </head>
<?php $userdata = $this->session->userdata('user'); 
    if($userdata['role'] === 'admin')
        $right = '150px';
    else if($userdata['role'] === 'seller')
        $right = '300px';
    else if($userdata['role'] === 'purchaser')
        $right = '255px';
?>
<script type="text/javascript">
    baseurl = "<?php echo base_url(); ?>";
</script>
        <style type="text/css">
            table thead tr{
            background-color: #ADC2EB;

        }
        
        </style>
    <body class="c-layout-header-fixed c-layout-header-6-topbar" >
        <!-- BEGIN: LAYOUT/HEADERS/HEADER-ONEPAGE -->
        <!-- BEGIN: HEADER -->
         <header class="c-layout-header c-layout-header-6" id="home" data-minimize-offset="80">

            <div class="c-topbar">
                <div class="container">
                    <nav class="c-top-menu">
                        <ul class="c-links c-theme-ul">
                            <li class="c-cart-toggler-wrapper">
                                    <a href="#" class="c-btn-icon c-cart-toggler">
                                        <i class="icon-bell c-bell-icon"></i>
                                        <span class="c-cart-number" style="background-color:orange" id="notcount"><?php if(isset($notifications) && $notifications) 
                                            echo Count($notifications); 
                                            else 
                                                echo 0; 
                                            ?></span>
                                    </a>
                                </li>
                            <li>
                                    <a href="<?php echo base_url(); ?>index.php/Login/logout"  class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold" >
                                        <i class="icon-user"></i> Sign Out</a>
                                </li>
                        </ul>
                        <!-- <ul class="c-ext hide c-theme-ul">
                            <li class="c-lang dropdown c-last">
                                <a href="#">en</a>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li class="active">
                                        <a href="#">English</a>
                                    </li>
                                    <li>
                                        <a href="#">German</a>
                                    </li>
                                    <li>
                                        <a href="#">Espaniol</a>
                                    </li>
                                    <li>
                                        <a href="#">Portugise</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="c-search hide">
                             
                                <form action="#">
                                    <input type="text" name="query" placeholder="search..." value="" class="form-control" autocomplete="off">
                                    <i class="fa fa-search"></i>
                                </form>
                                
                            </li>
                        </ul> -->
                    </nav>
                    <div class="c-brand">
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
                        <button class="c-topbar-toggler" type="button">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                            <span class="c-line"></span>
                            <span class="c-line"></span>
                            <span class="c-line"></span>
                        </button>
                        <!-- <button class="c-search-toggler" type="button">
                            <i class="fa fa-search"></i>
                        </button> -->
                    </div>
                </div>
            </div>
            <div class="c-navbar" style="background-color:#ADC2EB">
                <div class="container">
                    <!-- BEGIN: BRAND -->
                    <div class="c-navbar-wrapper clearfix">
                        
                        <!-- END: BRAND -->
              
                        <!-- END: QUICK SEARCH -->
                        <!-- BEGIN: HOR NAV -->
                        <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU-ONEPAGE -->
                        <!-- BEGIN: MEGA MENU -->
                        <nav class="c-mega-menu c-mega-menu-onepage c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold" data-onepage-animation-speed="300">
                            <ul class="nav navbar-nav c-theme-nav">
                                <?php if($userdata['role'] === 'admin'  || $userdata['role'] === 'purchaser' || $userdata['role'] === 'seller'){
                                 ?>
                                 <li class="c-onepage-link">
                                    <a href="<?php echo base_url(); ?>index.php/Dashboard" class="c-link">Dashboard</a>
                                </li>
                                 <?php   
                                } ?>
                                <?php if($userdata['role'] === 'admin' || $userdata['role'] === 'purchaser' || $userdata['role'] === 'seller'){?>
                                <li class="c-onepage-link">
                                    <a href="<?php echo base_url(); ?>index.php/Inventory" class="c-link">Inventory</a>
                                </li>
                                <?php } ?>
                                <?php if($userdata['role'] === 'admin' || $userdata['role'] === 'purchaser' || $userdata['role'] === 'seller'){?>
                                <li class="c-onepage-link">
                                    <a href="<?php echo base_url(); ?>index.php/Containers" class="c-link">Shipment</a>
                                </li>
                                <!-- <li class="c-onepage-link">
                                    <a href="<?php echo base_url(); ?>index.php/Exports" class="c-link">Exports</a>
                                </li> -->
                                <?php } ?>
                                <?php if($userdata['role'] === 'seller'){?>
                                <!-- <li class="c-onepage-link">
                                    <a href="<?php echo base_url(); ?>index.php/Imports" class="c-link">Imports</a>
                                </li> -->
                                <?php } ?>
                                <?php if($userdata['role'] === 'admin' || $userdata['role'] === 'purchaser'){?>
                                <li class="c-onepage-link">
                                    <a href="<?php echo base_url(); ?>index.php/Zakat" class="c-link">Zakat</a>
                                </li>
                                <?php } ?>
                                <?php if($userdata['role'] === 'admin'){?>
                                <li class="c-onepage-link c-active active">
                                    <a href="<?php echo base_url(); ?>index.php/User" class="c-link">Users</a>
                                </li>
                                <li class="c-onepage-link">
                                    <a href="<?php echo base_url(); ?>index.php/Station" class="c-link">Stations</a>
                                </li>
                                <?php } ?>

                                <li class="">
                                    <a href="javascript:;" class="c-link dropdown-toggle">Reports
                                        <span class="c-arrow c-toggler"></span>
                                    </a>
                                    <div class="dropdown-menu c-menu-type-mega" style="right: <?php echo $right; ?>; background-color:#ADC2EB;">
                                        
                                        <ul class="dropdown-menu c-menu-type-inline">
                                            <li >
                                                <a href="<?php echo base_url(); ?>index.php/Report/accountdetails" style="color:white">Account Details</a>
                                            </li>
                                            <li class="">
                                                <a href="<?php echo base_url(); ?>index.php/Report/account" style="color:white">Accounts Summary</a>
                                            </li>   
                                            <li class="">
                                                <a href="<?php echo base_url(); ?>index.php/Report/expense" style="color:white">Expense Details</a>
                                            </li> 
                                            <?php if($userdata['role'] === 'admin' || $userdata['role'] === 'purchaser'){?>
                                            <li >
                                                <a href="<?php echo base_url(); ?>index.php/Report/purchase" style="color:white">Purchase Report</a>
                                            </li>
                                            <?php } ?>
                                            <?php if($userdata['role'] === 'admin' || $userdata['role'] === 'seller'){?>       
                                            <li class="">
                                                <a href="<?php echo base_url(); ?>index.php/Report/sales" style="color:white">Sales Report</a>
                                            </li>
                                            <?php } ?>
                                              
                                               
                                        </ul>
                                            
                                    <div>        
                                </li>
                                
                                
                               
                            </ul>
                        </nav>
                        <!-- END: MEGA MENU -->
                        <!-- END: LAYOUT/HEADERS/MEGA-MENU-ONEPAGE -->
                        <!-- END: HOR NAV -->
                    </div>

                    <div class="c-cart-menu">
                        
                        <ul class="c-cart-menu-items">
                            <?php if(isset($notifications) && $notifications){
                                foreach ($notifications as $notification) {
                            ?>  
                                <?php 
                                    if($notification->type === 'funds'){
                                ?>
                                <li id="fund<?php echo $notification->fund; ?>">
                                    <input class="id" type="hidden" value="<?php echo $notification->id; ?>">
                                    <div class="c-cart-menu-close">
                                        <button class="btn btn-primary fund" value="<?php echo $notification->fund; ?>">Received</button>
                                    </div>
                                    <a href="javascript:;" class="c-item-name c-font-sbold fund"><?php echo $notification->message; ?></a>
                                
                                </li>
                                <?php        
                                    }else{
                                ?>
                                <li id="other<?php echo $notification->id; ?>">
                                    
                                    <div class="c-cart-menu-close">
                                        <a href="<?php echo $notification->id; ?>" class="c-theme-link other">×</a>
                                    </div>
                                    <a href="<?php echo $notification->id; ?>" class="c-item-name c-font-sbold other"><?php echo $notification->message; ?></a>
                                
                                </li>
                                <?php        
                                    }
                                ?>
                                
                            <?php        
                                }
                            } ?>
                            
                           
                        </ul>
                        
                    </div>


                </div>
            </div>
        </header>
       <!--  <div  style=" background: #fafafa url('assets/images/BACK 1.png');"> -->
        <!-- END: HEADER -->


            <!-- BEGIN: PAGE CONTAINER -->
        <div class="c-layout-page">
            <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
            <div class="c-layout-breadcrumbs-1 c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
                <div class="container" >
                    <div class="c-page-title c-pull-left">
                        <h3 class="c-font-uppercase c-font-bold">Users</h3>
                        <h4 class=""></h4>
                    </div>
                    <ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
                        <li>
                            <a href="">Admin</a>
                        </li>
                        <li>/</li>
                        <li class="c-state_active">User</li>
                        
                </div>
            </div>
            
            <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
            <!-- BEGIN: PAGE CONTENT -->
            <div class="c-content-box c-size-md c-bg-white">
            <div class="container">
            
            <?php 
                if(isset($status)){ 
                    if($status === 'success'){
            ?>
                        <div class="alert alert-success alert-dismissible" role="alert"> <?php if(isset($msg)) echo $msg; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
            <?php   }else{
            ?>
                        <div class="alert alert-danger alert-dismissible" role="alert"><?php if(isset($msg)) echo $msg; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
            <?php    
                    }
                }    
            ?>

            <div class="c-content-title-1">
                        <h3 class="c-center c-font-uppercase c-font-bold">Add User</h3>
                        <div class="c-line-center c-theme-bg"></div>
          
                    </div>
               
                             
  
                        <div class="row">
                        <div class="col-md-12">
                        <div class="c-content-panel" style="border-color: inherit;">
                        <div class="c-body">
                    

                        <div class="form-horizontal">
                        <form method="POST" action="<?php echo base_url(); ?>index.php/User/<?php if(isset($user)) echo 'edit'; else echo 'adduser'; ?>">
                            <?php if(isset($user)) {
                            ?>
                                <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                            <?php } ?>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-md-4 control-label input-lg">Full Name</label>
                            <div class="col-md-6">
                                <input type="text" name="fullname" class="form-control  c-square c-theme" value="<?php if(isset($user)){ echo $user->fullname; } ?>" id="fullname" placeholder="Name" required> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-md-4 control-label input-lg">Station</label>
                            <div class="col-md-6">
                                <select class="form-control  c-square c-theme" name="stations" id="stations" required>
                                    <option>Select Station</option>
                                    <?php 
                                        if(isset($stations) && $stations){ 
                                            foreach ($stations as $station) {
                                    ?>
                                        <option value="<?php echo $station->id; ?>" <?php if(isset($user) && $station->id === $user->station) echo "Selected"; ?>><?php echo $station->name; ?></option>
                                    <?php
                                            }  
                                        } 
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Username"  class="col-md-4 control-label input-lg">Username</label>
                            <div class="col-md-6">
                                <input type="text" name="username" class="form-control  c-square c-theme" id="username" placeholder="Username" value="<?php if(isset($user)){ echo $user->username; } ?>" required> 
                            </div>
                        </div>
                        <?php if(!isset($user)){ ?>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-md-4 control-label input-lg">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control  c-square c-theme" id="password" name="password" placeholder="Password" required> 
                            </div>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                            <label for="Role" class="col-md-4 control-label input-lg">Role</label>
                            <div class="col-md-6">
                                <input type="radio" class=" c-square c-theme" name="role" value="seller" <?php if(isset($user) && $user->role === "seller") echo "Checked"; ?> required >Seller
                            </div>
                            <br>
                            <div class="col-md-6">
                                <input type="radio" class=" c-square c-theme" name="role" value="purchaser" <?php if(isset($user) && $user->role === "purchaser") echo "Checked"; ?> required>Purchaser
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputPassword3" class="col-md-4 control-label input-lg"></label>
                            <div class="col-md-6" style="color:red;font-weight:bold;">
                                <?php echo validation_errors(); ?> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-md-4 control-label input-lg">&nbsp;</label>
                            <div class="col-md-6">
                                <label>&nbsp;</label>
                                <button type="submit" name="btn_Adduser" class="btn btn-primary btn-lg btn-block"><?php if(isset($user)) echo "Update"; else echo "Add User"; ?></button>
                            </div>
                        </div>
                        
                        </form>
                        </div>
                        
                        </div>
                        </div>
                        </div>
                        </div>


                   <div class="c-content-panel" style="border-color: inherit;">
                        <div class="c-label">Users</div>
                        <div class="c-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" >
                                        <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Station Name</th>
                                                <th>User Name</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php if(isset($users) && $users){
                                                    foreach ($users as $user) {
                                            ?> 
                                                    <tr>
                                                        <td><?php echo $user->fullname; ?></td>
                                                        <td><?php echo $user->stationname; ?></td>
                                                        <td><?php echo $user->username; ?></td>
                                                        <td><?php echo $user->role; ?></td>
                                                        <td><a href="<?php echo base_url(); ?>index.php/User/delete/<?php echo base64_encode($user->id); ?>" onClick="return conformation();" style="float: right;"><b>Delete</b></a><a href="<?php echo base_url(); ?>index.php/User/get/<?php echo base64_encode($user->id); ?>" onClick="return conformation();" style="float:left;"><b>Edit</b></a></td>
                                                    </tr>  
                                            
                                            <?php 
                                                    }
                                                } 
                                            ?>
                                            
                                          
                                        </tbody>
                                    </table>
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
        <div class="c-layout-go2top">
            <i class="icon-arrow-up"></i>
        </div>
        <!-- END: LAYOUT/FOOTERS/GO2TOP -->
        <!-- BEGIN: LAYOUT/BASE/BOTTOM -->
        <!-- BEGIN: CORE PLUGINS -->
        <!--[if lt IE 9]>
	<script src="../assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->

    <script src="<?php echo base_url(); ?>assets/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery.easing.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/reveal-animate/wow.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/base/js/scripts/reveal-animate/reveal-animate.js" type="text/javascript"></script>
        <!-- END: CORE PLUGINS -->
        <!-- BEGIN: LAYOUT PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/smooth-scroll/jquery.smooth-scroll.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/slider-for-bootstrap/js/bootstrap-slider.js" type="text/javascript"></script>
        <!-- END: LAYOUT PLUGINS -->
        <!-- BEGIN: THEME SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/base/js/components.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/base/js/components-shop.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/base/js/app.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/base/js/scripts/pages/modals.js" type="text/javascript"></script>
        <script>
            $(document).ready(function()
            {
                App.init(); // init core    
            });
        </script>
     <script type="text/javascript" src="<?php echo base_url(); ?>assets/lugins/imagezoom/js/jquery.imagezoom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/imagezoom/js/modernizr.custom.17475.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/imagezoom/js/jquery.elastislide.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/filter.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/js/DT_bootstrap.js"></script>


       <script type="text/javascript">
            
                $(function()
            {
$('a[title]').tooltip();
            });
           
            

        </script>
 <script>
     function conformation()
         {
           job=confirm("Do You Want To Take This Action?");
           if(job!=true)
         {
           return false;
      }
}
</script>
<script src="<?php echo base_url(); ?>assets/core/notification.js"></script>

</body>

</html>