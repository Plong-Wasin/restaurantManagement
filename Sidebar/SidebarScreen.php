<?php include("../Session/Check_Session.php") ?>
<!doctype html>
<html lang="th">

<head>
	<title>ระบบจัดการร้านอาหาร</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/style.css">
</head>

<bodys>
	<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar">
			<div class="custom-menu">
				<button type="button" id="sidebarCollapse" class="btn btn-primary">
					<i class="fa fa-bars"></i>
					<span class="sr-only">Toggle Menu</span>
				</button>
			</div>
			<div class="p-4">
				<h1><a class="logo"><?php echo $_SESSION['username'] ?> <span><?php echo $_SESSION['role'] ?></span></a></h1>
				<ul class="list-unstyled components mb-5">
					<?php
					if ($_SESSION['role'] == 'admin') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../Admin/AdminScreenMain.php';document.getElementById('demo').innerHTML = 'หน้าหลัก';">
							<a style=" cursor: pointer;"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
						</li>
					<?php
					} else if ($_SESSION['role'] == 'WelcomeStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../WelcomeScreen/WelcomeScreenMain.php';document.getElementById('demo').innerHTML = 'หน้าหลัก';">
							<a style="cursor: pointer;"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
						</li>
					<?php
					} else if ($_SESSION['role'] == 'ServiceStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../ServiceScreen/ServiceScreenMain.php';document.getElementById('demo').innerHTML = 'หน้าหลัก';">
							<a style="cursor: pointer;"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
						</li>
					<?php
					} else if ($_SESSION['role'] == 'KitchenStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../KitchenScreen/KitchenScreenMain.php';document.getElementById('demo').innerHTML = 'หน้าหลัก';">
							<a style="cursor: pointer;"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
						</li>
					<?php
					} else if ($_SESSION['role'] == 'CashierStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../CashierScreen/CashierScreenMain.php';document.getElementById('demo').innerHTML = 'หน้าหลัก';">
							<a style="cursor: pointer;"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
						</li>
					<?php
					}

					if ($_SESSION['role'] == 'admin') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../dashboard/saleResult.php';document.getElementById('demo').innerHTML = 'ประวัติการขาย';">
							<a style="cursor: pointer;"><span class="fa fa-bar-chart mr-3"></span>ประวัติการขาย</a>
						</li>
					<?php
					}

					if ($_SESSION['role'] == 'admin') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../Staff/StaffScreen.php';document.getElementById('demo').innerHTML = 'ข้อมูลพนักงาน';">
							<a style="cursor: pointer;"><span class="fa fa-user mr-3"></span>พนักงาน</a>
						</li>
					<?php
					}

					if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'WelcomeStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../queue/manageQueue.php';document.getElementById('demo').innerHTML = 'จัดการจองคิว';">
							<a style="cursor: pointer;"><span class="fa fa-ticket mr-3"></span>จัดการจองคิว</a>
						</li>
					<?php
					}

					if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'KitchenStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../manageFood/manageFood.php';document.getElementById('demo').innerHTML = 'จัดเมนูอาหาร';">
							<a style="cursor: pointer;"><span class="fa fa-cog"></span><span class="fa fa-cutlery mr-1"></span>จัดเมนูอาหาร</a>
						</li>
					<?php
					}

					if ($_SESSION['role'] == 'admin') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../table/manageTable.php';document.getElementById('demo').innerHTML = 'จัดการโต๊ะ';">
							<a style="cursor: pointer;"><span class="fa fa-table mr-3"></span>จัดการโต๊ะ</a>
						</li>
					<?php
					}

					if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'ServiceStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../orderStaff/orderStaffSceen.php';document.getElementById('demo').innerHTML = 'สั่งอาหาร';">
							<a style="cursor: pointer;"><span class="fa fa-cutlery mr-3"></span>สั่งอาหาร</a>
						</li>
					<?php
					}

					if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'KitchenStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../Kitchen/KitchenScreen.php';document.getElementById('demo').innerHTML = 'ห้องครัว';">
							<a style="cursor: pointer;"><span class="fa fa-free-code-camp mr-3"></span>ห้องครัว</a>
						</li>
					<?php
					}

					if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'ServiceStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../Service/ServiceScreen.php';document.getElementById('demo').innerHTML = 'บริการ';">
							<a style="cursor: pointer;"><span class="fa fa-male mr-3"></span>บริการ</a>
						</li>
					<?php
					}

					if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'CashierStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../Cashier/CashierScreen.php';document.getElementById('demo').innerHTML = 'คิดเงิน';">
							<a style="cursor: pointer;"><span class="fa fa-database mr-3"></span>คิดเงิน</a>
						</li>
					<?php
					}
					?>
					<li class="active">
						<a href="../Session/Log_out.php" class="w3-bar-item w3-button"><span class="fa fa-sign-out mr-3"></span>ออกจากระบบ</a>
					</li>
				</ul>





			</div>
		</nav>


		<!-- Page Content  -->
		<div id="content">
			<div id="demo" style="
    		text-align: center;
    		font-size: 40px;
    		color: white;
    		margin: 10px 26px 10px 26px;
    		border-style: solid;
    		border-color: #3445b4;
    		border-radius: 20px;
    		font-family: 'RaleWay',sans-serif;
    		font-weight: 800;
    		text-transform: uppercase;
    		background: #3445b4;
    		">
				หน้าหลัก
			</div>

			<iframe id="iframe" src="../Admin/AdminScreenMain.php" frameborder="0" style="overflow: hidden;position:fixed;width: 100% ;height:150vh;"></iframe>

		</div>
		</body>
	</div>

	<script src="./js/jquery.min.js"></script>
	<script src="./js/popper.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/main.js"></script>
	</body>

</html>