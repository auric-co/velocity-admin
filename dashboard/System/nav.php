<!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo">
                <a href="<?php echo $sys->domain() ?>/dashboard/">
                    <img src="<?php echo $sys->domain() ?>/dashboard/images/icons/logo.png" width="200" alt="Velocity Health" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="<?php echo $sys->domain() ?>/dashboard/images/<?php echo $sys->profile; ?>" alt="Velocity Admin" />
                    </div>
                    <h4 class="small" style="margin:20px;"><?php echo $_COOKIE['username']; ?></h4>
                    <a href="<?php echo $sys->domain() ?>/dashboard/logout.php">Sign out</a>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="active ">
                            <a  href="<?php echo $sys->domain() ?>/dashboard">
                                <i class="fas fa-tachometer-alt"></i>Home
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $sys->domain() ?>/dashboard/clients">
                                <i class="fas fa-chart-bar"></i>Companies</a>
                        </li>
                        <li>
                            <a href="<?php echo $sys->domain() ?>/dashboard/users">
                                <i class="fas fa-shopping-basket"></i>Users</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-trophy"></i>Wellness
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                
                                <li>
                                    <a href="<?php echo $sys->domain() ?>/dashboard/wellness/activities">
                                        <i class="far fa-check-square"></i>Activities</a>
                                </li>
                                <li>
                                    <a href="<?php echo $sys->domain() ?>/dashboard/wellness/classes">
                                        <i class="fas fa-table"></i>Classes</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <img src="<?php echo $sys->domain() ?>/dashboard/images/icons/logo.png" alt="Velocity Wellness" width="200"/>
                                </a>
                            </div>
                            <div class="header-button2">
                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Setting</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-money-box"></i>Billing</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-globe"></i>Change Password</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-notifications"></i>Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Mobile Menu Sidebar Start-->
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <a href="#">
                        <img src="<?php echo $sys->domain() ?>/dashboard/images/icons/logo.png" width="200" alt="logo" />
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2">
                        <div class="image img-cir img-120">
                            <img src="<?php echo $sys->domain() ?>/dashboard/images/<?php echo $sys->profile; ?>" alt="Profile" />
                        </div>
                        <h4 class="name"><?php echo $_SESSION['username'];?>   </h4>
                        <a href="<?php echo $sys->domain() ?>/dashboard/logout.php">Sign out</a>
                    </div>
                    <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <li class="active has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="/">
                                            <i class="fas fa-tachometer-alt"></i>Home</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="/clients">
                                    <i class="fas fa-chart-bar"></i>Companies</a>
                            </li>
                            <li>
                                <a href="/users">
                                    <i class="fas fa-shopping-basket"></i>Users</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-trophy"></i>Wellness 
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="<?php echo $sys->domain() ?>/dashboard/wellness/activities">
                                            <i class="fas fa-table"></i>Activities</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $sys->domain() ?>/dashboard/wellness/classes">
                                            <i class="far fa-check-square"></i>Classes</a>
                                    </li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- END Mobile Menu Sidebar-->

            <!-- END HEADER DESKTOP-->