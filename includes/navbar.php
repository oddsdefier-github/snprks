<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <img class="sidebar-brand" src="img/logo.png" alt="Logo">
        </div>
        <div class="sidebar-brand-text mx-3">Welcome!</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Interface Heading -->
    <div class="sidebar-heading">Interface</div>

    <!-- Nav Item - Schedule Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSchedule"
            aria-expanded="true" aria-controls="collapseSchedule">
            <i class="bi bi-calendar-fill"></i>
            <span>Schedule</span>
        </a>
        <div id="collapseSchedule" class="collapse" aria-labelledby="headingSchedule" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Components</h6>
                <a class="collapse-item" href="calendar.php">Calendar</a>
                <a class="collapse-item" href="schedules.php">Schedule List</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Sacraments Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSacraments"
            aria-expanded="true" aria-controls="collapseSacraments">
            <i class='fas fa-church'></i>
            <span>Sacraments</span>
        </a>
        <div id="collapseSacraments" class="collapse" aria-labelledby="headingSacraments"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Records</h6>
                <a class="collapse-item" href="baptism.php">Baptism</a>
                <a class="collapse-item" href="confirmation.php">Confirmation</a>
                <a class="collapse-item" href="marriage.php">Marriage</a>
                <a class="collapse-item" href="conversion.php">Conversion</a>
                <a class="collapse-item" href="death.php">Death Records</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Donation -->
    <li class="nav-item">
        <a class="nav-link" href="donation.php">
            <i class='fas fa-coins'></i>
            <span>Donation</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Client Info History -->
    <li class="nav-item">
        <a class="nav-link" href="client.php">
            <i class='fas fa-history'></i>
            <span>Client Info. History</span>
        </a>
    </li>

    <!-- Nav Item - Admin Account -->
    <li class="nav-item">
        <a class="nav-link" href="account.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Admin Account</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggle Button -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook"
            viewBox="0 0 16 16">
            <path
                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
        </svg>
        <p class="mb-2">
            <a target="_blank" rel="nofollow" href="https://www.facebook.com/stoninoparishroxas"> Sto. Niño Parish
                Facebook Page </a>
        </p>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Scroll to Top Button -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logging out?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to end your current session?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>