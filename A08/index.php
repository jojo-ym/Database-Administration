<?php
include("connect.php");

$aircraftTypeFilter = $_GET['aircraftType'] ?? '';
$airlineNameFilter = $_GET['airlineName'] ?? '';
$sort = $_GET['sort'] ?? '';
$order = $_GET['order'] ?? '';

$flightQuery = "SELECT * FROM flightlogs";

if ($aircraftTypeFilter != '' || $airlineNameFilter != '') {
  $flightQuery = $flightQuery . " WHERE";

  if ($aircraftTypeFilter != '') {
    $flightQuery = $flightQuery . " aircraftType='$aircraftTypeFilter'";
  }

  if ($aircraftTypeFilter != '' && $airlineNameFilter != '') {
    $flightQuery = $flightQuery . " AND";
  }

  if ($airlineNameFilter != '') {
    $flightQuery = $flightQuery . " airlineName='$airlineNameFilter'";
  }
}

if ($sort != '') {
  $flightQuery = $flightQuery . " ORDER BY $sort";

  if ($order != '') {
    $flightQuery = $flightQuery . " $order";
  }
}

$flightResults = executeQuery($flightQuery);

$aircraftTypeQuery = "SELECT DISTINCT(aircraftType) FROM flightlogs";
$aircraftTypeResults = executeQuery($aircraftTypeQuery);

$airlineNameQuery = "SELECT DISTINCT(airlineName) FROM flightlogs";
$airlineNameResults = executeQuery($airlineNameQuery);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flight</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row my-5">
      <div class="col-12">
        <form>
          <div class="card p-4 rounded-5">
            <div class="h6">
              Filter
            </div>
            <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-3">
              <div class="d-flex flex-column">
                <label for="aircraftTypeSelect">Aircraft Type</label>
                <select id="aircraftTypeSelect" name="aircraftType" class="form-control">
                  <option value="">Any</option>
                  <?php
                  if (mysqli_num_rows($aircraftTypeResults) > 0) {
                    while ($aircraftTypeRow = mysqli_fetch_assoc($aircraftTypeResults)) {
                      ?>
                      <option <?php if ($aircraftTypeFilter == $aircraftTypeRow['aircraftType']) {
                        echo "selected";
                      } ?>
                        value="<?php echo $aircraftTypeRow['aircraftType'] ?>">
                        <?php echo $aircraftTypeRow['aircraftType'] ?>
                      </option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>

              <div class="d-flex flex-column">
                <label for="airlineNameSelect">Airline Name</label>
                <select id="airlineNameSelect" name="airlineName" class="form-control">
                  <option value="">Any</option>
                  <?php
                  if (mysqli_num_rows($airlineNameResults) > 0) {
                    while ($airlineNameRow = mysqli_fetch_assoc($airlineNameResults)) {
                      ?>
                      <option <?php if ($airlineNameFilter == $airlineNameRow['airlineName']) {
                        echo "selected";
                      } ?>
                        value="<?php echo $airlineNameRow['airlineName'] ?>">
                        <?php echo $airlineNameRow['airlineName'] ?>
                      </option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>

              <div class="d-flex flex-column">
                <label for="sort">Sort By</label>
                <select id="sort" name="sort" class="form-control">
                  <option value="">None</option>
                  <option <?php if ($sort == "departureDatetime") {
                    echo "selected";
                  } ?> value="departureDatetime">
                    Departure Date</option>
                  <option <?php if ($sort == "arrivalDatetime") {
                    echo "selected";
                  } ?> value="arrivalDatetime">Arrival
                    Date</option>
                  <option <?php if ($sort == "flightDurationMinutes") {
                    echo "selected";
                  } ?>
                    value="flightDurationMinutes">Flight Duration</option>
                </select>
              </div>

              <div class="d-flex flex-column">
                <label for="order">Order</label>
                <select id="order" name="order" class="form-control">
                  <option <?php if ($order == "ASC") {
                    echo "selected";
                  } ?> value="ASC">Ascending</option>
                  <option <?php if ($order == "DESC") {
                    echo "selected";
                  } ?> value="DESC">Descending</option>
                </select>
              </div>
            </div>


            <div class="text-center">
              <button class="btn btn-primary ms-2 mt-4" style="width: fit-content">Submit</button>
            </div>

          </div>
        </form>
      </div>
    </div>
    <div class="row my-5">
      <div class="col">
        <div class="card p-4 rounded-5">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Flight Number</th>
                  <th scope="col">Departure Date</th>
                  <th scope="col">Arrival Date</th>
                  <th scope="col">Flight Duration</th>
                  <th scope="col">Airline Name</th>
                  <th scope="col">Aircraft Type</th>
                  <th scope="col">Passenger Count</th>
                  <th scope="col">Ticket Price</th>
                  <th scope="col">Pilot Name</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (mysqli_num_rows($flightResults) > 0) {
                  while ($flightRow = mysqli_fetch_assoc($flightResults)) {
                    $aircraftType = $flightRow['aircraftType'];
                    $airlineName = $flightRow['airlineName'];
                    ?>
                    <tr>
                      <th scope="row"><?php echo $flightRow['flightNumber'] ?></th>
                      <td><?php echo $flightRow['departureDatetime'] ?></td>
                      <td><?php echo $flightRow['arrivalDatetime'] ?></td>
                      <td><?php echo $flightRow['flightDurationMinutes'] ?> mins</td>
                      <td><?php echo $flightRow['airlineName'] ?></td>
                      <td><?php echo $flightRow['aircraftType'] ?></td>
                      <td><?php echo $flightRow['passengerCount'] ?></td>
                      <td><?php echo $flightRow['ticketPrice'] ?></td>
                      <td><?php echo $flightRow['pilotName'] ?></td>
                    </tr>
                    <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>