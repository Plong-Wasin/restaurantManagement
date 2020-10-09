<?php

//! ก็อปpath ของ currentTime.php ไปวางด้วย แบบurl

$start = filemtime($fileName);
$path = str_replace('\\', '/', dirname(__FILE__) . "/currentTime.php");

include_once(__DIR__ . "/../require/req.php");

?>


<script>
    $(document).ready(function() {
        setInterval(() => {
            var data1 = "<?php echo $fileName ?>";
            $.ajax({
                url: "http://localhost/restaurantManagement/hot_reload/currentTime.php",
                // url: "<?php $path ?>",
                method: "POST",
                data: {
                    name: data1
                },
                success: function(data) {
                    if (data != <?php echo $start; ?>) {
                        location.reload();
                    }

                }
            });
        }, 1000);

    });
</script>