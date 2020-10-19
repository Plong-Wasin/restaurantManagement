<?php include("../Session/Check_Session.php") ?>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../sidebar-05/css/style.css">
<div class="wrapper d-flex align-items-stretch">
	<nav id="sidebar">
		<div class="custom-menu">
			<button type="button" id="sidebarCollapse" class="btn btn-primary">
				<i class="fa fa-bars"></i>
				<span class="sr-only">Toggle Menu</span>
			</button>
		</div>
		<div class="p-4">
			<h1><a href="index.html" class="logo"><?php echo $_SESSION['username'] ?> <span><?php echo $_SESSION['role'] ?></span></a></h1>
			<ul class="list-unstyled components mb-5">
				<?php
				if ($_SESSION['role'] == 'admin') { ?>
					<li class="active">
						<a href="SidebarAdminScreenMain.php" class="w3-bar-item w3-button"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
					</li>
				<?php
				} else if ($_SESSION['role'] == 'WelcomeStaff') { ?>
					<li class="active">
						<a href="SidebarWelcomeScreenMain.php" class="w3-bar-item w3-button"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
					</li>
				<?php
				} else if ($_SESSION['role'] == 'ServiceStaff') { ?>
					<li class="active">
						<a href="SidebarServiceScreenMain.php" class="w3-bar-item w3-button"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
					</li>
				<?php
				} else if ($_SESSION['role'] == 'KitchenStaff') { ?>
					<li class="active">
						<a href="SidebarKitchenScreenMain.php" class="w3-bar-item w3-button"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
					</li>
				<?php
				} else if ($_SESSION['role'] == 'CashierStaff') { ?>
					<li class="active">
						<a href="SidebarCashierScreenMain.php" class="w3-bar-item w3-button"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
					</li>
				<?php
				}

				if ($_SESSION['role'] == 'admin') { ?>
					<li class="active">
						<a href="SidebarsaleResult.php" class="w3-bar-item w3-button"><span class="fa fa-bar-chart mr-3"></span>ประวัติการขาย</a>
					</li>
				<?php
				}

				if ($_SESSION['role'] == 'admin') { ?>
					<li class="active">
						<a href="SidebarStaffScreen.php" class="w3-bar-item w3-button"><span class="fa fa-user mr-3"></span>พนักงาน</a>
					</li>
				<?php
				}

				if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'WelcomeStaff') { ?>
					<li class="active">
						<a href="SidebarmanageQueue.php" class="w3-bar-item w3-button"><span class="fa fa-ticket mr-3"></span>จัดการจองคิว</a>
					</li>
				<?php
				}

				if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'KitchenStaff') { ?>
					<li class="active">
						<a href="SidebarmanageFood.php" class="w3-bar-item w3-button"><span class="fa fa-cog"></span><span class="fa fa-cutlery mr-1"></span>จัดเมนูอาหาร</a>
					</li>
				<?php
				}

				if ($_SESSION['role'] == 'admin') { ?>
					<li class="active">
						<a href="SidebarmanageTable.php" class="w3-bar-item w3-button"><span class="fa fa-table mr-3"></span>จัดการโต๊ะ</a>
					</li>
				<?php
				}

				if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'ServiceStaff') { ?>
					<li class="active">
						<a href="SidebarorderStaffSceen.php" class="w3-bar-item w3-button"><span class="fa fa-cutlery mr-3"></span>สั่งอาหาร</a>
					</li>
				<?php
				}

				if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'KitchenStaff') { ?>
					<li class="active">
						<a href="SidebarKitchenScreen.php" class="w3-bar-item w3-button"><span class="fa fa-free-code-camp mr-3"></span>ห้องครัว</a>
					</li>
				<?php
				}

				if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'ServiceStaff') { ?>
					<li class="active">
						<a href="SidebarServiceScreen.php" class="w3-bar-item w3-button"><span class="fa fa-male mr-3"></span>บริการ</a>
					</li>
				<?php
				}

				if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'CashierStaff') { ?>
					<li class="active">
						<a href="SidebarCashierScreen.php" class="w3-bar-item w3-button"><span class="fa fa-database mr-3"></span>คิดเงิน</a>
					</li>
				<?php
				}
				?>
				<li class="active">
					<a href="../Session/Log_out.php" class="w3-bar-item w3-button"><span class="fa fa-sign-out mr-3"></span>ออกจากระบบ</a>
				</li>
			</ul>

			<div class="mb-5">
				<h3 class="h6 mb-3">Subscribe for newsletter</h3>
				<form action="#" class="subscribe-form">
					<div class="form-group d-flex">
						<div class="icon"><span class="icon-paper-plane"></span></div>
						<input type="text" class="form-control" placeholder="Enter Email Address">
					</div>
				</form>
			</div>

			<div class="footer">
				<p>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>

		</div>
	</nav>

	<!-- Page Content  -->
	<div id="content">
		<iframe src="../Service/ServiceScreen.php" frameborder="0" style="width: 100% ;height:100%;"></iframe>
	</div>
</div>

<script src="../sidebar-05/js/jquery.min.js"></script>
<script src="../sidebar-05/js/popper.js"></script>
<script src="../sidebar-05/js/bootstrap.min.js"></script>
<script src="../sidebar-05/js/main.js"></script>
</body>

</html>