<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">MI<span>DO</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#app_nav" aria-controls="app_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="app_nav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard.php"><?php echo lang('HOME_ADMIN'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="categories.php"><?php echo lang('CATEGORIES'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="members.php"><?php echo lang('MEMBERS'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="items.php"><?php echo lang('ITEMS'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="comments.php"><?php echo lang('COMMENTS'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"><?php echo lang('STATISTICS'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"><?php echo lang('LOGS'); ?></a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown justify-content-end float-end">
                    <a class="nav-link User_name active dropdown-toggle  me-2 justify-content-end float-end" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ahmed
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="members.php?do=Edit&userId=<?php echo $_SESSION['ID']; ?>">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="../index.php">Shop</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">LOG Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>