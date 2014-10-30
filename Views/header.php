<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>WA Home page</title>
        <meta name="description" content="" />
        <meta name="author" content="TrongLoi" />

        <meta name="viewport" content="width=device-width; initial-scale=1.0" />

        <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <link rel="shortcut icon" href="" />
        <link rel="apple-touch-icon" href="../img/ico/Cat-Brown-icon-72px.png" />

        <!-- Chèn link CSS -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" href="<?php echo ASSETS ?>plugins/bootstrap/css/bootstrap.min.css" type="text/css"  />

        <link rel="stylesheet" href="<?php echo ASSETS ?>plugins/font-awesome/css/font-awesome.min.css" type="text/css"  />
        
        <link rel="stylesheet" href="<?php echo ASSETS ?>plugins/wysibb/theme/default/wbbtheme.css" type="text/css"  />
        
        <link rel="stylesheet" href="<?php echo ASSETS ?>plugins/bootstrap-datepicker/css/datepicker.css" type="text/css"  />

        <link rel="stylesheet" href="<?php echo ASSETS ?>css/home-page/home-page.css" type="text/css"  />


        <!-- CSS STYLE-->
        <link rel="stylesheet" type="text/css" href="<?php echo ASSETS ?>plugins/rs-plugin/css/style.css" media="screen" />

        <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
        <link rel="stylesheet" type="text/css" href="<?php echo ASSETS ?>plugins/rs-plugin/css/settings.css" media="screen" />


        <?php
            if(isset($this->style)){
                foreach ($this->style as $style) {
                    echo '<link rel="stylesheet" type="text/css" href="'. $style .'" />';
                }
            }
        ?>
    </head>

    <body id="home-page">
        <header id="header" class="container">
            <div id="top-header" class="clearfix">
                <div id="top-header-left" class="col-md-3">
                    <button onclick="clearCreatePlaceModal()" class="btn create-location-btn" data-toggle="modal" data-target="#create_place_modal" type="button"><i class="fa fa-plus"></i> Tạo địa điểm</button>
                </div>
                <div id="top-header-center" class="col-md-6">
                    <div class="logo" align="center">
                        <!-- <h1 class="logo-text text-center"><a href="<?php echo URL; ?>">COMPANY NAME</a></h1> -->
                        <a href="<?php echo URL; ?>">
                            <img class="image-responsive logo-image" src="<?php echo ASSETS?>img/Beleza_logo_Final.png" />
                        </a>
                    </div>
                </div>         
                <div id="top-header-right" class="col-md-3">
                    <div class="clearfix" id="login_group">
                    	<?php
		                Session::init(); 
		                if(empty($_SESSION['client_id'])){ 
		                ?>
	                        <div class="col-sm-5 remove-padding">
	                        	<button id="login_btn" onclick="setTimeIdle()" class="btn btn-block login-btn" data-toggle="modal" data-target="#login_modal" type="button">Đăng nhập</button>
	                        </div>
	                        <div class="col-sm-2"></div>
	                        <div class="col-sm-5 remove-padding">
	                            <button class="btn btn-block login-face-btn" type="button" onclick="loginFB()">
                                    <i class="fa fa-facebook"></i> | 
                                    Login Face
                                </button>
                                <!-- <img class='login-face-btn' src="<?php echo ASSETS; ?>img/fbloginbtn.png" onclick="loginFB()"/> -->
	                        </div>
                        <?php }else{ ?>
                        	<div class="col-sm-12 remove-padding" style="margin-bottom: 10px;">
								<div class="dropdown"> 
                        			<a id="dropdown_profile" data-toggle="dropdown" class="btn btn-orange-black btn-block dropdown-toggle"> 
                        				Xin chào: <i class="fa fa-user"></i> <?php echo $_SESSION['client_username']; ?> <span class="caret"></span>
                        			</a>
                        			<ul style="border-radius: 0px;" class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdown_profile">
									    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo URL . 'clientsetting'; ?>"><i class="fa fa-wrench"></i> Quản lý tài khoản</a></li>
									    <li role="presentation" class="divider"></li>
									    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="logout()" style="cursor: pointer;"><i class="fa fa-power-off"></i> Thoát</a></li>
									</ul>
								</div>                  		                        			
                        	</div>
                    	<?php } ?>
                    </div>
                    <div class="col-md-12 remove-padding clearfix">
                    	<i class="fa fa-search" style="position: absolute; z-index: 1000;top: 30%;left: 10px;color: #777;"></i>
                        <input style="position: relative;padding-left: 30px" type="text" class="form-control search-global empty" placeHolder="Gõ nội dung cần tìm...">
                    </div>
                </div>                
            </div><!-- END TOP HEADER -->
            <div id="navigation" class="clearfix">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <!-- <a class="navbar-brand" href="#">Brand</a> -->
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-left" style="font-weight: 600;">
                                <li class="first "><a href="#">&#149; FACE</a></li>
                                <li><a href="#">&#149; BODY</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">&#149; TÓC <span class="caret"></span></a>
                                    <div class="dropdown-menu clearfix dropdown-menu-hair-background" role="menu">
                                        <span class="caret"></span>
                                        <ul class="list-unstyled pull-left">
                                            <li class="group-name"><i class="fa fa-user"></i> <span>GỘI</span></li>
                                            <li><a href="#">Gội sấy</a></li>
                                            <li><a href="#">Gội sấy tạo kiểu</a></li>
                                            <li class="divider"></li>

                                            <li class="group-name"><i class="fa fa-user"></i> <span>SẤY</span></li>
                                            <li><a href="#">One more</a></li>
                                            <li class="divider"></li>

                                            <li class="group-name"><i class="fa fa-user"></i> <span>GỘI</span></li>
                                            <li><a href="#">One more</a></li>
                                        </ul>
                                        <ul class="list-unstyled pull-left" tyle="padding-left: 10px; padding-right:10px">
                                            <li class="group-name"><i class="fa fa-user"></i> <span>GỘI</span></li>
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li class="divider"></li>

                                            <li class="group-name"><i class="fa fa-user"></i> <span>GỘI</span></li>
                                            <li><a href="#">One more</a></li>
                                            <li class="divider"></li>
                                            
                                            <li class="group-name"><i class="fa fa-user"></i> <span>GỘI</span></li>
                                            <li><a href="#">One more</a></li>
                                        </ul>
                                    </div>
                                    
                                </li>
                                <li><a href="#">&#149; MÓNG</a></li>
                                <li><a href="#">&#149; MASSAGE</a></li>
                                <li><a href="#">&#149; FITNESS</a></li>
                            </ul>

                            <div class="navbar-form navbar-right">
                            	<i id="waiting_cart_detail" class="fa fa-refresh fa-spin" style="display: none;"></i>
                                <button style="padding: 0 4px;" onclick="shoppingCartDetail()" type="submit" class="btn btn-sm btn-default btn-cart-shop">    
                                    <!-- <i class="fa fa-lg fa-shopping-cart text-orange"></i> -->
                                    <img height="16" class="image-reponsive" src="<?php echo ASSETS?>img/cart-shop.png" /> 
                                	<span style="font-size: 13px; width: 62px;" class="fa fa-stack">
                                		<i class="fa-stack-2x"></i>
                                		<span class="fa-stack-1x">GIỎ HÀNG </span>
                                	</span>

                                	<span id="booking_amount" class="fa fa-stack">
                                		<i class="fa fa-circle fa-stack-2x text-orange"></i>
                                		<b class="fa-stack-1x text-white" style="font-size: 11px;">
	                                		<?php Session::init(); 
												$eVoucher_count = 0;
												$booking_count = 0;
												if(isset($_SESSION['booking_detail'])){
													$booking_count = count($_SESSION['booking_detail']);
												}
												if(isset($_SESSION['eVoucher_detail'])){
													$eVoucher_count = count($_SESSION['eVoucher_detail']);
												}
	                                			echo $booking_count + $eVoucher_count;
	                                		?>
                                		</b>
                                	</span>
                                </button>
                                <img class="image-reponsive btn-languages" src="<?php echo ASSETS?>img/flag-vi.png" /> 
                                <img class="image-reponsive btn-languages " src="<?php echo ASSETS?>img/flag-en.png" /> 
                                
                                <!-- <button type="submit" class="btn btn-sm btn-default btn-languages">VI</button>
                                <button type="submit" class="btn btn-sm btn-default btn-languages">EN</button> -->
                            </div>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div> <!-- END NAVIGATION -->
			<div id="create_place_modal" style="z-index: 1051;" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-max-height="440">
				<div class="modal-dialog">
					<div class="modal-content" style="border-radius: 0px;">
						<div class="modal-header" style="background-color: #FDBD0E; padding: 6px 10px;">
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<h5 class="modal-title" id="myModalLabel" style="text-align:center; font-weight:bold;">GỬI YÊU CẦU TẠO ĐỊA ĐIỂM</h5>
						</div>
						<div class="modal-body" style="padding: 30px 20px 0px;">
							<form class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-sm-3">Họ tên</label>
									<div class="col-sm-8">
										<input autocomplete="off" class="form-control" type="text" id="create_place_name" name="create_place_name" placeholder="Nhập họ tên..." />
										<small style="color: red;"></small>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Email</label>
									<div class="col-sm-8">
										<input autocomplete="off" class="form-control" type="text" id="create_place_email" name="create_place_email" placeholder="Nhập email...VD:abc@example.com" />
										<small style="color: red;"></small>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">SĐT</label>
									<div class="col-sm-8">
										<input onkeypress="inputNumbers(event)" autocomplete="off" class="form-control" type="text" id="create_place_phone" name="create_place_phone" placeholder="Nhập SĐT..." />
										<small style="color: red;"></small>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Địa chỉ</label>
									<div class="col-sm-8">
										<input autocomplete="off" class="form-control" type="text" id="create_place_address" name="create_place_address" placeholder="Địa chỉ..." />
										<small style="color: red;"></small>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Tên công ty</label>
									<div class="col-sm-8">
										<input autocomplete="off" class="form-control" type="text" id="create_place_com_name" name="create_place_com_name" placeholder="Nhập tên công ty bạn muốn đặt..." />
										<small style="color: red;"></small>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer" id="create_place_footer" style="padding: 15px 20px 15px;">
							<small style="display: none;color: red;" id="error_message_create_place"><i>Email không hợp lệ </i></small>
							<button type="button" id="create_place_btn" onclick="sendCreatePlaceMail()" class="btn btn-sm btn-orange-black">
								<i style="display: none" id="waiting_for_create_place" class="fa fa-refresh fa-spin"></i> Gửi mail
							</button>
							<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
								Hủy
							</button>
						</div>
					</div>
				</div>
			</div>
        </header>