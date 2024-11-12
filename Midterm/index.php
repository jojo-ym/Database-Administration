<?php
include("connect.php");


if (isset($_POST['btnSubmitInfo'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $birthDay = $_POST['birthDay'];
    $addressID = $_POST['addressID'];

    $infoQuery = "INSERT INTO usersinfo(firstName, lastName, birthDay, addressID) VALUES ('$firstName', '$lastName', '$birthDay', '$addressID')";
    executeQuery($infoQuery);
}


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


    .firstName,
    .lastName,
    .birthDate,
    .address {
        margin: 5px 0;
        margin-bottom: 5px;
    }

    .card-body {
        text-align: left;
    }
</style>

<body>
    <div class="container-fluid">
        <form method="post">
            <div class="row py-5">
                <div class="col">
                    <input type="text" class="form-control" name="firstName" placeholder="First Name"
                        aria-label="First name" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="lastName" placeholder="Last Name"
                        aria-label="Last name" required>
                </div>
            </div>
            <div class="row pb-5">
                <div class="col">
                    <input type="text" class="form-control" name="birthDay" placeholder="MM-DD-YYYY"
                        aria-label="Birthday">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="addressID" placeholder="0000000"
                        aria-label="Address ID">
                </div>
                <div class="row py-4 d-flex justify-content-center">
                    <button type="submit" name="btnSubmitInfo" class="btn btn-primary"
                        style="width: 100px;">Add</button>
                </div>
        </form>
        <div class="container">
            <div class="row py-5">
                <?php
                if (mysqli_num_rows($results) > 0) {
                    while ($socialmedia = mysqli_fetch_assoc($results)) {
                        ?>

                        <div class="col-12 col-md-6 col-lg-4 my-5">
                            <div class="card shadow" style="width: 420px;">
                                <div class="text-center mt-3">
                                    <img src="profile.webp" alt="Logo" width="50%" class="d-inline-block">
                                </div>
                                <div class="card-body text-center">
                                    <span class="userInfoID mt-1"
                                        style="font-size:25px">#<?php echo $socialmedia['userInfoID'] ?></span>
                                </div>
                                <div class="container-fluid d-flex justify-content-start">
                                    <div class="row mt-5 w-100">
                                        <div class="col-12 text-start">
                                            <h5 class="firstName">First Name: <?php echo $socialmedia['firstName'] ?></h5>
                                            <h5 class="lastName">Last Name: <?php echo $socialmedia['lastName'] ?></h5>
                                            <h5 class="birthDay">Birthday: <?php echo $socialmedia['birthDay'] ?></h5>
                                            <h5 class="addressID">Address ID: <?php echo $socialmedia['addressID'] ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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