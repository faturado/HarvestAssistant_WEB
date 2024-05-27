<?php
session_start();

include_once('layout/header.php');

include 'models/Models.php';

include 'models/Admin.php';
include 'models/Farmers.php';
include 'models/Harvest.php';
include 'functions.php';

if(!isset($_SESSION['user_login'])){
    header('Location: login.php');
    exit();
}

$admin = new Admin();
$farmers = new Farmers('farmers');
$harvests = new Harvest('harvest');

$user = $_SESSION['user_login'];

$admin = $admin->where(['username' => $user])->get()[0];
$farmers = $farmers->all();

?>

</head>

<body>

    <div class="container">

        <?php include 'layout/sidebar.php' ?>
        <?php include 'layout/nav.php' ?>

        <!-- ======================= Cards ================== -->
        <div class="cards">
            <div class="card">
                <a href="farmers.php">
                    <div>
                        <div class="number"><?= count($farmers); ?></div>
                        <div class="cardname">Total Farmers</div>
                    </div>
                </a>
                <div class="card-icon">
                    <i class="las la-users"></i>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="number"><?= count($harvests->harvests()) ?></div>
                    <div class="cardname">Recent Harvest</div>
                </div>

                <div class="card-icon">
                    <i class="las la-seedling"></i>
                </div>
            </div>

            <div class="card">
                <a href="report.php">
                    <div>
                        <div class="number">7</div>
                        <div class="cardname">Pest Detected</div>
                    </div>
                </a>

                <div class="card-icon">
                    <i class="las la-bug"></i>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="number">3</div>
                    <div class="cardname">Schedules</div>
                </div>
                <div class="card-icon">
                    <i class="las la-calendar"></i>
                </div>
            </div>
        </div>

        <!-- ======================= Charts ================== -->
        <div class="charts">

            <!-- Comparison Chart -->
            <div class="chart">
                <h2>Harvest Comparison</h2>
                <canvas id="harvestChart"></canvas>
            </div>

            <!-- Crop Charts -->
            <div class="chart">
                <h2>Crop</h2>
                <canvas id="cropPieChart" width="200" height="200"></canvas>
            </div>
        </div>



    </div>
    </div>

    <script>
        <?php
        if (isset($_GET['login']) && $_GET['login'] == "success") {
            echo "alert('Successfully logged in');";
        }
        ?>
    </script>


    <script>
        <?php

        $date = pluck($harvests->harvests(), 'date_harvested');

        $lastYear = array_filter($date, function ($data) {
            $getLastYear = new DateTime();
            $getYear = new DateTime($data);
            $getLastYear = $getLastYear->modify('-1 year');
            return $getYear->format('Y') == $getLastYear->format('Y');
        });

        $thisYear = array_filter($date, function ($data) {
            $getThisYear = new DateTime();
            $getYear = new DateTime($data);
            return $getYear->format('Y') == $getThisYear->format('Y');
        });

        $lastYear = array_reduce($lastYear, function ($carry, $date) {
            $getMonth = new DateTime($date);
            $monthAbbreviation = $getMonth->format('M');
            $carry[$monthAbbreviation][] = $date;
            return $carry;
        }, []);

        $thisYear = array_reduce($thisYear, function ($carry, $date) {
            $getMonth = new DateTime($date);
            $monthAbbreviation = $getMonth->format('M');
            $carry[$monthAbbreviation][] = $date;
            return $carry;
        }, []);

        $crops = pluck($harvests->harvests(), 'crop_name');
        $corn = array_filter($crops, function ($crop) {
            return $crop == 'Corn';
        });

        $rice = array_filter($crops, function ($crop) {
            return $crop == 'Rice';
        });

        ?>

        lastYear = [<?php echo json_encode($lastYear); ?>]
        thisYear = [<?php echo json_encode($thisYear); ?>]

        lastYear = {
            Jan: lastYear[0].Jan ? lastYear[0].Jan : [],
            Feb: lastYear[0].Feb ? lastYear[0].Feb : [],
            Mar: lastYear[0].Mar ? lastYear[0].Mar : [],
            Apr: lastYear[0].Apr ? lastYear[0].Apr : [],
            May: lastYear[0].May ? lastYear[0].May : [],
            Jun: lastYear[0].Jun ? lastYear[0].Jun : [],
            Jul: lastYear[0].Jul ? lastYear[0].Jul : [],
            Aug: lastYear[0].Aug ? lastYear[0].Aug : [],
            Sep: lastYear[0].Sep ? lastYear[0].Sep : [],
            Oct: lastYear[0].Oct ? lastYear[0].Oct : [],
            Nov: lastYear[0].Nov ? lastYear[0].Nov : [],
            Dec: lastYear[0].Dec ? lastYear[0].Dec : [],
        }

        thisYear = {
            Jan: thisYear[0].Jan ? thisYear[0].Jan : [],
            Feb: thisYear[0].Feb ? thisYear[0].Feb : [],
            Mar: thisYear[0].Mar ? thisYear[0].Mar : [],
            Apr: thisYear[0].Apr ? thisYear[0].Apr : [],
            May: thisYear[0].May ? thisYear[0].May : [],
            Jun: thisYear[0].Jun ? thisYear[0].Jun : [],
            Jul: thisYear[0].Jul ? thisYear[0].Jul : [],
            Aug: thisYear[0].Aug ? thisYear[0].Aug : [],
            Sep: thisYear[0].Sep ? thisYear[0].Sep : [],
            Oct: thisYear[0].Oct ? thisYear[0].Oct : [],
            Nov: thisYear[0].Nov ? thisYear[0].Nov : [],
            Dec: thisYear[0].Dec ? thisYear[0].Dec : [],
        }

        var ctx = document.getElementById('harvestChart').getContext('2d');
        var harvestChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Harvests Last Year',
                    data: [
                        lastYear.Jan.length,
                        lastYear.Feb.length,
                        lastYear.Mar.length,
                        lastYear.Apr.length,
                        lastYear.May.length,
                        lastYear.Jun.length,
                        lastYear.Jul.length,
                        lastYear.Aug.length,
                        lastYear.Sep.length,
                        lastYear.Oct.length,
                        lastYear.Nov.length,
                        lastYear.Dec.length,
                    ],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }, {
                    label: 'Harvests This Year',
                    data: [
                        thisYear.Jan.length,
                        thisYear.Feb.length,
                        thisYear.Mar.length,
                        thisYear.Apr.length,
                        thisYear.May.length,
                        thisYear.Jun.length,
                        thisYear.Jul.length,
                        thisYear.Aug.length,
                        thisYear.Sep.length,
                        thisYear.Oct.length,
                        thisYear.Nov.length,
                        thisYear.Dec.length,
                    ],
                    fill: false,
                    borderColor: 'rgb(255, 0, 0)',
                    tension: 0.1
                }]
            }
        });

        rice = [<?php echo json_encode($rice) ?>]
        corn = [<?php echo json_encode($corn) ?>]

        var ctx = document.getElementById('cropPieChart').getContext('2d');
        var cropPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Rice', 'Corn'],
                datasets: [{
                    data: [Object.values(rice[0]).length, Object.values(corn[0]).length],
                    backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(255, 159, 64, 0.5)'],
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 159, 64, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Rice and Corn Crop Harvest Comparison (Total)'
                },
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        });
    </script>

    <?php

    include_once 'layout/footer.php';
    ?>
