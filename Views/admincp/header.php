<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>WA Connect</title>
        <meta name="description" content="" />
        <meta name="author" content="TrongLoi" />

        <meta name="viewport" content="width=device-width; initial-scale=1.0" />

        <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <link rel="shortcut icon" href="" />
        <link rel="apple-touch-icon" href="../img/ico/Cat-Brown-icon-72px.png" />

        <!-- Chèn link CSS -->
        <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/> -->
        <style type="text/css">
            /** {
                font-family: "Open Sans";
            }*/
        </style>
        <link rel="stylesheet" href="<?php echo ASSETS ?>plugins/bootstrap/css/bootstrap.min.css" type="text/css"  />

        <link rel="stylesheet" href="<?php echo ASSETS ?>plugins/font-awesome/css/font-awesome.min.css" type="text/css"  />

        <link rel="stylesheet" href="<?php echo ASSETS ?>css/spaCMS/spaCMS.css" type="text/css"  />

        <!-- <link rel="stylesheet" href="<?php echo URL ?>public/assets/css/spaCMS/tooltip.css" type="text/css"  /> -->

        <?php
            if(isset($this->style)){
                foreach ($this->style as $style) {
                    echo '<link rel="stylesheet" type="text/css" href="'. $style .'" />';
                }
            }
        ?>
    </head>

    <body id="dashboard-module">
        <!-------------------------------------------------- Navbar -------------------------------------------------->
        <div class="clearfix" id="header">
            <div id="venues">
                <div class="current">
                    <div class="icons-arrow-bottom"></div>
                    <div class="name" style="position: absolute; height: 15px; top: 50%; margin-top: -7.5px;">
                        <i class="fa fa-spin fa-cog"></i> Admin Control Panel
                    </div>
                </div>
                <ul class="hidden"></ul>
            </div>
            <ul id="nav1">
                <li id="nav-home">
                    <a title="Home" href="./admincp_dashboard"> <div class="icons-nav-home"></div>
                    <div class="title">
                        Dashboard
                    </div> </a>
                </li>
                <li id="nav-calendar">
                    <a title="Calendar" href="./admincp_page"> <div class="icons-nav-calendar"></div>
                    <div class="title">
                        Nội dung page
                    </div> </a>
                </li>
                <li id="nav-menu">
                    <a title="Menu" href="./admincp_spa"> <div class="icons-nav-menu"></div>
                    <div class="title">
                        DS Spa
                    </div> </a>
                </li>
                <li id="nav-reports">
                    <a title="Reports" href="./admincp_report"> <div class="icons-nav-reports"></div>
                    <div class="title">
                        Báo cáo
                    </div> </a>
                </li>
                <li id="nav-settings">
                    <a title="Settings" href="./admincp_setting"> <div class="icons-nav-settings"></div>
                    <div class="title">
                        Cài đặt
                    </div> </a>
                </li>
            </ul>
            <div class="ddown-menu" id="user">
                <div class="user-wrapper">
                    <a class="current" href="javascript:;" data-toggle="dropdown">
                    <div class="person-pic-small">
                    </div> <div class="icons-arrow-bottom"></div>
                    <div class="name">
                        <div>
                            <?php
                                echo Session::get('admin_username');
                            ?>
                        </div>
                    </div> </a>
                    <ul id="logout" class="ddown" role="menu" style="display:none;">
                        <li>
                            <a href="<?php echo URL . 'admincp/logout' ?>"> <div class="icons-logout"></div> Thoát </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>