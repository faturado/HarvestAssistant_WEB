<?php
session_start();

include 'layout/header.php';

include 'models/Models.php';

include 'models/Admin.php';
include 'models/Farmers.php';
include 'models/Crops.php';
include 'models/Barangay.php';

if (!isset($_SESSION['user_login'])) {
    header('Location: login.php');
    exit();
}

$admin = new Admin('admins');
$farmers = new Farmers('farmers');
$crops = new Crops('crops');
$barangays = new Barangay('barangay');

$user = $_SESSION['user_login'];

$admin = $admin->where(['username' => $user])->get()[0];
$page = $_GET['page'] ?? 1;
$paginate = floor(count($farmers->all()) / 10) + 1;
$farmers = $farmers->farmers((int)$page);
// var_dump($farmers);
// die();
$crops = $crops->all();
$barangays = $barangays->all();

?>
<link rel="stylesheet" href="assets/css/farmers.css">
<link rel="stylesheet" href="css/farmer.css">
</head>

<body>

    <div class="container">

        <?php include 'layout/sidebar.php' ?>
        <?php include 'layout/nav.php' ?>

        <!-- ================ Hrvest Details List ================= -->
        <div class="details">
            <div class="farmerlist">
                <div style="margin-bottom: 2em">
                    <h2 style="text-align:center">Farmers' Information</h2>


                    <?php
                    if (isset($_SESSION['success_message'])) {
                        echo '<div class="alert-success">' . $_SESSION['success_message'] . '</div>';
                        unset($_SESSION['success_message']);
                    }

                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="alert-error">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']);
                    }

                    ?>
                    <button class="btn-main" onclick="popup(popupfarmer)"><i class="las la-user-plus addicon"></i> <span>Add Farmer</span></button>
                    <button class="btn-main" onclick="popup(popupcsv)"><i class="las la-file-excel addicon"></i> <span>Batch Upload Farmer</span></button>


                </div>
                <!-- Upload File -->
                <div id="popupcsv" class="popup">

                    <div class="popup-content">
                        <span class="close" onclick="closepopup(popupcsv)">&times;</span>
                        <h3>Batch Upload</h3>

                        <!-- <form action="scripts/add-farmer.php" method="POST">
                            
                        </form> -->
                        <form action="scripts/batch-upload.php" method="POST" name="upload_file" enctype="multipart/form-data">
                            <input class="file-input" type="file" name="csv_farmers" accept=".csv" required>
                            <button class="addfarmer" type="submit">Upload File</button>
                        </form>
                    </div>

                </div>

                <!-- Add Farmers -->
                <div id="popupfarmer" class="popup">

                    <div class="popup-content">
                        <span class="close" onclick="closepopup(popupfarmer)">&times;</span>
                        <h3>Add New Farmer</h3>

                        <form action="scripts/add-farmer.php" method="POST">
                            <label class="lbl" for="rsbsanumber">RSBSA Number</label>
                            <input class="inp" type="text" id="rsbsa_num" name="rsbsa_num" required>

                            <label class="lbl" for="fname">First Name</label>
                            <input class="inp" type="text" id="fname" name="fname" required>

                            <label class="lbl" for="mname">Middle Name</label>
                            <input class="inp" type="text" id="mname" name="mname">

                            <label class="lbl" for="lname">Last Name</label>
                            <input class="inp" type="text" id="lname" name="lname" required>

                            <label class="lbl" for="crop">Select Crop</label>
                            <select class="inp" id="crop" name="crop" required>
                                <?php
                                foreach ($crops as $crop) {
                                ?>
                                    <option value="<?= $crop['id'] ?>"><?= $crop['crop_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <label class="lbl" for="area">Area</label>
                            <input class="inp" type="number" step="0.01" id="area" name="area" required>

                            <label class="lbl" for="barangay">Select Barangay</label>
                            <select class="inp" id="barangay" name="barangay" required>
                                <?php
                                foreach ($barangays as $barangay) {
                                ?>
                                    <option value="<?= $barangay['id'] ?>"><?= $barangay['barangay_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <label class="lbl" for="contact">Contact</label>
                            <input class="inp" type="number" id="contact" name="contact" required>

                            <label class="lbl" for="password">Password</label>
                            <input class="inp" type="password" id="password" name="password" required>

                            <button class="addfarmer" type="submit">Add</button>
                        </form>
                    </div>

                </div>

                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>RSBSA Number</th>
                            <th>Full Name</th>
                            <th>Crop</th>
                            <th>Area</th>
                            <th>Barangay</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($farmers as $farmer) {
                        ?>
                            <tr>
                                <td><?= $farmer['id'] ?></td>
                                <td><?= $farmer['rsbsa_num'] ?></td>
                                <td>
                                    <?= $farmer['first_name'] ?>
                                    <?= $farmer['middle_name'] ?? '' ?>
                                    <?= $farmer['last_name'] ?>
                                </td>
                                <td><?= $farmer['crop_name'] ?></td>
                                <td><?= $farmer['area'] ?> sq/m</td>
                                <td><?= $farmer['barangay_name'] ?></td>
                                <td><?= $farmer['contact_number'] ?></td>
                                <td></td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <div style="display:flex; justify-content:flex-end; margin:10px; gap: 5px">
                <?php
                $count = 1;
                while ($count <= $paginate) {
                ?>
                    <a href="./farmers.php?page=<?= $count ?>" class="btn-main">
                        <?= $count ?>
                    </a>
                <?php
                    $count++;
                }
                ?>
            </div>
        </div>



    </div>
    </div>

    <script>
        function popup(id) {
            id.style.display = 'block'
        }

        function closepopup(id) {
            id.style.display = 'none'
        }

        // window.onclick = function(event) {
        //     if (event.target == modal) {
        //         modal.style.display = "none";
        //     }
        // }
    </script>



    <?php

    include 'layout/footer.php';
