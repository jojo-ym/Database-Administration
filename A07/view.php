<?php
include('connect.php');

$userInfoID = $_GET['userInfoID'];

if (isset($_POST['btnEdit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $birthDay = $_POST['birthDay'];
    $addressID = $_POST['addressID'];

    $editQuery = "UPDATE usersinfo SET firstName='$firstName', lastName='$lastName', birthDay='$birthDay', addressID='$addressID' WHERE userInfoID='$userInfoID'";
    executeQuery($editQuery);

    header('Location: ./');
}


$editQuery = "SELECT * FROM usersinfo WHERE userInfoID = '$userInfoID'";
$results = executeQuery($editQuery);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile | Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card shadow rounded-5 p-5">
                    <div class="h3 text-center">
                        Edit Profile
                    </div>
                    <div class="text-center mt-3">
                        <img src="profile.webp" alt="Logo" width="40%" class="d-inline-block">
                    </div>


                    <?php
                    if (mysqli_num_rows($results) > 0) {
                        while ($socialmedia = mysqli_fetch_assoc($results)) {
                            ?>

                            <form method="post">
                                <input value="<?php echo $socialmedia['firstName'] ?>" class="mt-3 form-control" type="text"
                                    name="firstName" placeholder="First Name" required>
                                <input value="<?php echo $socialmedia['lastName'] ?>" class="mt-3 form-control" type="text"
                                    name="lastName" placeholder="Last Name" required>
                                <input value="<?php echo $socialmedia['birthDay'] ?>" class="mt-3 form-control" type="text"
                                    name="birthDay" placeholder="Birthday">
                                <input value="<?php echo $socialmedia['addressID'] ?>" class="mt-3 form-control" type="text"
                                    name="addressID" placeholder="Address ID">
                                <button class="mt-5 btn btn-primary" type="submit" name="btnEdit">
                                    Save
                                </button>
                            </form>

                            <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>