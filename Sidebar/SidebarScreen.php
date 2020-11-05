<?php include("../Session/Check_Session.php");
include("../require/connectDB.php")
?>

<!doctype html>
<html lang="th">

<head>
	<title>ระบบจัดการร้านอาหาร</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php
	if ($_SESSION['role'] == 'admin') { ?>
		<link rel="stylesheet" href="./css/style.css">
	<?php
	} else if ($_SESSION['role'] == 'WelcomeStaff') { ?>
		<link rel="stylesheet" href="./css/styleW.css">
	<?php
	} else if ($_SESSION['role'] == 'ServiceStaff') { ?>
		<link rel="stylesheet" href="./css/styleS.css">
	<?php
	} else if ($_SESSION['role'] == 'KitchenStaff') { ?>
		<link rel="stylesheet" href="./css/styleK.css">
	<?php
	} else if ($_SESSION['role'] == 'CashierStaff') { ?>
		<link rel="stylesheet" href="./css/styleC.css">
	<?php
	}
	?>
</head>

<body>
	<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar">
			<div class="custom-menu">
				<button type="button" id="sidebarCollapse" class="btn btn-primary">
					<i class="fa fa-bars"></i>
					<span class="sr-only">Toggle Menu</span>
				</button>
			</div>
			<div class="p-4">
				<?php
				$db = "SELECT `value` FROM `setting` WHERE `name` = 'background'";
				$check = mysqli_query($conn, $db);
				while ($record = mysqli_fetch_array($check, MYSQLI_ASSOC)) {
					$logo = $record['value'];
				}
				?>
				<h1><a class="logo"><img src="../src/img/<?php echo $logo ?>" width="100" height="100"></a></h1>
				<h1><a class="logo"><?php echo $_SESSION['username'] ?> <span><?php echo $_SESSION['role'] ?></span></a></h1>
				<ul class="list-unstyled components mb-5">
					<?php
					if ($_SESSION['role'] == 'admin') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../Admin/AdminScreenMain.php';document.getElementById('demo').innerHTML = 'หน้าหลัก';">
							<a style="cursor: pointer;"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
						</li>
					<?php
					} else if ($_SESSION['role'] == 'WelcomeStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../editProfile/editProfile.php';document.getElementById('demo').innerHTML = 'หน้าหลัก';">
							<a style="cursor: pointer;"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
						</li>
					<?php
					} else if ($_SESSION['role'] == 'ServiceStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../editProfile/editProfile.php';document.getElementById('demo').innerHTML = 'หน้าหลัก';">
							<a style="cursor: pointer;"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
						</li>
					<?php
					} else if ($_SESSION['role'] == 'KitchenStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../editProfile/editProfile.php';document.getElementById('demo').innerHTML = 'หน้าหลัก';">
							<a style="cursor: pointer;"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
						</li>
					<?php
					} else if ($_SESSION['role'] == 'CashierStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../editProfile/editProfile.php';document.getElementById('demo').innerHTML = 'หน้าหลัก';">
							<a style="cursor: pointer;"><span class="fa fa-home mr-3"></span>หน้าหลัก</a>
						</li>
					<?php
					}

					if ($_SESSION['role'] == 'admin'  || $_SESSION['role'] == 'CashierStaff') { ?>
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

					// if ($_SESSION['role'] == 'admin') { 
					?>
					<li class="active" onclick="document.getElementById('iframe').src='../table/manageTable.php';document.getElementById('demo').innerHTML = '<?php if ($_SESSION['role'] == 'admin') {
																																									echo 'จัดการโต๊ะ';
																																								} else {
																																									echo 'ดูสถานะโต๊ะ';
																																								} ?>';">
						<a style="cursor: pointer;"><span class="fa fa-table mr-3"></span><?php if ($_SESSION['role'] == "admin") {
																								echo "จัดการโต๊ะ";
																							} else {
																								echo "ดูสถานะโต๊ะ";
																							} ?></a>
					</li>
					<?php
					//}

					if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'ServiceStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../orderStaff/orderStaffSceen.php';document.getElementById('demo').innerHTML = 'สั่งอาหาร';">
							<a style="cursor: pointer;"><span class="fa fa-cutlery mr-3"></span>สั่งอาหาร</a>
						</li>
					<?php
					}

					if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'KitchenStaff') { ?>
						<li class="active" onclick="document.getElementById('iframe').src='../Kitchen/Kitchen_db/order.php';document.getElementById('demo').innerHTML = 'ห้องครัว';">
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
		<?php
		if ($_SESSION['role'] == 'admin') { ?>
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
			<?php
		} else if ($_SESSION['role'] == 'WelcomeStaff') { ?>
				<div id="content">
					<div id="demo" style="
    		text-align: center;
    		font-size: 40px;
    		color: white;
    		margin: 10px 26px 10px 26px;
    		border-style: solid;
    		border-color: #800080;
    		border-radius: 20px;
    		font-family: 'RaleWay',sans-serif;
    		font-weight: 800;
    		text-transform: uppercase;
    		background: #800080;
    		">
						หน้าหลัก
					</div>
				<?php
			} else if ($_SESSION['role'] == 'ServiceStaff') { ?>
					<div id="content">
						<div id="demo" style="
    		text-align: center;
    		font-size: 40px;
    		color: white;
    		margin: 10px 26px 10px 26px;
    		border-style: solid;
    		border-color: #095c10;
    		border-radius: 20px;
    		font-family: 'RaleWay',sans-serif;
    		font-weight: 800;
    		text-transform: uppercase;
    		background: #095c10;
    		">
							หน้าหลัก
						</div>
					<?php
				} else if ($_SESSION['role'] == 'KitchenStaff') { ?>
						<div id="content">
							<div id="demo" style="
    		text-align: center;
    		font-size: 40px;
    		color: white;
    		margin: 10px 26px 10px 26px;
    		border-style: solid;
    		border-color: firebrick;
    		border-radius: 20px;
    		font-family: 'RaleWay',sans-serif;
    		font-weight: 800;
    		text-transform: uppercase;
    		background: firebrick;
    		">
								หน้าหลัก
							</div>
						<?php
					} else if ($_SESSION['role'] == 'CashierStaff') { ?>
							<div id="content">
								<div id="demo" style="
    		text-align: center;
    		font-size: 40px;
    		color: white;
    		margin: 10px 26px 10px 26px;
    		border-style: solid;
    		border-color: #806904;
    		border-radius: 20px;
    		font-family: 'RaleWay',sans-serif;
    		font-weight: 800;
    		text-transform: uppercase;
    		background: #806904;
    		">
									หน้าหลัก
								</div>
							<?php
						}
							?>
							<?php
							if ($_SESSION['role'] == 'admin') { ?>
								<iframe id="iframe" src="../Admin/AdminScreenMain.php" style="overflow: hidden; height: 88vh;width: 100%; " frameborder="0"></iframe>
							<?php
							} else { ?>
								<iframe id="iframe" src="../editProfile/editProfile.php" style="overflow: hidden; height: 88vh;
        width: 100%; " frameborder="0"></iframe>
							<?php
							} ?>


							</div>
</body>
</div>

<script src="./js/jquery.min.js"></script>
<script src="./js/popper.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/main.js"></script>
</body>

</html>