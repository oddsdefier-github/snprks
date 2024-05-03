<?php
session_start();
$title = "dashboard";
include 'includes/header.php';


?>

<body style="background: url('img/stonino.jpg') no-repeat center/cover;" class="vh-100 w-100">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-12 col-xl-2">
                <div
                    class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 bg">
                    <div class="d-flex">
                        <img src="img/logo.png" class="logo me-2" alt="pos">
                        <a href="index.php"
                            class="d-flex align-items-center mb-md-0 me-md-auto text-black text-decoration-none">
                            <span style="color: black; font-size: 20px; font-family:'Cambria';" class="fw-bold">
                                <?php echo "Welcome, ", $_SESSION['username']; ?>!
                            </span>
                        </a>
                    </div>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto w-100">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link ">
                                <i class="bx bxs-dashboard me-2"></i>Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="info.php" class="nav-link active">
                                <i class='bx bxs-user me-2'></i>Client Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="schedules.php" class="nav-link ">
                                <i class="fa-solid fa-calendar-days me-2"></i>Schedules
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="payment.php" class="nav-link ">
                                <i class='bx bx-money me-2'></i>Donation
                            </a>
                        <li class="nav-item">
                            <a href="clientinfo.php" class="nav-link ">
                                <i class="fa-solid fa-clock-rotate-left"></i> Client Information History
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="account.php" class="nav-link active">
                                <i class='bx bxs-user-account me-2'></i>Admin Account
                            </a>
                        </li>
                        <hr class="dropdown-divider" style="color: blue;">
                        <li class="nav-item">
                            <a href="" style="color: blue; font-size: 18px; font-family:'Cambria';" class="nav-link">
                                SACRAMENTS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="baptism.php" class="nav-link ">
                                <i class='fas fa-church'></i> Baptism
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="communion.php" class="nav-link ">
                                <i class="fa-solid fa-dove"></i> Confirmation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="marriage.php" class="nav-link ">
                                <i class="fa-solid fa-venus-mars"></i> Marriage
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="conversion.php" class="nav-link ">
                                <i class="fa-solid fa-cross"></i> Conversion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="defunctorum.php" class="nav-link ">
                                <i class='fas fa-ribbon'></i> Death Records
                            </a>
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle ms-2"
                            id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/logo.png" alt="pos" width="32" height="32" class="rounded-circle me-2">
                            <strong style="color: black; font-size: 20px; font-family:'Cambria';">
                                <?php echo $_SESSION['username']; ?>
                            </strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

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

            // Fetch member data using the fetchData function
            $membersData = fetchData($conn, 'members');
            ?>

            <!-- Main Content -->
            <div class="col-12 col-xl-10">
                <div class="col mt-4">
                    <h1 class="mb-4 text-uppercase fw-bolder">Client Information</h1>
                    <hr>
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-control" type="text" id="searchInput" placeholder="Search...">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#addMemberModal">
                        Add Members
                    </button>

                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table style="background-color: whitesmoke;" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Age</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Certification</th>
                                            <th>Timestamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($membersData as $member) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $member['id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $member['fullname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $member['age']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $member['phone']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $member['address']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $certificationPath = $member['certification'];
                                                    if (file_exists($certificationPath)) {
                                                        ?>
                                                        <img src="<?= $certificationPath; ?>" alt="Certification Image"
                                                            class="img-fluid" width="100" height="100">
                                                        <br>
                                                        <a href="<?= $certificationPath; ?>" download>
                                                            <?= $member['certification']; ?>
                                                        </a>
                                                    <?php } else { ?>
                                                        Certification not found
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php echo $member['timestamp']; ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#editMemberModal<?php echo $member['id']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="info_delete.php?id=<?php echo $member['id']; ?>"
                                                        class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>

                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="generatePDF(<?php echo $member['id']; ?>)">

                                                        <i class="fas fa-print"></i>
                                                    </button>
                                                </td>


                                            </tr>
                                        <?php } ?>
                                        <script>
                                            function generatePDF(memberId) {
                                                // Pass the member's ID to the PDF generation script
                                                window.open('generate_pdf.php?id=' + memberId, '_blank');
                                            }

                                        </script>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Member Modals -->
            <?php foreach ($membersData as $member) { ?>
                <div class="modal fade" id="editMemberModal<?= $member['id'] ?>" tabindex="-1"
                    aria-labelledby="editMemberModalLabel<?= $member['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form method="POST" action="info_edit.php">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editMemberModalLabel<?= $member['id'] ?>">Edit Member
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <input type="hidden" name="member_id" value="<?= $member['id'] ?>">
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Full Name:</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname"
                                            value="<?= $member['fullname'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="age" class="form-label">Age:</label>
                                        <input type="number" class="form-control" id="age" name="age"
                                            value="<?= $member['age'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Mobile Number:</label>
                                        <input type="number" class="form-control" id="phone" name="phone"
                                            value="<?= $member['phone'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address:</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="<?= $member['address'] ?>" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="editMember">Save Changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>


            <!-- Add Result Modal -->
            <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bolder" id="addMemberModalLabel">Add Members</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full Name:</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                                </div>
                                <div class="mb-3 w-100">
                                    <label for="startDate" class="form-label">Birthdate</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="startDate" name="startDate">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Mobile Number:</label>
                                    <input type="number" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addMembers">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['addMembers'])) {
        // Establish a database connection
        $conn = new mysqli("localhost", "root", "", "stoninodb");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $fullname = $_POST['fullname'];
        $birthdate = $_POST['startDate'];
        $age = calculateAge($birthdate); // Calculate age from birthdate
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $sql = "INSERT INTO `members` (`fullname`, `age`, `phone`, `address`, `timestamp`) VALUES ('$fullname', $age, '$phone', '$address', NOW())";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New member added successfully.'); window.location.href='info.php';</script>";
        } else {
            echo "<script>alert('Error adding new member: " . $conn->error . "'); window.location.href='info.php';</script>";
        }

        // Close the database connection
        $conn->close();
    }

    // Function to calculate age from birthdate
    function calculateAge($birthdate)
    {
        $birthDate = new DateTime($birthdate);
        $today = new DateTime();
        $age = $birthDate->diff($today);
        return $age->y;
    }
    ?>

</body>
<!-- Include the necessary JavaScript file -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById("searchInput").addEventListener("input", function () {
        const searchText = this.value.toLowerCase();
        const tableRows = document.querySelectorAll(".table tbody tr");

        // Loop through table rows to show/hide based on search input
        tableRows.forEach(row => {
            const rowData = row.textContent.toLowerCase();
            if (rowData.includes(searchText)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>

</html>