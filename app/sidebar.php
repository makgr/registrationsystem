<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
               
                <?php
                if (Session::get("user_type") == '1') {
                    ?>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">User Management</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="add-staff.php" class="sidebar-link"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Add user</span></a></li>
                            <li class="sidebar-item"><a href="manage-staff.php" class="sidebar-link"><i class="mdi mdi-account-location"></i><span class="hide-menu">Manage User</span></a></li>

                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">Course</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="add-course.php" class="sidebar-link"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Add Course</span></a></li>
                            <li class="sidebar-item"><a href="manage-course.php" class="sidebar-link"><i class="mdi mdi-account-location"></i><span class="hide-menu">Manage Course</span></a></li>

                        </ul>
                    </li>
                   
                <?php } ?>
                <?php
                if (Session::get("user_type") == '3') {
                    ?>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">Course Offer</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="offer-course.php" class="sidebar-link"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Offer Course</span></a></li>
                            <li class="sidebar-item"><a href="offer-list.php" class="sidebar-link"><i class="mdi mdi-account-location"></i><span class="hide-menu">Offered List</span></a></li>
                            <li class="sidebar-item"><a href="expired-offer-list.php" class="sidebar-link"><i class="mdi mdi-account-location"></i><span class="hide-menu">Expired Offered List</span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">Registration Info</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="pending-registration.php" class="sidebar-link"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Pending</span></a></li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">Student</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="student-list.php" class="sidebar-link"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Student List</span></a></li>
                        </ul>
                    </li>
                    <?php
                       if (Session::get("user_type") == '2') {
                    ?>
                             <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">Registration Info</span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="pending-registration.php" class="sidebar-link"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Pending</span></a></li>
                                </ul>
                            </li>
                    <?php } ?>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
