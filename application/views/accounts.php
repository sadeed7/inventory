<!DOCTYPE html>

<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="utf-8" />
        <title>Accounts</title>
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
    baseurl = "<?php echo base_url(); ?>";
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
        #tablestockin :hover{
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
                                            <li class="c-active">
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
                        
                        <li class="c-state_active">Reports</li>
                        <li>/</li>
                        <li class="c-state_active">Accounts</li>
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
                            
                               
                               <div class="row">
                                    
                                    <div class="col-md-4"></div>
                                    
                                     <div class="col-md-4">
                                        <?php if($userdata['role'] !== 'seller'){ ?>
                                        <select class="form-control c-square c-theme" id="accountchange">
                                            <option value=''>Select Account</option>
                                            <option value="all">Over All</option>
                                            <?php if(isset($stations)){
                                                foreach ($stations as $station) {
                                            ?>
                                                    <option value="<?php echo $station->id; ?>"><?php echo ucfirst($station->name); ?></option>
                                            <?php         
                                                    
                                                }
                                            } ?>
                                         
                                        </select>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?php if($userdata['role'] !== 'admin'){ ?>
                                        <button class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#addexpense">Add Expense</button>
                                        <?php } ?>
                                        <?php if($userdata['role'] === 'seller'){ ?>
                                        <button class="btn btn-primary" style="float:right;margin-right:5px;" data-toggle="modal" data-target="#fundtransfer">Transfer Funds</button>
                                        <?php } ?>
                                    </div>

                                    <div class="clearfix"></div>
                                    <br>
                                    
                               </div>

                               <div class="row">
                            
                            <h1><b>Accounts</b></h1>

                            <hr>
                            <div class="col-md-5 text-center" >
                                <label style="border:1px solid;color:white;background-color:#5E9CD1" class="col-md-12"><b>Total Assets</b></label>
                                <div id="singleasset">
                                <div style="padding:30px;margin-top:20px;" >
                                    <div class="asset col-md-12">
                                        <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;Cash</label>
                                        <label class="amount" style="float:right;">$ <?php 
                                            if(isset($Assets['Cash']) && $Assets['Cash']) 
                                                echo $Assets['Cash']; 
                                            else
                                                echo 0;
                                        ?></label>
                                    </div>

                                    <div class="asset col-md-12">
                                        <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;Inventory</label>
                                        <label class="amount" style="float:right;">$ <?php 
                                            if(isset($Assets['Inventory']) && $Assets['Inventory']) 
                                                echo $Assets['Inventory']; 
                                            else
                                                echo 0;
                                        ?></label>
                                    </div>

                                </div>

                                <div class="total col-md-12" style="margin-top:90px; border-top:2px solid;" >
                                        <label style="float:left;"><!-- <i class="fa fa-plus"></i> -->&nbsp;&nbsp;&nbsp;<b>Total</b></label>
                                        <label class="amount" style="float:right;"><b>$ <?php 
                                            $sum = 0;
                                            if(isset($Assets['Cash']) && $Assets['Cash']) 
                                                $sum += $Assets['Cash']; 
                                            if(isset($Assets['Inventory']) && $Assets['Inventory']) 
                                                $sum += $Assets['Inventory'];
                                            echo $sum;
                                        ?></b></label>
                                </div>
                            </div>

                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5 text-center">
                                <label style="border:1px solid;color:white;background-color:#5E9CD1" class="col-md-12"><b> Current Month Expenses </b></label>
                                <div id="singleexpense">
                                <div style="padding:30px;margin-top:20px;">
                                    <?php 
                                            $sum = 0;
                                        if(isset($Expenses) && $Expenses){

                                            foreach ($Expenses as $expense) {
                                                $sum += $expense->amount;
                                    ?>

                                        <div class="expense col-md-12">
                                            <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;<?php echo $expense->type; ?></label>
                                            <label class="amount" style="float:right;">$ <?php echo $expense->amount; ?></label>
                                        </div>

                                    <?php         
                                        }
                                    } ?>
                                    
                                    
                                </div>

                                <div class="total col-md-12" style="margin-top:90px; border-top:2px solid;">
                                        <label style="float:left;"><!-- <i class="fa fa-plus"></i> -->&nbsp;&nbsp;&nbsp;<b>Total</b></label>
                                        <label class="amount" style="float:right;"><b>$ <?php echo $sum; ?></b></label>
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




        <!-- Fund Transfer -->
        <div class="modal fade" id="fundtransfer" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content c-square">
                    <div class="modal-header " style="background-color:#ADC2EB">
                        <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 style="">Funds Transfer</h2>
                        
                    </div>
                    <div class="modal-body">
                        <form id="transferform">
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                    <div class="form-group">
                                    
                                        <label for="inputEmail3" class="col-md-3 control-label">Amount:</label>
                                    
                                        <div class="col-md-9">
                                            <input type="text" class="form-control c-square c-theme" name="amount" id="amount" placeholder="0" required="">
                                        </div>

                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group col-md-12 text-center">
                                    
                                <label for="inputEmail3" class="control-label" id="transferalert"></label>
                                    
                            </div>
                        </div>
                        <br>
                        <div class="row">
                               
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Transfer</button>
                                
                            </div>

                        </div>
                        <br>  
                        </form>  
                    </div>
                        
                        
                        
                    </div>
                </div>
            </div>






        <!-- style="background-color:grey;color:white" -->
        <div class="modal fade" id="addexpense" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content c-square">
                    <div class="modal-header " style="background-color:#ADC2EB">
                        <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 style="">Add Expense</h2>
                        
                    </div>
                    <div class="modal-body">
                        <form id="expenseform">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Type:</label>
                                   
                                    <div class="col-md-9">
                                        <select class="form-control c-square c-theme" name="type">
                                            <option>Expense Type</option>
                                            <option value="Tax">Tax</option>
                                            <option value="Salary">Salary</option>
                                            <option value="Bill">Bill</option>
                                            <option value="Rent">Rent</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                     <div class="form-group">
                                    
                                    <label for="inputEmail3" class="col-md-3 control-label">Amount:</label>
                                    
                                    <div class="col-md-9">
                                        <input type="text" class="form-control c-square c-theme" name="amount" id="amount" placeholder="0" required="">
                                    </div>

                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="form-group">
                                    
                                    <label for="inputEmail3" class="col-md-3 control-label">Date:</label>
                                    
                                    <div class="col-md-9">
                                        <input type="text" class="form-control c-square c-theme datepicker1" name="date" id="date" placeholder="mm/dd/yyyy" required="">
                                    </div>

                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="form-group col-md-12 text-center">
                                    
                                    <label for="inputEmail3" class="control-label" id="responsealert"></label>
                                    
                                    </div>
                                </div>
                                
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn  c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Save</button>
                                </div>
                            </div>
                            <br>
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
        $('.datepicker1').datepicker({
        format: 'mm/dd/yyyy'
    });


$(document).ready(function() {
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


    $('#tablestockin tr').on('click', function(e){
        //console.log(this);
        $('#vehicleinfo').modal('show');
    });

    //Model Closing
    $('#addVehicle').on('hidden.bs.modal', function () {
    // do something…
        $('#vInfo',this).show();
        $('#vImages',this).hide();
    });

    //Model Closing
    

    $('#editVehicle').on('click',function(e){
        $('#vehicleinfo').modal('hide');
        $('#addVehicle').modal('show');
    })

});
</script>
<script src="<?php echo base_url(); ?>assets/core/accounts.js"></script>
<script src="<?php echo base_url(); ?>assets/core/notification.js"></script>
</body>

</html>