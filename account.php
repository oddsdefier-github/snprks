<?php
session_start();
$title = "dashboard";
include 'connect.php';
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/scripts.php';

?>


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <?php include('header_nav.php');?>
    <!-- Main Content -->
    <div id="content">
        <?php
        function fetchData($conn, $table)
        {
            $query = "SELECT * FROM $table";
            $result = $conn->query($query);
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }


        // Fetch admin data using the fetchData function
        $adminData = fetchData($conn, 'account');
        ?>

        <!-- Main Content -->
        <div class="col-12 col-xl-12">
            <div class="col mt-4">

                <h1 class="mb-4 text-uppercase fw-bolder">Admin Account Management</h1>
                <hr>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#addAdminModal">
                    Add Admin
                </button>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table style="background-color: white;" class="table table-bordered solid">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Username</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($adminData as $admin) { ?>
                                    <tr>
                                        <td><?php echo $admin['id']; ?></td>
                                        <td><?php echo $admin['fullname']; ?></td>
                                        <td><?php echo $admin['username']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editadminModal<?php echo $admin['id']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="account_delete.php?id=<?php echo $admin['id']; ?>"
                                                class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit admin Modals -->
        <?php foreach ($adminData as $admin) { ?>
        <div class="modal fade" id="editadminModal<?= $admin['id'] ?>" tabindex="-1"
            aria-labelledby="editadminModalLabel<?= $admin['id'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" action="account_edit.php">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bolder" id="editadminModalLabel<?= $admin['id'] ?>">Edit
                                    admin
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <input type="hidden" name="admin_id" value="<?= $admin['id'] ?>">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Full Name:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                    value="<?= $admin['fullname'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="<?= $admin['username'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editAdmin">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>


        <!-- Add Admin Modal -->
        <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bolder" id="addAdminModalLabel">Add Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Full Name:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addAdmin">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
        include 'connect.php'; 

        if (isset($_POST['addAdmin'])) {
            $fullname = trim($_POST['fullname']);
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            // Validate inputs
            if (empty($fullname) || empty($username) || empty($password)) {
                echo "<script>alert('Please fill in all fields.'); window.location.href='account.php';</script>";
                exit(); 
            }

            // Check if username already exists
            $stmt = $conn->prepare("SELECT * FROM `account` WHERE `username` = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<script>alert('Username already exists.'); window.location.href='account.php';</script>";
                exit(); 
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO `account` (`fullname`, `username`, `password`, `timestamp`, `usertype`) VALUES (?, ?, ?, NOW(), 'Admin')");
            $stmt->bind_param("sss", $fullname, $username, $hashedPassword);

            if ($stmt->execute()) {
                echo "<script>alert('New Admin added successfully.'); window.location.href='account.php';</script>";
            } else {
                echo "<script>alert('Error adding new admin.'); window.location.href='account.php';</script>";
            }
        }
    ?>


</body>

</html>