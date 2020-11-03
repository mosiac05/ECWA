<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
    
        <!-- Start app top navbar -->
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <!-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> -->
                </ul>
                <!-- <div class="search-element">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </div> -->
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="avatar.png" src="../images/avatar.png" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $dbConfig->getUserFullName(); ?></div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <div class="dropdown-title">Logged in 5 min ago</div> -->
                        <a href="../index.php?profile" class="dropdown-item has-icon"><i class="far fa-user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="index.php?logout" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Start main left sidebar menu -->
        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="index.php">ECWA Goodnews Church </a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="index.php">EGC</a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">Dashboard</li>
                    <li class="<?php if(isset($_GET['dashboard'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?dashboard"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

                    <li class="<?php if(isset($_GET['banners']) || isset($_GET['banner_edit'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?banners"><i class="fas fa-th-large"></i> <span>Banners</span></a></li>

                    <li class="<?php if(isset($_GET['announcement']) || isset($_GET['announcement_edit'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?announcement"><i class="fas fa-bullhorn"></i> <span>Announcements</span></a></li>

                    <li class="<?php if(isset($_GET['services']) || isset($_GET['service_edit'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?services"><i class="fas fa-spinner"></i> <span>Services</span></a></li>

                    <li class="<?php if(isset($_GET['events']) || isset($_GET['event_edit'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?events"><i class="fas fa-calendar"></i> <span>Events</span></a></li>

                    <li class="<?php if(isset($_GET['programs']) || isset($_GET['program_edit'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?programs"><i class="fas fa-calendar-check"></i> <span>Programs</span></a></li>

                    <li class="<?php if(isset($_GET['zones']) || isset($_GET['zone_edit'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?zones"><i class="fas fa-map-signs"></i> <span>Zones</span></a></li>

                    <li class="<?php if(isset($_GET['bible_quotes']) || isset($_GET['bible_quote_edit'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?bible_quotes"><i class="fas fa-quote-left"></i> <span>Bible Quotes</span></a></li>

                    <li class="<?php if(isset($_GET['ministries']) || isset($_GET['ministry_edit'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?ministries"><i class="fas fa-university"></i> <span>Ministries</span></a></li>

                    <li class="<?php if(isset($_GET['board_members']) || isset($_GET['board_member_edit'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?board_members"><i class="fas fa-balance-scale"></i> <span>Board Members</span></a></li>

                    <li class="menu-header">Sermons</li>
                        <li class="<?php if(isset($_GET['categories']) || isset($_GET['category_edit'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?categories"><i class="fas fa-th-list"></i> <span>Categories</span></a></li>

                        <li class="dropdown <?php if(isset($_GET['sermons']) || isset($_GET['sermon_create']) || isset($_GET['sermon_edit']) || isset($_GET['sermon_single']) || isset($_GET['sermon_delete'])) { echo 'active'; } ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i> <span>Sermon</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="index.php?sermon_create">Add New</a></li>
                                <li><a class="nav-link" href="index.php?sermons">View All</a></li>
                            </ul>
                        </li>

                    <?php if ($dbConfig->checkUserIsAdmin()): ?>
                    <li class="menu-header">Contacts</li>
                    <li class="<?php if(isset($_GET['about_us'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?about_us"><i class="fas fa-info-circle"></i> <span>About Us</span></a></li>

                    <li class="<?php if(isset($_GET['contacts'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?contacts"><i class="fas fa-envelope"></i> <span>Contact Messages</span></a></li>
                                 
                    <li class="menu-header">Staff Accounts</li>
                    <li><a href="staff_register.php" class="nav-link"><i class="fas fa-plus"></i> <span>Register New Staff</span></a></li>

                    <li class="<?php if(isset($_GET['staffs'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?staffs"><i class="fas fa-users"></i> <span>View All</a></span></li>

                    <li class="menu-header">Admin Accounts</li>
                    <li><a class="nav-link" href="staff_register.php?admin_register"><i class="fas fa-plus"></i><span>Register New Admin</span></a></li>
                    
                    <li class="<?php if(isset($_GET['admins'])) { echo 'active'; } ?>"><a class="nav-link" href="index.php?admins"><i class="fas fa-user-secret"></i><span>View All</span></a></li>
                    <?php endif ?>
                </ul>
                <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                    <a href="index.php?logout" class="btn btn-primary btn-lg btn-block btn-icon-split"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </aside>
        </div>
