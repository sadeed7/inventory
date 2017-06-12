<!DOCTYPE html>

<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="utf-8" />
        <title>Inventory</title>
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
    var baseurl = "<?php echo base_url(); ?>";
    var service = 0;
    var vehicle_id = undefined;

    //Delete Image
    function deleteimg (v, im, i) {
        if(confirm('Do You Want To Delete Image?')){
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/Inventory/deleteimage',
                type: 'POST',
                data: {
                    image: im,
                    vehicle: v
                },
                success: function(data){
                    data = JSON.parse(data);
                    if(data.status === 'success'){
                        //success message

                        $('#editimage'+i).remove();
                    }else if(data.status === 'error'){
                        console.log(data.msg);
                    }
                },
                error: function(error){
                    console.log(error);
                }
            });
        }else{

        }
    }


    //Deleting Service
    function removeService (service) {

        var action = $('#addvehiclebtn').val();
        if(action === 'edit'){
            
            if($(`#serviceid${service}`).length){
                //IF ID Exist
                //Deleting Service
                if(confirm('Do You Want To Delete This Service?')){
                    serviceid = $(`#serviceid${service}`).val();
                    $.ajax({
                        url: '<?php echo base_url(); ?>index.php/Inventory/deleteservice',
                        type: 'POST',
                        data: {id:serviceid},
                        success: function(data){
                            data = JSON.parse(data);
                            if(data.status === 'success'){
                                alert('Service Successfully Deleted');
                                $(`#service${service}`).remove();
                                $(`#clearfix${service}`).remove();
                                $(`#br${service}`).remove();
                                service--; 
                            }else if(data.status === 'error'){
                                $('#verificationError').html(data.msg);
                                $('#verificationError').show();
                            }   
                        },
                        error: function(error){
                            console.log(error);
                        }
                    }) 
                }else{

                } 
            }else{
                //IF ID Not Exist
                $(`#service${service}`).remove();
                $(`#clearfix${service}`).remove();
                $(`#br${service}`).remove();
                service--; 
            }
            
        }else{
            $(`#service${service}`).remove();
            $(`#clearfix${service}`).remove();
            $(`#br${service}`).remove();
            service--;
        }

    }
    function addService (btn) {
        // body...
        /*e.preventDefault();*/
      
        
        var html = `<div class="form-group services" id="service${service}">                            
                    
                    <div class="col-md-3">
                        <input type="text" class="form-control c-square c-theme" name="servicename[]" id="servicename${service}" placeholder="Service Name" required>
                    </div>                
                    <div class="col-md-8">
                        <input type="text" class="form-control c-square c-theme" name="serviceprice[]" id="serviceprice${service}" placeholder="Price" required>
                    </div>
                    <a href="javascript:;" class="col-md-1" onclick="removeService(${service})" ><i class="fa fa-times" title="Remove Service"></i></a>
                </div>
                <div class="clearfix" id="clearfix${service}"></div>
                <br id="br${service}">`;
        $('#service').append(html);
        service++;
    }
</script>
 <!-- Fine Uploader Thumbnails template w/ customization
    ====================================================================== -->
    <script type="text/template" id="qq-template-manual-trigger">
        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="buttons">
                <div class="qq-upload-button-selector qq-upload-button">
                    <div>Select files</div>
                </div>
                <button type="button" id="trigger-upload" class="btn btn-primary">
                    <i class="icon-upload icon-white"></i> Upload
                </button>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="qq-upload-file-selector qq-upload-file"></span>
                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                    <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Close</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Yes</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
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
        #tablestockin :hover{
            cursor: pointer;
        }
        </style>
        <script type="text/javascript">
            function filter() {
                var filter = $('#filter');
                var data = filter.children();
                var nameFilterData = {};
                var yearFilterData = {};
                var gradingFilterData = {};
                $.each(data,function(id,data){
                    var name = $('.name', data).text();
                    var year = $('.year', data).text();
                    var grade = $('.grading', data).text();
                    nameFilterData[name] = data;
                    yearFilterData[year] = data;
                    gradingFilterData[grade] = data;

                });
            }

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
                                <li class="c-onepage-link c-active active">
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
                        <h2 style="">Export Vehicles</h2>
                        
                    </div>
                    <div class="modal-body">
                        <div id="">
                        <form id="multiexport_form">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-2 control-label">Vehicles:</label>
                                <div class="col-sm-1"></div>
                                <div class="col-md-9">
                                    <select class="form-control c-square c-theme" id="vehicles">
                                        <option value="1" id="0">Chassis 1</option>
                                        <option value="2" id="1">Chassis 2</option>
                                        <option value="3" id="2">Chassis 3</option>
                                        <option value="4" id="3">Chassis 4</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-2 control-label">Selected Vehicles:</label>
                                <div class="col-sm-1"></div>
                                <div class="col-md-9" style="height: 300px;border: 1px solid;overflow-y: scroll;">
                                     <ul id="selectedvehicles">
                                        
                                     </ul>
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
                            <br>
                            <div class="form-group text-center" id="exportVerificationError" style="color:red;font-weight:bold;">
                                
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
                        <div id="" style="display:none">
                            
                            <div class="form-group">
                                <div id=""></div>
                            </div>
                            <div class="row" id="">
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Multiple Export FORM -->






       <!-- BEGIN: CONTENT/USER/LOGIN-FORM -->
        <div class="modal fade " id="addVehicle" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content c-square">
                    <div class="modal-header" style="background-color:#ADC2EB;">
                        <button type="button" style="float:right; " class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 style="">ADD VEHICLE</h2>
                        
                    </div>
                    <div class="modal-body">
                        <div id="vInfo">
                        <form id="vehicle_form">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-2 control-label">Name:</label>
                                <div class="col-sm-1"></div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control c-square c-theme" name="name" id="name" placeholder="Vehicle Name" required=""> 
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-2 control-label">Chassis:</label>
                                <div class="col-sm-1"></div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control c-square c-theme" name="chassis" id="chassis" placeholder="Chassis Number" required=""> 
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-2 control-label">Make:</label>
                                <div class="col-sm-1"></div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control c-square c-theme" name="make" id="make" placeholder="SUZUKI, TOYOTA" required=""> 
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-2 control-label">Model:</label>
                                <div class="col-sm-1"></div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control c-square c-theme" name="model" id="model" placeholder="CARRY, SKYLINE" required=""> 
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-2 control-label">Year:</label>
                                <div class="col-sm-1"></div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control c-square c-theme" name="year" id="year" placeholder="1990" required=""> 
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-2 control-label">Stars:</label>
                                <div class="col-sm-1"></div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control c-square c-theme" name="stars" id="stars" placeholder="Vehicle Stars Out Of 5" required=""> 
                                </div>
                            </div>

                            <div class="clearfix" ></div>
                            <br>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-2 control-label">Price:</label>
                                <div class="col-sm-1"></div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control c-square c-theme" name="price" id="price" placeholder="$Price" required=""> 
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div id="service">
                                   
                            </div>

                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group text-center" id="verificationError" style="color:red;font-weight:bold;">
                                
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <a href="javascript:;" class="col-md-4 addservice" onclick="addService(this)"><i class="icon-plus" title="Add Services"></i>&nbsp;Other Services</a>
                                
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
                        <div id="vImages" style="display:none">
                            
                            <div class="form-group">
                                <div id="fine-uploader-manual-trigger"></div>
                            </div>
                            <div class="row" id="imagesedit">
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: CONTENT/USER/LOGIN-FORM -->
        <!-- BEGIN: PAGE CONTAINER -->
        <div  class="c-layout-page" >
            <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
            <div class="c-layout-breadcrumbs-1 c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
                <div class="container" >

                    <div class="c-page-title c-pull-left">
                        <h3 class="c-font-uppercase c-font-bold">Inventory</h3>
                       <!--  <h4 class="">Inventory In And Out</h4> -->
                    </div>
                    <ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
                        <li>
                            <a href="">Admin</a>
                        </li>
                        <li>/</li>
                        <li class="c-state_active">Inventory</li>
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
                            <button class="btn btn-primary" style="float:right" data-toggle="modal" data-target="#addVehicle">Add Inventory</button>
                            <!-- <button class="btn btn-primary" style="float:right;margin-right:5px;" data-toggle="modal" data-target="#multipleexport">Multiple Export</button> -->
                            
                            <?php
                                }
                            ?>
                            <h1><b>Stock In</b></h1>
                            <hr>
                            <?php
                                if (isset($inventory) && $inventory) {
                                    $i = 0;
                                    foreach ($inventory as $invent) {
                                        $vehicles = $invent['vehicles'];
                            ?>

                                        <div class="col-md-12 col-sm-12" style="border: 1px solid;margin-bottom: 40px;">
                                <div class="row" style="border-bottom:1px solid; background-color: #ADC2EB;">
                                    <a href="javascript:;" style="float: right;margin-right: 10px;font-size: 20px;"><i class="fa fa-arrow-up" onclick="
                                    var classlist = $(this).attr('class').split(' ');
                                    if(classlist[1]==='fa-arrow-up'){
                                            $('#inventory<?php echo $i; ?>').hide();
                                            $(this).removeClass('fa-arrow-up');
                                            $(this).addClass('fa-arrow-down');
                                    }else if(classlist[1]==='fa-arrow-down'){
                                            $('#inventory<?php echo $i; ?>').show();
                                            $(this).removeClass('fa-arrow-down');
                                            $(this).addClass('fa-arrow-up');
                                            }"></i></a>
                                    <h3 style="margin-left: 10px; font-weight: bold;"><?php echo $invent['station']; ?></h3>

                                </div>
                                <div class="row fade in active" style="margin: 5px;" id="inventory<?php echo $i; ?>">
                                    
                                    <table  cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered" id="datatable1">
                                        <thead>
                                            <tr>
                                                <th>Sr #</th>
                                                <th>Vehicle Name</th>
                                                <th>Chassis Number</th>
                                                <th>Current Location</th>
                                                <th>Status</th>
                                                <!-- <th>Days In Stock</th> -->
       
                                            </tr>
                                        </thead>
                                        <tbody id="tablestockin" class="tablestockin">
      
                                        <?php 
                                            if(isset($vehicles) && $vehicles){ 
                                                $index = 1;
                                                foreach ($vehicles as $vehicle) {

                  
                                            ?>
                                                    <tr  class="odd gradeX" id="vehicle<?php echo $vehicle->id; ?>">

                                                        <td class="hidden-480">
                                                            <span class="sr"><?php echo $index; ?></span>
                                                            <input type="hidden" class="id" value= "<?php echo $vehicle->id; ?>">
                                                        </td>
                                                        <td class="hidden-480 token"><?php echo $vehicle->name; ?></td>
                                                        <td class="hidden-480"><?php echo $vehicle->chassis; ?></td>
                                                        <td class="hidden-480 location"><?php echo $vehicle->location; ?></td>
                                                        <td class="hidden-480 location st"><?php echo $vehicle->status; ?></td>
                                                        <!-- <td class="hidden-480 date"><?php echo $vehicle->days; ?> Days</td>  -->
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

                            <?php            
                                    $i++;
                                    }
                                }
                            ?>
                                     
                           
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
                                
                                
                                <label>Status: <span class="alert-success" id="status">Status</span></label>
                                <div id="time">
                                    
                                </div>
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

        $(function () {
        var isIE = window.ActiveXObject || "ActiveXObject" in window;
        if (isIE) {
            $('.modal').removeClass('fade');
        }
        
    });
   $(document).ready(function() {
    
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

var manualUploader = new qq.FineUploader({
            element: document.getElementById('fine-uploader-manual-trigger'),
            template: 'qq-template-manual-trigger',
            request: {
                endpoint: '<?php echo base_url(); ?>index.php/Inventory/upload',
                params: {'id':vehicle_id}
            },

            thumbnails: {
                placeholders: {
                    waitingPath: '<?php echo base_url(); ?>assets/plugins/fine-uploader/placeholders/waiting-generic.png',
                    notAvailablePath: '<?php echo base_url(); ?>assets/plugins/fine-uploader/placeholders/not_available-generic.png'
                }
            },
            validation: {
                allowedExtensions: ['jpeg', 'jpg', 'png'],
                itemLimit: 40,
            },
            callbacks:{
                onComplete: function(id, name, responseJSON){
                    console.log(responseJSON);
                    if(responseJSON.success == true){
                        $('#error').hide();
                        $('#success').show();

                    }else{
                        $('#success').hide();
                        $('#error').show();
                    }
                }
            },
            autoUpload: false,
            debug: true
        });

        qq(document.getElementById("trigger-upload")).attach("click", function() {
            manualUploader.uploadStoredFiles();
        });


</script>
<script src="<?php echo base_url(); ?>assets/core/vehicle.js"></script>
<script src="<?php echo base_url(); ?>assets/core/notification.js"></script>
<script src="<?php echo base_url(); ?>assets/core/multiple.js"></script>
</body>

</html>