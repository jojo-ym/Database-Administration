<?php
include("connect.php");

$query = "SELECT * FROM usersinfo";
$results = executeQuery($query);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    body {
        color: rgb(23, 22, 22);
        background-color: rgb(250, 252, 251);
        font-family: Arial;

    }

    .firstName {
        background-color: rgb(250, 252, 251);
        text-align: left;
        padding: 10px;
        width: 100%;
    }

    .lastName {
        background-color: rgb(250, 252, 251);
        text-align: left;
        padding: 10px;
        width: 100%;

    }

    .birthDate {
        margin-top: 30px background-color: rgb(250, 252, 251);
        text-align: left;
        padding: 10px;
        width: 100%;
    }

    .address {
        margin-top: 30px background-color: rgb(250, 252, 251);
        text-align: left;
        padding: 10px;
        width: 100%;
    }

    .navbar-brand {
        font-size: 50px;
    }
</style>

<body>
    <?php
    if (mysqli_num_rows($results) > 0) {
        while ($socialmedia = mysqli_fetch_assoc($results)) {
            ?>
            <nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
                <div class="container-fluid d-flex flex-column align-items-center">
                    <img src="profile.webp" alt="Logo" width="25%" class="d-inline-block">
                    <span class="navbar-brand mt-1">#<?php echo $socialmedia['userInfoID'] ?></span>
                </div>
            </nav>
            <div class="containerfluid d-flex justify-content-start">
                <div class="row mt-5">
                    <div class="col ms-3">


                        <h5 class="firstName">First Name: <?php echo $socialmedia['firstName'] ?></h5>
                        <h5 class="lastName">Last Name: <?php echo $socialmedia['lastName'] ?></h5>
                        <h5 class="birthDate">Birthday: <?php echo $socialmedia['birthDay'] ?></h5>
                        <h5 class="address">Address ID: <?php echo $socialmedia['addressID'] ?></h5>

                        <?php
        }
    }
    ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
