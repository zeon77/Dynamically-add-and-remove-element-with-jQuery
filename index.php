<?php 
include_once 'inc/config.php';
include_once 'inc/functions.php';

$connection = getConnection();
$makes = getMakes($connection);

?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamically add and remove element with jQuery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' />
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container my-5">

        <div class="row">

            <!-- HTML form for creating a product -->
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <div class="form-inline motor" id="motor-1">
                    <div class="form-group">
                        <!-- <label for="motor-1-marka">Motor márka: </label> -->
                        <select name="motor-1-make" id="motor-1-make" class="form-control make-select">
                            <option value="-1">- Válassz gyártmányt -</option>
                            <?php foreach ($makes as $make): ?>
                                <option value="<?=$make['id']?>"><?= $make['make'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mx-sm-2">
                        <!-- <label for="motor-1-tipus">Motor típus: </label> -->
                        <select name="motor-1-model" id="motor-1-model" class="form-control model-select">
                            <option value="-1">- Válassz modellt -</option>
                        </select>
                    </div>

                    <!-- Remove motor -->
                    <!-- <button type="button" class="btn btn-danger remove-motor" id="remove-1">
                        <i class="fa fa-remove" aria-hidden="true"></i>
                    </button> -->

                </div>

                <div class="form-inline mt-2">
                    <div class="form-group">
                        <button type="button" class="btn btn-default" id="add-motor">
                            <i class="fa fa-plus" aria-hidden="true"></i> Új motor
                        </button>
                    </div>
                </div>

                <div class="form-inline mt-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Küldés</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js'></script>
    <script src="script.js"></script>
</body>

</html>