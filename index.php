<?php
session_start();

include_once('layout/header.php');

include 'models/Models.php';

include 'models/Admin.php';
include 'models/Farmers.php';
include 'models/Harvest.php';
include 'models/PestReports.php';
include 'functions.php';

if (!isset($_SESSION['user_login'])) {
    header('Location: login.php');
    exit();
}

$admin = new Admin();
$farmers = new Farmers();
$harvests = new Harvest();
$pests = new PestReports();

$user = $_SESSION['user_login'];

$admin = $admin->where(['username' => $user])->get()[0];
$farmers = $farmers->all();
$pests = $pests->all();

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
                        <div class="number"><?= count($pests) ?></div>
                        <div class="cardname">Pest Detected</div>
                    </div>
                </a>

                <div class="card-icon">
                    <i class="las la-bug"></i>
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

        $date = $harvests->all();


        $lastYear = array_filter($date, function ($data) {
            $getLastYear = new DateTime();
            $getYear = new DateTime($data['date_harvested']);
            $getLastYear = $getLastYear->modify('-1 year');
            return $getYear->format('Y') == $getLastYear->format('Y');
        });

        $thisYear = array_filter($date, function ($data) {
            $getThisYear = new DateTime();
            $getYear = new DateTime($data['date_harvested']);
            return $getYear->format('Y') == $getThisYear->format('Y');
        });


        $crops = pluck($harvests->harvests(), 'crop_name');
        $corn = array_filter($crops, function ($crop) {
            return $crop == 'Corn';
        });

        $rice = array_filter($crops, function ($crop) {
            return $crop == 'Rice';
        });

        ?>

        var lastYear = [<?php echo json_encode($lastYear); ?>]
        lastYear = Object.values(...lastYear)
        var thisYear = [<?php echo json_encode($thisYear); ?>]
        thisYear = Object.values(...thisYear)

        var monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        let lastJan = lastYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 0
        })
        let lastFeb = lastYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 1
        })
        let lastMar = lastYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 2
        })
        let lastApr = lastYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 4
        })
        let lastMay = lastYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 5
        })
        let lastJun = lastYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 6
        })
        let lastJul = lastYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 7
        })
        let lastAug = lastYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 8
        })
        let lastSep = lastYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 9
        })
        let lastOct = lastYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 9
        })
        let lastNov = lastYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 10
        })
        let lastDec = lastYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 11
        })

        let thisJan = thisYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 0
        })
        let thisFeb = thisYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 1
        })
        let thisMar = thisYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 2
        })
        let thisApr = thisYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 4
        })
        let thisMay = thisYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 5
        })
        let thisJun = thisYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 6
        })
        let thisJul = thisYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 7
        })
        let thisAug = thisYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 8
        })
        let thisSep = thisYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 9
        })
        let thisOct = thisYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 9
        })
        let thisNov = thisYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 10
        })
        let thisDec = thisYear.filter(data => {
            date = new Date(data.date_harvested)
            date = date.getMonth()
            return date == 11
        })

        console.log()

        lastYear = {
            Jan: lastJan ? lastJan.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Feb: lastFeb ? lastFeb.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Mar: lastMar ? lastMar.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Apr: lastApr ? lastApr.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            May: lastMay ? lastMay.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Jun: lastJun ? lastJun.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Jul: lastJul ? lastJul.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Aug: lastAug ? lastAug.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Sep: lastSep ? lastSep.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Oct: lastOct ? lastOct.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Nov: lastNov ? lastNov.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Dec: lastDec ? lastDec.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
        }

        thisYear = {
            Jan: thisJan ? thisJan.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Feb: thisFeb ? thisFeb.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Mar: thisMar ? thisMar.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Apr: thisApr ? thisApr.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            May: thisMay ? thisMay.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Jun: thisJun ? thisJun.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Jul: thisJul ? thisJul.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Aug: thisAug ? thisAug.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Sep: thisSep ? thisSep.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Oct: thisOct ? thisOct.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Nov: thisNov ? thisNov.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
            Dec: thisDec ? thisDec.reduce(function(sum, obj) {
                return obj.estimated_produce + sum
            }, 0) : [],
        }

        var ctx = document.getElementById('harvestChart').getContext('2d');
        var harvestChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Estimated Last Year',
                    data: [
                        lastYear.Jan,
                        lastYear.Feb,
                        lastYear.Mar,
                        lastYear.Apr,
                        lastYear.May,
                        lastYear.Jun,
                        lastYear.Jul,
                        lastYear.Aug,
                        lastYear.Sep,
                        lastYear.Oct,
                        lastYear.Nov,
                        lastYear.Dec,
                    ],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }, {
                    label: 'Estimated Produce This Year',
                    data: [
                        thisYear.Jan,
                        thisYear.Feb,
                        thisYear.Mar,
                        thisYear.Apr,
                        thisYear.May,
                        thisYear.Jun,
                        thisYear.Jul,
                        thisYear.Aug,
                        thisYear.Sep,
                        thisYear.Oct,
                        thisYear.Nov,
                        thisYear.Dec,
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
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: true,
                        text: 'Rice and Corn Crop Harvest Comparison (Total)'
                    },
                }
            }
        });
    </script>

    <?php

    include_once 'layout/footer.php';
    ?>