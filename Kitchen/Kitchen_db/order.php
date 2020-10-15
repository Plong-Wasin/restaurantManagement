<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../CSS/sb.css">
    <link rel="stylesheet" href="../../CSS/Order.css">
</head>

<body>
    <div id="ajax_order">
        <?php include('./AjexOrder.php') ?>
    </div>

</body>

</html>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        setInterval(() => {
            test();
        }, 1000);
    });
    var oldData;

    function test() {
        $.ajax({
            url: './AjexOrder.php',
            method: 'POST',
            success: function(data) {
                if (oldData != data) {
                    $('#ajax_order').html(data);
                    oldData = data;
                }
            }
        });
    }
</script>