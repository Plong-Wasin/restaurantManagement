<?php
?>
<link rel="stylesheet" href="../CSS/sb.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
    <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
    <?php
    if ($_SESSION['role'] == 'admin') { ?>
        <a href="../Admin/AdminScreenMain.php" class="w3-bar-item w3-button">หน้าหลัก</a>
    <?php
    } else if ($_SESSION['role'] == 'WelcomeStaff') { ?>
        <a href="../WelcomeScreen/WelcomeScreenMain.php" class="w3-bar-item w3-button">หน้าหลัก</a>
    <?php
    } else if ($_SESSION['role'] == 'ServiceStaff') { ?>
        <a href="../ServiceScreen/ServiceScreenMain.php" class="w3-bar-item w3-button">หน้าหลัก</a>
    <?php
    } else if ($_SESSION['role'] == 'KitchenStaff') { ?>
        <a href="../KitchenScreen/KitchenScreenMain.php" class="w3-bar-item w3-button">หน้าหลัก</a>
    <?php
    } else if ($_SESSION['role'] == 'CashierStaff') { ?>
        <a href="../CashierScreen/CashierScreenMain.php" class="w3-bar-item w3-button">หน้าหลัก</a>
    <?php
    }

    if ($_SESSION['role'] == 'admin') { ?>
        <a href="../dashboard/saleResult.php" class="w3-bar-item w3-button">ประวัติการขาย</a>
    <?php
    }

    if ($_SESSION['role'] == 'admin') { ?>
        <a href="../Staff/StaffScreen.php" class="w3-bar-item w3-button">พนักงาน</a>
    <?php
    }

    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'WelcomeStaff') { ?>
        <a href="../queue/manageQueue.php" class="w3-bar-item w3-button">จัดการจองคิว</a>
    <?php
    }

    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'KitchenStaff') { ?>
        <a href="../manageFood/manageFood.php" class="w3-bar-item w3-button">จัดเมนูอาหาร</a>
    <?php
    }

    if ($_SESSION['role'] == 'admin') { ?>
        <a href="../table/manageTable.php" class="w3-bar-item w3-button">จัดการโต๊ะ</a>
    <?php
    }

    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'ServiceStaff') { ?>
        <a href="../orderStaff/orderStaffSceen.php" class="w3-bar-item w3-button">สั่งอาหาร</a>
    <?php
    }

    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'KitchenStaff') { ?>
        <a href="../Kitchen/KitchenScreen.php" class="w3-bar-item w3-button">ห้องครัว</a>
    <?php
    }

    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'ServiceStaff') { ?>
        <a href="../Service/ServiceScreen.php" class="w3-bar-item w3-button">บริการ</a>
    <?php
    }

    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'CashierStaff') { ?>
        <a href="../Cashier/CashierScreen.php" class="w3-bar-item w3-button">คิดเงิน</a>
    <?php
    }
    ?>



    <a href="../Session/Log_out.php" class="w3-bar-item w3-button">ออกจากระบบ</a>

</div>


<div class="row">
    <div class="column">
        <button class="Sidebar" onclick="w3_open()">☰</button>
    </div>
    <div class="column1">
        <p1>ชื่อ : <?php echo $_SESSION['username'] ?> ตำแหน่ง :<?php echo $_SESSION['role'] ?></p1>
    </div>
</div>




<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }
</script>