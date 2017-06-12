<!DOCTYPE html>

<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="utf-8" />
        <title>Shipment</title>
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
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
        
        <!-- BEGIN: BASE PLUGINS  -->
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
        <link rel="shortcut icon" href="favicon.ico" /> </head>
           
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/imagezoom/css/imagezoom/imagezoom.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/imagezoom/css/elastislide/es-cus.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/lib/css/DT_bootstrap.css"/>

<link href="<?php echo base_url(); ?>assets/plugins/fine-uploader/fine-uploader-new.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/plugins/fine-uploader/fine-uploader.js"></script>
<?php $userdata = $this->session->userdata('user'); 
    if($userdata['role'] === 'admin')
        $right = '150px';
    else if($userdata['role'] === 'seller')
        $right = '300px';
    else if($userdata['role'] === 'purchaser')
        $right = '255px';
?>
<script type="text/javascript">
    var role = "<?php echo $userdata['role']; ?>"
    var baseurl = "<?php echo base_url(); ?>";
</script>
 
        <style type="text/css">
        table thead tr{
            background-color: #ADC2EB;

        }
        

        div.stars {
  width: 230px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: left;
  padding-right: 10px;
  font-size: 20px;
  color: #FD4;
  transition: all .25s;
}


label.star:before {
  content: '\f005';
  font-family: FontAwesome;
}
.demowrap
{   

    display:block;
}
.demowrap img
{   
    width:100%;
}
 #trigger-upload {
            color: white;
            background-color: #00ABC7;
            font-size: 14px;
            padding: 7px 20px;
            background-image: none;
        }

        #fine-uploader-manual-trigger .qq-upload-button {
            margin-right: 15px;
        }

        #fine-uploader-manual-trigger .buttons {
            width: 36%;
        }

        #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
            width: 60%;
        }
        #tablecontainers :hover{
            cursor: pointer;
        }
        </style>
        
    <body class="c-layout-header-fixed c-layout-header-6-topbar">
        <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
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
                                <li class="c-onepage-link c-active active">
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
                                <li class="c-onepage-link ">
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
                                    <a href="<?php echo $notification->fund; ?>" class="c-item-name c-font-sbold fund"><?php echo $notification->message; ?></a>
                                
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
        <!-- END: HEADER -->
        <!-- END: LAYOUT/HEADERS/HEADER-1 -->



        <!-- BEGIN: Multiple Export FORM -->
        <div class="modal fade " id="multipleexport" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content c-square">
                    <div class="modal-header" style="background-color:#ADC2EB;">
                        <button type="button" style="float:right; " class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 style="">Container</h2>
                        
                    </div>
                    <div class="modal-body">
                        
                        <form id="multiexport_form">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-4 control-label">Refrence Number:</label>
                               
                                <div class="col-md-8">
                                    <input type="text" class="form-control c-square c-theme" name="refrence" id="refrence" placeholder="Container ref." required="">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-4 control-label">Vehicles:</label>
                                
                                <div class="col-md-8">
                                    <select class="form-control c-square c-theme" id="vehicles">
                                        <?php 
                                            if(isset($vehicles) && $vehicles){
                                                $i = 0;
                                                foreach ($vehicles as $vehicle) {
                                        ?>
                                                    <option value="<?php echo $vehicle->id; ?>" id="<?php echo $i; ?>"><?php echo $vehicle->chassis; ?> (<?php echo $vehicle->name; ?> <?php echo $vehicle->year; ?>)</option>
                                        <?php            
                                                    $i++;
                                                }
                                            }
                                        ?>
                                      
                                    </select> 
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-4 control-label">Selected Vehicles:</label>
                                
                                <div class="col-md-8" style="height: 300px;border: 1px solid;overflow-y: scroll;">
                                     <div class="row" id="selectedvehicles">
                                        
                                     </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-4 control-label">Destination:</label>
                                
                                <div class="col-md-8">
                                    <select class="form-control c-square c-theme" name="destination">
                                        
                                            <?php if(isset($stations) && $stations){
                                                foreach ($stations as $station) {
                                                    if($station->id !== $userdata['location']){
                                            ?>      

                                                        <option value="<?php echo $station->id; ?>"><?php echo ucfirst($station->name); ?></option>
                                            <?php 
                                                    }       
                                                }
                                            } ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                    
                                <label for="inputEmail3" class="col-md-4 control-label">Shipping Price:</label>
                                    
                                <div class="col-md-8">
                                    <input type="text" class="form-control c-square c-theme" name="shippingprice" id="shippingprice" placeholder="Price" required="">
                                </div>
                                    
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">    
                                <label for="inputEmail3" class="col-md-4 control-label">Delivery Date:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control c-square c-theme datepicker1" name="deliverydate" id="deliverydate" placeholder="mm/dd/yyyy" required="">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group text-center" id="containerVerificationError" style="color:red;font-weight:bold;">
                                
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group c-margin-t-40">
                                <div class="col-md-12 c-center">
                                    <button type="submit" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" style="width: 200px;" value="save" id="addvehiclebtn">Save</button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Multiple Export FORM -->

        <!-- BEGIN: PAGE CONTAINER -->
        <div  class="c-layout-page" >
            <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
            <div class="c-layout-breadcrumbs-1 c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
                <div class="container" >

                    <div class="c-page-title c-pull-left">
                        <h3 class="c-font-uppercase c-font-bold">Containers</h3>
                       <!--  <h4 class="">Inventory In And Out</h4> -->
                    </div>
                    <ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
                        <li>
                            <a href="">Admin</a>
                        </li>
                        <li>/</li>
                        <li class="c-state_active">Containers</li>
                    </ul>
                </div>
            </div>
            <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
            <!-- BEGIN: PAGE CONTENT -->
            <!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
            <div class="c-content-box c-overflow-hide c-bg-white">
                <div class="container">
                    <div id="alert"></div>
                    <div class="c-shop-product-details-2">
                     
                        <div class="row">
                            <?php 
                                if($userdata['role'] === 'purchaser'){
                            ?>
                            
                            <button class="btn btn-primary" style="float:right;margin-right:5px;" data-toggle="modal" data-target="#multipleexport">Add Container</button>
                            
                            <?php
                                }
                            ?>
                            <h1><b>Containers</b></h1>
                            <hr>
                            <div class="col-md-12 col-sm-12">
                                <div class="row" id="filter">
                                    
                                    <table  cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered" id="datatable1">
                                        <thead>
                                            <tr>
                                                <th>Sr #</th>
                                                <th>Container Refrence</th>
                                                <th>Destination</th>
                                                <th>Shipping Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablecontainers">
      
                                        <?php 
                                            if(isset($containers) && $containers){ 
                                                $index = 1;
                                                foreach ($containers as $container) {

                                            ?>
                                                    <tr  class="odd gradeX" id="container<?php echo $container->id; ?>">

                                                        <td class="hidden-480">
                                                            <span class="sr"><?php echo $index; ?></span>
                                                            <input type="hidden" class="id" value= "<?php echo $container->id; ?>">
                                                        </td>
                                                        <td class="hidden-480 token"><?php echo $container->refrence; ?></td>
                                                        <td class="hidden-480"><?php echo $container->location; ?></td>
                                                        <td class="hidden-480 location"><?php echo $container->shippingdate; ?></td>
                                                        <td class="hidden-480 location st"><?php echo $container->status; ?></td>

                                                    </tr> 
                                        <?php 
                                                $index++;
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

            <!-- END: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
            
                      
            <!-- END: PAGE CONTENT -->
        </div>
        <!-- style="background-color:grey;color:white" -->
        <div class="modal fade" id="containerinfo" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content c-square">
                    <div class="modal-header " style="background-color:#ADC2EB">
                        <button type="button" style="float:right; " class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 style="" id="containertitle">Container</h2>
                        
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-7" style="border: 1px solid;height: 210px;overflow-y: scroll;width: 300px;margin-right: 20px;margin-left: 20px;">
                                
                                    
                                <div  id="vehicles">
                                    Vehicles
                                </div>

                                
                                
                            </div>
                            <div class="col-md-5 ">
                                <label>Refrence:     <span id="refrence">Refrence</span></label>
                                <br>
                               
                                <label>Destination: <span id="destination">Destination</span></label>
                                <label>Expected Delivery: <span id="expected">Expected Delivery</span></label>
                                <label>Status: <span class="alert-warning" id="status">Status</span></label>
                                <br>
                                <label>Shipment Cost: $<span id='cost'>Cost</span></label>
                                
                                <br>
                                
                                <div id="time">
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>





        <!-- Vehicle View -->
            <div class="modal fade" id="vehicleinfo" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content c-square">
                    <div class="modal-header" style="background-color:#ADC2EB">
                        <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 style="" id="vehicletitle">TITLE</h2>
                        
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                    </ol> -->
                                    <div class="carousel-inner" id="images">
                                        Images
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                        <span class="sr-only">Next</span>
                                    </a>


                                </div>
                                
                            </div>
                            <div class="col-md-5 ">
                                <label>Year:     <span id="year">Year</span></label>
                                <br>
                                <div class="stars">
                                    <form action="" id="stars">
    
                                    </form>
                                </div>
                                <label>Exported By:<span id="addedby">User</span></label>
                                <label>Destination: <span id="destination">Destination</span></label>
                                <label>Days Passed: <span id="dayspassed">Days Passed</span></label>
                                <label>Expected Delivery: <span id="deliverydate">Delivery Date</span></label>
                                <label>Status: <span class="alert-warning" id="status">En route</span></label>
                                
                            </div>
                        </div>
                        <br>
                        <div class="row">
                               
                            <div class="col-md-12 text-center">
                                <?php 
                                    if($userdata['role'] === 'seller'){
                                ?>
                                    <button class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" id="rec" onclick="$('#received').show();">Received</button>
                                <?php 
                                    }
                                ?>
                            </div>

                        </div>

                        <br>
                        <div class="row" id="received" style="display:none;">
                            <form id="receivedform">
                                <input type="hidden" name="id" value="" id="id">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-2 control-label">Tax:</label>
                                    <div class="col-sm-1"></div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control c-square c-theme" name="tax" id="tax" placeholder="$Price" required="">
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <br>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-2 control-label">Transport Charges:</label>
                                    <div class="col-sm-1"></div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control c-square c-theme" name="transport" id="transport" placeholder="$Price" required="">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group c-margin-t-40">
                                    <div class="col-md-12 c-center">
                                        <button type="submit" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" style="width: 200px;">Submit</button>            
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vehicle View -->








        <!-- END: PAGE CONTAINER -->
        <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-6 -->
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
        <!-- END: LAYOUT/FOOTERS/FOOTER-6 -->
        <!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
        <div class="c-layout-go2top">
            <i class="icon-arrow-up"></i>
        </div>
        


        <script src="<?php echo base_url(); ?>assets/plugins/jquery.min.js" type="text/javascript"></script>



        <script src="<?php echo base_url(); ?>assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery.easing.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/reveal-animate/wow.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/base/js/scripts/reveal-animate/reveal-animate.js" type="text/javascript"></script>
        <!-- END: CORE PLUGINS -->

        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>

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


        <!-- END: PAGE SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/imagezoom/js/jquery.imagezoom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/imagezoom/js/modernizr.custom.17475.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/imagezoom/js/jquery.elastislide.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/filter.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/js/DT_bootstrap.js"></script>

        <!-- END: LAYOUT/BASE/BOTTOM -->
        <script>

   $(document).ready(function() {
    
    $(function () {
        var isIE = window.ActiveXObject || "ActiveXObject" in window;
        if (isIE) {
            $('.modal').removeClass('fade');
        }
        
    });


    $('.datepicker1').datepicker({
        format: 'mm/dd/yyyy',
        startDate: '0d'
    });

    $('.datatable').dataTable({
     "sPaginationType": "bs_full"
    }); 
    $('.datatable').each(function(){
     var datatable = $(this);
     // SEARCH - Add the placeholder for Search and Turn this into in-line form control
     var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
     search_input.attr('placeholder', 'Search');
     search_input.addClass('form-control input-sm');
     // LENGTH - Inline-Form control
     var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
     length_sel.addClass('form-control input-sm');
    });


    //Model Closing
    $('#vehicleinfo').on('hidden.bs.modal', function () {
    // do something…
        
        $('#exportData',this).hide();
        $('#sellData',this).hide();
    });


});


</script>
<script src="<?php echo base_url(); ?>assets/core/vehicle.js"></script>
<script src="<?php echo base_url(); ?>assets/core/notification.js"></script>
<script src="<?php echo base_url(); ?>assets/core/multiple.js"></script>
</body>

</html>