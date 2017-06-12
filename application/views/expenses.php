<!DOCTYPE html>

<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="utf-8" />
        <title>Expense Details</title>
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
<?php $userdata = $this->session->userdata('user'); 
    if($userdata['role'] === 'admin')
        $right = '150px';
    else if($userdata['role'] === 'seller')
        $right = '300px';
    else if($userdata['role'] === 'purchaser')
        $right = '255px';
?>
<script type="text/javascript">
    baseurl = "<?php echo base_url(); ?>"
</script>
 <!-- Fine Uploader Thumbnails template w/ customization
    ====================================================================== -->
        <style type="text/css">
        .c-layout-header .c-navbar .c-mega-menu.c-mega-menu-dark > .nav.navbar-nav > li .dropdown-menu > li.c-active > a, .c-layout-header .c-navbar .c-mega-menu.c-mega-menu-dark > .nav.navbar-nav > li .dropdown-menu > li:hover > a{
            background-color: #fff;
        }
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
        #tablestockin .link :hover{
            cursor: pointer;
        }
        </style>
        <script type="text/javascript">
            
        </script>
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
                                <li class="c-onepage-link ">
                                    <a href="<?php echo base_url(); ?>index.php/User" class="c-link">Users</a>
                                </li>
                                <li class="c-onepage-link">
                                    <a href="<?php echo base_url(); ?>index.php/Station" class="c-link">Stations</a>
                                </li>
                                <?php } ?>

                                <li class="c-active active">
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
                                            <li class="c-active">
                                                <a href="<?php echo base_url(); ?>index.php/Report/expense" style="color:white">Expense Details</a>
                                            </li> 
                                            
                                            <?php if($userdata['role'] === 'admin' || $userdata['role'] === 'purchaser'){?>
                                            <li >
                                                <a href="<?php echo base_url(); ?>index.php/Report/purchase" style="color:white">Purchase Report</a>
                                            </li>
                                            <?php } ?>

                                            <?php if($userdata['role'] === 'admin' || $userdata['role'] === 'seller'){?>       
                                            <li >
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
        <!-- END: HEADER -->
        <!-- END: LAYOUT/HEADERS/HEADER-1 -->
       <!-- BEGIN: CONTENT/USER/LOGIN-FORM -->
        
        <!-- END: CONTENT/USER/LOGIN-FORM -->
        <!-- BEGIN: PAGE CONTAINER -->
        <div  class="c-layout-page" >
            <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
            <div class="c-layout-breadcrumbs-1 c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
                <div class="container" >
                    <div class="c-page-title c-pull-left">
                        <h3 class="c-font-uppercase c-font-bold">Reports</h3>
                        <h4 class=""></h4>
                    </div>
                    <ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
                        <li>
                            <a href="">Admin</a>
                        </li>
                        <li>/</li>
                        <li class="c-state_active">Reports</li>
                        <li>/</li>
                        <li class="c-state_active">Expense Details</li>
                    </ul>
                </div>
            </div>
            <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
            <!-- BEGIN: PAGE CONTENT -->
            <!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
            <div class="c-content-box  c-overflow-hide c-bg-white">
                <div class="container">
                    <div class="c-shop-product-details-2">
                     
                        
                        <div class="row">
                            
                            <div class="c-content-box c-size-md">
                <div class="container">
                     <div class="row">
                        <?php 
                            if(isset($status)){ 
                                if($status === 'error'){
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
                                
                               <div class="row">
                                    <form method="POST" action="<?php echo base_url(); ?>index.php/Report/getexpense">
                                    <?php if ($userdata['role'] === 'admin') {
                                    ?>

                                   
                                    <div class="col-md-4">
                                        <label  style="float:right"><b>Station:</b></label>
                                    </div>
                                     <div class="col-md-4">
                                        <select class="form-control c-square c-theme" name="station">
                                            <option value="">Select Station</option>
                                            <?php if(isset($stations) && $stations){
                                                foreach ($stations as $station) {
                                            ?>
                                                <option value="<?php echo $station->id; ?>"><?php echo $station->name; ?></option>
                                            <?php        
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                     <?php
                                    } ?>
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="col-md-4">
                                        <label  style="float:right"><b>Filters:</b></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label><input type="radio" name="filter" value="custom" checked>&nbsp;Custom Date &nbsp;&nbsp;&nbsp;</label>
                                        <label><input type="radio" name="filter" value="predefined">&nbsp;Predefined Filters</label>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <br>
                                    <div id="prefilter" style="display:none;">
                                        <div class="col-md-4">
                                        <label  style="float:right"><b>PreDefined Filters:</b></label>
                                    </div>
                                    <div class="col-md-4">
                                        <label><input type="radio" name="pre" value="year" checked>&nbsp;Year To Date &nbsp;&nbsp;&nbsp;</label>
                                        <label><input type="radio" name="pre" value="month">&nbsp;Month To Date &nbsp;&nbsp;&nbsp;</label>
                                        <label><input type="radio" name="pre" value="week">&nbsp;Week</label>
                                    </div>
                                    </div>
                                    <div id="datefilter">
                                    <div class="col-md-4">
                                        <label style="float:right"><b>Date:</b></label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control c-square c-theme datepicker1" name="from" id="from" placeholder="mm/dd/yyyy (From)">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control c-square c-theme datepicker1" name="to" id="to" placeholder="mm/dd/yyyy (To)">
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Generate Report</button>
                                    </div>
                                    </form>
                               </div>
                               <br>
                               <div class="row">
                            
                            <h1><b>Expense<?php if(isset($from) && isset($to)) echo "(".date('d M, Y', strtotime($from))."-".date('d M, Y', strtotime($to)).")"; ?></b></h1>

                            <hr>
                            
                            <div class="col-md-12 text-center" style="border:1px solid;color:white;background-color:#5E9CD1">
                                <label><b> Total Expenses :  $<?php if(isset($total)) echo $total; else echo 0; ?></b></label>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="col-md-12 col-sm-12">
                                <div class="row" id="filter">
                                    
                                    <table  cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sr #</th>
                                                <th>Expense Type</th>
                                                <th>Expense Location</th>
                                                <th>Expense Amount</th>
                                                <th>Expense Date</th>
                                                
       
                                            </tr>
                                        </thead>
                                        <tbody id="tablestockin">
      
                                            <?php if(isset($expenses) && $expenses){
                                                $index = 1;
                                                foreach ($expenses as $expense) {
                                            ?>  
                                                    <tr  class="odd gradeX <?php if(!is_null($expense->refrence)) echo 'link'; ?>">

                                                        <td class="hidden-480"><?php echo $index; ?><?php if(!is_null($expense->refrence)) echo "<input type='hidden' value='$expense->refrence' class='id'>"; ?></td>
                                                        <td class="hidden-480 token"><?php echo $expense->type; ?></td>

                                                        <td class="hidden-480"><?php echo $expense->location; ?></td>
                                                        <td class="hidden-480"><?php echo $expense->price; ?></td>
                                                        <td class="hidden-480"><?php echo $expense->date; ?></td>
                                                       
                                                    </tr>
                                            <?php        
                                                $index++;
                                                }
                                            } ?> 
 
                                 
      
                                        </tbody>
                                    </table>
                                   
                                </div>
                                
                            </div>          
                           
                        </div>
                           
                            



                          
                     </div>
                
              
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
        <div class="modal fade" id="vehicleinfo" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content c-square">
                    <div class="modal-header " style="background-color:#ADC2EB">
                        <button type="button" style="float:right; " class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 style="" id="vehicletitle">TITLE</h2>
                        <input type="hidden" value="" id="id">
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
                                <label>Added By: <span id="addedby">User</span></label>
                                <label>Current Location: <span id="location">Location</span></label>
                                <label>Purchase Price: $<span id='price'>Price</span></label>
                                <br>
                                <label>Total Cost: $<span id='cost'>Cost</span></label>
                                
                                <br>
                                <div id="time">
                                    
                                </div>
                                <label>Status: <span class="alert-success" id="status">Status</span></label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                               
                            <div class="col-md-12 text-center">
                                <?php 
                                    if($userdata['role'] === 'seller'){
                                ?>
                                <button class="btn  c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" id="sellbtn" onclick="$('#sellData').show();">Sell</button>
                                <?php 
                                    }
                                ?>
                                <?php 
                                    if($userdata['role'] === 'purchaser'){
                                ?>
                                    <button class="btn  c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" id='editVehicle'>Edit</button>

                                    <button class="btn  c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" id="exportbtn">Export</button>
                                <?php 
                                    }
                                ?>
                            </div>

                        </div>
                        <br>
                        <div class="row" id="exportData" style="display:none;">
                            <form id="exportform">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Destination:</label>
                                    
                                    <div class="col-md-9">
                                        <select class="form-control c-square c-theme" name="destination" required>
                                            <option>Select Destination</option>
                                            <?php if(isset($stations) && $stations){
                                                foreach ($stations as $station) {
                                            ?>
                                                    <option value="<?php echo $station->id; ?>"><?php echo ucfirst($station->name); ?></option>
                                            <?php        
                                                }
                                            } ?>
                                            
                                        </select>
                                    </div>
                                    

                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <div class="form-group">
                                    
                                    <label for="inputEmail3" class="col-md-3 control-label">Shipping Price:</label>
                                    
                                    <div class="col-md-9">
                                        <input type="text" class="form-control c-square c-theme" name="shippingprice" id="shippingprice" placeholder="Price" required="">
                                    </div>
                                    
                                </div>
                                <div class="clearfix"></div>
                                
                                <br>

                                <div class="form-group">
                                    
                                    <label for="inputEmail3" class="col-md-3 control-label">Delivery Date:</label>
                                    
                                    <div class="col-md-9">
                                        <input type="text" class="form-control c-square c-theme datepicker1" name="deliverydate" id="deliverydate" placeholder="mm/dd/yyyy" required="">
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
                        <div class="row" id="sellData" style="display:none;">
                            <form id="sellform">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-2 control-label">Price:</label>
                                    <div class="col-sm-1"></div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control c-square c-theme" name="sellingprice" id="sellingprice" placeholder="$Price" required="">
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

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
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
    $('.datepicker1').datepicker({
        format: 'mm/dd/yyyy',
        
    });

    //Radio Button Value Changed
    $(':radio[name="filter"]').change(function() {
        filter = $(this).filter(':checked').val();
        if(filter === 'custom'){
            $('#prefilter').hide();
            $('#datefilter').show();
            $('#datefilter #from').val('');
            $('#datefilter #to').val('');
        }else if(filter === 'predefined'){
            $('#datefilter').hide();
            $('#prefilter').show();
            $('#datefilter #from').val('');
            $('#datefilter #to').val('');
        }
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


    
});
</script>
<script src="<?php echo base_url(); ?>assets/core/notification.js"></script>
<script src="<?php echo base_url(); ?>assets/core/expenses.js"></script>
</body>

</html>