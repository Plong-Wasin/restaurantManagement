<?php include('../Session/Check_Session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service</title>
    <link rel="stylesheet" href="../CSS/Service.css">
</head>

<body>
    <?php
    ?>
    <div id="table_status">
        <?php include('./Service_db/AjexService.php') ?>
    </div>

</body>

</html>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        setInterval(() => {
            test();
        }, 2000);
    });

    function test() {
        $.ajax({
            url: './Service_db/AjexService.php',
            method: 'POST',
            success: function(data) {
                $('#table_status').html(data);
            }
        });
    }
</script>