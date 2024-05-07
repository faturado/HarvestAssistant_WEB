

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harvest Assistant</title>
    <link rel="icon" type="jpg/pngs" href="assets/images/logo.png">
    <link rel="stylesheet" href="assets/css/analytics.css?v=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >
</head>
<body>
    
    <div class="container">

        <div class="sidebar">
            <ul>
                <li>
                    <a href="">
                        <span class="icon" ><ion-icon name="leaf-outline"></ion-icon></span>
                        <span class="title" >Harvest Assistant</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon" ><ion-icon name="home-outline" ></ion-icon></span>
                        <span class="title" >Dashboard</span>
                    </a>
                    <span class="htitle" >Dashboard</span>
                </li>

                <li>
                    <a href="farmers.php">
                        <span class="icon" ><ion-icon name="people-outline"></ion-icon></span>
                        <span class="title" >Farmers</span>
                    </a>
                    <span class="htitle" >Farmers</span>
                </li>
                
                <li>
                    <a href="analytics.php">
                        <span class="icon" ><ion-icon name="bar-chart-outline"></ion-icon></span>
                        <span class="title" >Analytics</span>
                    </a>
                    <span class="htitle" >Analytics</span>
                </li>

                <li>
                    <a href="report.php">
                        <span class="icon" ><ion-icon name="alert-circle-outline"></ion-icon></span>
                        <span class="title" >Report</span>
                    </a>
                    <span class="htitle" >Report</span>
                </li>

                <li>
                    <a href="messages.php">
                        <span class="icon" ><ion-icon name="chatbubble-outline"></ion-icon></span>
                        <span class="title" >Messages</span>
                    </a>
                    <span class="htitle" >Messages</span>
                </li>

                <li>
                    <a href="logout.php">
                        <span class="icon" ><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title" >Sign Out</span>
                    </a>
                    <span class="htitle" >Sign Out</span>
                </li>

            </ul>
        </div>
        

        <div class="main">
            <div class="topbar">
                <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
                
                <div class="search">
                    <label>
                        <input type="text" id="searchinput" placeholder="Search" >
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>       

                <div class="user">

                    <div class="topicon">
                        <span><ion-icon name="chatbubbles-outline"></ion-icon></span>
                        <span><ion-icon name="notifications-outline"></ion-icon></span>
                    </div>

                    <img src="assets/images/pfp.jpg" alt="">
                        <div class="userdes">
                            <p>Emerson Alvarado</p>
                            <small>Admin</small>
                        </div>
                </div>
            </div>

            <!-- ======================= Charts ================== -->
            <div class="h2a">
                <h2>Analytics</h2>
            </div>
            <div class="charts">
                
                <div class="chart">
                    <h2>Harvest Comparison</h2>
                    <canvas id="harvestChart" ></canvas>
                    <?php

                    $conn = new mysqli('localhost', 'root', '', 'harvest_data');


                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

        
                    $query = "SELECT date, recent_harvest, last_year_harvest FROM harvest ORDER BY date";
                    $result = $conn->query($query);

    
                    $labels = [];
                    $recentHarvest = [];
                    $lastYearHarvest = [];

                    while ($row = $result->fetch_assoc()) {
                        $labels[] = date('M', strtotime($row['date']));
                        $recentHarvest[] = $row['recent_harvest'];
                        $lastYearHarvest[] = $row['last_year_harvest'];
                    }

    
                    $conn->close();
                    ?>

                    <script>
                    var ctx = document.getElementById('harvestChart').getContext('2d');
                    var harvestChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: <?php echo json_encode($labels); ?>,
                            datasets: [{
                                label: 'Recent Harvest',
                                data: <?php echo json_encode($recentHarvest); ?>,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }, {
                                label: 'Last Year Harvest',
                                data: <?php echo json_encode($lastYearHarvest); ?>,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                    </script>
                
                </div>
                <div class="chart">
                    <h2>Crop</h2>
                    <canvas id="cropPieChart" width="200" height="200"></canvas>
                    <script>
                        
                        var years = ['2019', '2020', '2021', '2022', '2023'];
                        var riceCrop = [1000, 1200, 1100, 1050, 1300];
                        var cornCrop = [900, 950, 1000, 1050, 1100];

                        
                        var totalRiceCrop = riceCrop.reduce((a, b) => a + b, 0);
                        var totalCornCrop = cornCrop.reduce((a, b) => a + b, 0);

                      
                        var ctx = document.getElementById('cropPieChart').getContext('2d');
                        var cropPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Rice', 'Corn'],
                            datasets: [{
                            data: [totalRiceCrop, totalCornCrop],
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
                </div>
                <div class="chart">
                    <h2>-----</h2>
                </div>
                <div class="chart">
                    <h2>------</h2>
                </div>
                <div class="chart">
                    <h2>----</h2>
                </div>
                <div class="chart">
                    <h2>----</h2>
                </div>
            </div>
            
         

        </div>
    </div>





    <script src="assets/js/main.js" ></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>