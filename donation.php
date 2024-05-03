<?php
session_start();
$title = "dashboard";
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/scripts.php';

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search Display Only-->
            <input class="form-control" type="text" placeholder="                                                                                  
        Sto. Niño Parish Record-Keeping Information System" aria-label="Disabled input example" disabled readonly>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input class="form-control" type="text" id="searchInput" placeholder="Search for...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                </li>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 large">Mary Rose</span>
                        <img class="img-profile rounded-circle mr-2" src="img/logo.png">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profile.php">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-500"></i>
                            Profile
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-500"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>
        </nav>

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
        $paymentsData = fetchData($conn, 'payments');
        ?>

        <!-- Main Content -->
        <div class="col-12 col-xl-12">
            <div class="col mt-4">
                <h1 class="mb-4 text-uppercase fw-bolder">Donation</h1>
                <hr>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#addPaymentsModal">
                    Add Donation
                </button>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table style="background-color: white" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fullname</th>
                                        <th>Address</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Contributions</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($paymentsData as $payment) { ?>
                                    <?php
                                        $dateTime = new DateTime($payment['payment_date']);
                                        $formattedDate = $dateTime->format('M d, Y');

                                        $formattedAmount = '₱' . number_format($payment['amount'], 2, '.', ',');
                                        ?>

                                    <tr>
                                        <td><?php echo $payment['id']; ?></td>
                                        <td><?php echo $payment['fullname']; ?></td>
                                        <td><?php echo $payment['address']; ?></td>
                                        <td><?php echo $formattedAmount; ?></td>
                                        <td><?php echo $formattedDate; ?></td>
                                        <td><?php echo $payment['contributions']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editPaymentModal<?php echo $payment['id']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <button type="button" class="btn btn-secondary"
                                                onclick="generatePDF(<?php echo $payment['id']; ?>)">
                                                <i class="fas fa-print"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <script>
                                    function generatePDF(paymentId) {
                                        // Open a new window to trigger the PDF generation script
                                        window.open('generate_paymentpdf.php?payment_id=' + paymentId, '_blank');
                                    }
                                    </script>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Edit Payment Modals -->
                    <?php foreach ($paymentsData as $payment) { ?>
                    <div class="modal fade" id="editPaymentModal<?= $payment['id'] ?>" tabindex="-1"
                        aria-labelledby="editPaymentModalLabel<?= $payment['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form action="" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPaymentModalLabel<?= $payment['id'] ?>">
                                                Edit Donation
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <input type="hidden" name="payment_id" value="<?= $payment['id'] ?>">
                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Full Name:</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname"
                                                value="<?= $payment['fullname'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address:</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="<?= $payment['address'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount:</label>
                                            <input type="number" class="form-control" id="amount" name="amount"
                                                value="<?= $payment['amount'] ?>" step="0.01" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="payment_date" class="form-label">Date:</label>
                                            <input type="date" class="form-control" id="payment_date"
                                                name="payment_date" value="<?= $payment['payment_date'] ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="contributions" class="form-label">Contributions:</label>
                                            <input type="text" class="form-control" id="contributions"
                                                name="contributions" value="<?= $payment['contributions'] ?>" readonly>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="editDonation">Save
                                        Changes</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <?php
                    if (isset($_POST['editDonation'])) {
                        $payment_id = isset($_POST['payment_id']) ? intval($_POST['payment_id']) : 0;
                        $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
                        $address = isset($_POST['address']) ? trim($_POST['address']) : '';

                        if (empty($fullname) || empty($address) || $payment_id === 0) {
                            echo "<script>alert('Invalid data. Please ensure all fields are filled.'); window.location.href = 'donation.php';</script>";
                            exit();
                        }

                        $sql = "UPDATE `payments` SET `fullname` = ?, `address` = ? WHERE `id` = ?";
                        $stmt = $conn->prepare($sql);

                        if ($stmt === false) {
                            echo "<script>alert('Error preparing SQL statement.'); window.location.href = 'donation.php';</script>";
                            exit();
                        }

                        $stmt->bind_param("ssi", $fullname, $address, $payment_id);

                        if ($stmt->execute()) {
                            echo "<script>
                                            alert('Payment record updated successfully.');
                                            window.location.href = 'donation.php';
                                        </script>";
                            exit();
                        } else {
                            echo "<script>
                                            alert('Error updating payment record: {$stmt->error}.');
                                            window.location.href = 'donation.php';
                                        </script>";
                            exit();
                        }
                    }
                    ?>

                    <!-- Add Payments Modal -->
                    <div class="modal fade" id="addPaymentsModal" tabindex="-1" aria-labelledby="addPaymentsModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bolder" id="addPaymentsModalLabel">Add Donation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Full Name:</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address:</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount:</label>
                                            <input type="number" class="form-control" id="amount" name="amount"
                                                step="0.01" required>
                                        </div>
                                        <!-- <div class="mb-3">
                                                <label for="payment_date" class="form-label">Payment Date:</label>
                                                <input type="date" class="form-control" id="payment_date"
                                                    name="payment_date" required>
                                            </div> -->
                                        <div class="mb-3">
                                            <label for="contributions" class="form-label">Contributions:</label>
                                            <select class="form-select" id="contributions" name="contributions"
                                                required>
                                                <option value="Mass">Mass /Misa</option>
                                                <option value="Blessing">Blessing</option>
                                                <option value="Christening">Christening /Binyag</option>
                                                <option value="Communion">Communion /Komunyon</option>
                                                <option value="Kumpil">Confirmation /Kumpil</option>
                                                <option value="Marriage">Marriage /Kasal</option>
                                                <option value="Conversion">Conversion /Konbersiyon</option>
                                                <option value="Funeral">Funeral /Libing</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="addPayments">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_POST['addPayments'])) {
                $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
                $address = isset($_POST['address']) ? trim($_POST['address']) : '';
                $amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
                $contributions = isset($_POST['contributions']) ? trim($_POST['contributions']) : '';

                $sql = "INSERT INTO `payments` (`fullname`, `address`, `amount`, `payment_date`, `contributions`) VALUES (?, ?, ?, CURRENT_DATE, ?)";
                $stmt = $conn->prepare($sql);

                // Check if the statement preparation succeeded
                if ($stmt === false) {
                    echo "<script>alert('Error preparing SQL statement.');</script>";
                    header('Location: donation.php');
                    exit();
                }

                $stmt->bind_param("ssds", $fullname, $address, $amount, $contributions);

                if ($stmt->execute()) {
                    echo "<script>
                                    alert('New payment added successfully.');
                                    window.location.href = 'donation.php';
                                  </script>";
                    exit();
                } else {
                    echo "<script>
                                    alert('Error adding new payment: {$stmt->error}.');
                                    window.location.href = 'donation.php';
                                  </script>";
                    exit();
                }
            }
            ?>

            </body>
            <!-- Include the necessary JavaScript file -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous">
            </script>


            </html>