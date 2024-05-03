<?php

include 'includes/header.php';
include 'connect.php';

session_start();

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']); 
    $password = $_POST['password']; 
    if (empty($username) || empty($password)) {
        echo "<script>alert('Please enter a username and password.'); window.history.back();</script>";
        exit(); 
    }

    $stmt = $conn->prepare("SELECT * FROM account WHERE username = ?");
    $stmt->bind_param("s", $username); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the password with password_verify
        // if ($row["password"] == $password) {
        if (password_verify($password, $row['password'])) {

            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['full_name'] = $row['fullname'];
            $_SESSION['userType'] = $row['usertype'];

 
            if ($row['usertype'] === 'Admin') {
                echo "<script>
                        window.location.href = 'index.php'; // Redirect to the desired page
                      </script>";
                exit();
       
            }
            
        } else {
            echo "<script>alert('Incorrect password.'); window.history.back();</script>"; 
        }
    } else {
        echo "<script>alert('Incorrect username or password.'); window.history.back();</script>"; 
    }
}


if (isset($_SESSION['loggedin'])) {
    echo '<script>window.location.href = "index.php";</script>';
    exit;
}
?>

<body style="background: url('img/login.jpg') no-repeat center/cover;" class="vh-100 w-100">
    <div class="container pt-5">
        <div class="row justify-content-center mt-3">
            <div class="col-10 col-md-10 col-lg-5">
                <div class="card o-hidden border-0 shadow-lg mt-4">
                    <div class="card-body p-3">
                        <img src="img/logo.png" alt="Logo" class="w-25 d-flex m-auto mb-3">
                        <form action="#" method="POST">

                            <h1 class="text-center mb-4 ">Login</h1>
                            <div class="form-floating mb-3">
                                <input type="username" class="form-control" name="username" id="username"
                                    placeholder="Username" required>
                                <label for="username">Enter Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Password" required>
                                <label for="password">Enter Password</label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-user btn-block" name="submit" id="login">Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>