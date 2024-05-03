<?php
    session_start();
    $title = "dashboard";
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/scripts.php';

?>

<body>
    <div class="container-fluid">
        <?php include('header_nav.php');?>
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">


                <?php
                $username = $_SESSION['username'];

                function fetchUserData($conn, $table, $username) {
                    $query = "SELECT * FROM $table WHERE username = '$username'";
                    $result = $conn->query($query);
                    return $result->fetch_assoc();
                }

                // Fetch user data using the fetchUserData function
                $userData = fetchUserData($conn, 'account', $username);
            ?>

                <!-- Main Content -->
                <div class="col-12 col-xl-12">
                    <div class="col mt-4">
                        <h1 class="mb-2 text-uppercase fw-bolder">Profile</h1>
                        <hr>


                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table style="background-color: white;" class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Full Name</th>
                                                <td><?php echo $userData['fullname']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Username</th>
                                                <td><?php echo $userData['username']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>User Type</th>
                                                <td><?php echo $userData['usertype']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Timestamp</th>
                                                <td><?php echo $userData['timestamp']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>