<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_GET['print'])) {
        echo $_GET['print'];
    }


    ?>
    <script>
        window.onload = function() {
            print();
            setTimeout(() => {
                close();
            }, 1000);
        }
    </script>
</body>

</html>