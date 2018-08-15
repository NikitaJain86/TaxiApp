
<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html><!--<![endif]-->

    <!-- Specific Page Data -->

    <!-- End of Data -->

    <head>
        <meta charset="utf-8" />
        <title>Taxiapp</title>
        <meta name="keywords" content="HTML5 Template, CSS3, All Purpose Admin Template, " />
        <meta name="description" content="Responsive Admin Template for multipurpose use">
        <meta name="author" content="Venmond">

        <!-- Set the viewport width to device width for mobile -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    


        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->config->base_url() ?>img/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->config->base_url() ?>img/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->config->base_url() ?>img/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo $this->config->base_url() ?>img/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo $this->config->base_url() ?>img/ico/favicon.png">


        <!-- CSS -->

        <!-- Bootstrap & FontAwesome & Entypo CSS -->
        <link href="<?php echo $this->config->base_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->config->base_url() ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!--[if IE 7]><link type="text/css" rel="stylesheet" href="css/font-awesome-ie7.min.css"><![endif]-->
        <link href="<?php echo $this->config->base_url() ?>css/font-entypo.css" rel="stylesheet" type="text/css">    

        <!-- Fonts CSS -->
        <link href="<?php echo $this->config->base_url() ?>css/fonts.css"  rel="stylesheet" type="text/css">

        <!-- Plugin CSS -->
        <link href="<?php echo $this->config->base_url() ?>plugins/jquery-ui/jquery-ui.custom.min.css" rel="stylesheet" type="text/css">    
        <link href="<?php echo $this->config->base_url() ?>plugins/prettyPhoto-plugin/css/prettyPhoto.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->config->base_url() ?>plugins/isotope/css/isotope.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->config->base_url() ?>plugins/pnotify/css/jquery.pnotify.css" media="screen" rel="stylesheet" type="text/css">    
        <link href="<?php echo $this->config->base_url() ?>plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"> 

        <link href="<?php echo $this->config->base_url() ?>plugins/mCustomScrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->config->base_url() ?>plugins/tagsInput/jquery.tagsinput.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->config->base_url() ?>plugins/bootstrap-switch/bootstrap-switch.css" rel="stylesheet" type="text/css">    
        <link href="<?php echo $this->config->base_url() ?>plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">    
        <link href="<?php echo $this->config->base_url() ?>plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->config->base_url() ?>plugins/colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css">  

        <!-- Theme CSS -->
        <link href="<?php echo $this->config->base_url() ?>css/theme.min.css" rel="stylesheet" type="text/css">
        <!--[if IE]> <link href="css/ie.css" rel="stylesheet" > <![endif]-->
        <link href="<?php echo $this->config->base_url() ?>css/chrome.css" rel="stylesheet" type="text/chrome"> <!-- chrome only css -->    



        <!-- Responsive CSS -->
        <link href="<?php echo $this->config->base_url() ?>css/theme-responsive.min.css" rel="stylesheet" type="text/css"> 


        <link href="<?php echo $this->config->base_url() ?>custom/custom.css" rel="stylesheet" type="text/css">


        <!-- Head SCRIPTS -->
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>js/modernizr.js"></script> 
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>js/mobile-detect.min.js"></script> 
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>js/mobile-detect-modernizr.js"></script> 
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>js/jquery.js"></script> 
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>plugins/dataTables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>js/dataTables.editor.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>plugins/dataTables/dataTables.bootstrap.js"></script>

        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>js/bootstrap.min.js"></script> 

        <script type="text/javascript" src='<?php echo $this->config->base_url() ?>plugins/jquery-ui/jquery-ui.custom.min.js'></script>
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>js/caroufredsel.js"></script> 
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>js/plugins.js"></script>

        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>plugins/breakpoints/breakpoints.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>plugins/dataTables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>plugins/prettyPhoto-plugin/js/jquery.prettyPhoto.js"></script> 

        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>plugins/tagsInput/jquery.tagsinput.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>plugins/blockUI/jquery.blockUI.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>plugins/pnotify/js/jquery.pnotify.min.js"></script>

        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>js/theme.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->base_url() ?>custom/custom.js"></script>



    </head>    

    <body id="dashboard" class="full-layout  nav-right-hide nav-right-start-hide  nav-top-fixed      responsive    clearfix" data-active="dashboard "  data-smooth-scrolling="1">     
        <div  class="vd_body">
            <!-- Header Start -->
            <header class="header-1" id="header">
                <div class="vd_top-menu-wrapper">
                    <div class="container ">
                        <div class="vd_top-nav vd_nav-width  ">
                            <div class="vd_panel-header">
                                <div class="logo">
                                    <a href="#"><h3><b style="color:#F9C30B" >Taxi App</b></h3></a>
                                </div>

                                <div class="vd_panel-menu left-pos visible-sm visible-xs">

                                    <span class="menu" data-action="toggle-navbar-left">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </span>  


                                </div>

                            </div>
                            <!-- vd_panel-header -->

                        </div>   

                        <div class="vd_container">


                            <div class="col-sm-7 col-xs-12" style="float: right">
                                <div class="vd_mega-menu-wrapper">
<!--                                    <div class="vd_mega-menu pull-right">
                                        <ul class="mega-ul">
                                            <li class="profile mega-li" id="top-menu-profile"> 
                                                <a data-action="click-trigger" class="mega-link" href="#"> 
                                                    <span class="mega-image">
                                                        <i class="fa fa-caret-down fa-fw"></i> 
                                                    </span>
                                                </a> 
                                                <div data-action="click-target" class="vd_mega-menu-content  width-xs-2  left-xs left-sm" style="display: none;">
                                                    <div class="child-menu"> 
                                                        <div class="content-list content-menu">
                                                            <ul class="list-wrapper pd-lr-10">

                                                                <li> <a href="<?php //echo $this->config->base_url() ?>admin/logout"> <div class="menu-icon"><i class=" fa fa-sign-out"></i></div>  <div class="menu-text">Sign Out</div> </a> </li>

                                                            </ul>
                                                        </div> 
                                                    </div> 
                                                </div>     

                                            </li>               


                                        </ul>
                                         Head menu search form ends                          
                                    </div>-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- container --> 

            </header>

            <!-- Header Ends -->