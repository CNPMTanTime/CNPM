<?php
    ob_start();
    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: /sign-in.php');
        exit;
    }
?>
<?php include '../../config/SQLQuery.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Món ăn</title>
    <link type="image/png" href="/template/img/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../template/admin/css/bootstrap.min.css">
    <!-- file upload -->
    <link rel="stylesheet" href="../../template/admin/css/file-upload.css">
    <!-- file upload -->
    <link rel="stylesheet" href="../../template/admin/css/plyr.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- full calendar -->
    <link rel="stylesheet" href="../../template/admin/css/full-calendar.css">
    <!-- jquery Ui -->
    <link rel="stylesheet" href="../../template/admin/css/jquery-ui.css">
    <!-- editor quill Ui -->
    <link rel="stylesheet" href="../../template/admin/css/editor-quill.css">
    <!-- apex charts Css -->
    <link rel="stylesheet" href="../../template/admin/css/apexcharts.css">
    <!-- calendar Css -->
    <link rel="stylesheet" href="../../template/admin/css/calendar.css">
    <!-- jvector map Css -->
    <link rel="stylesheet" href="../../template/admin/css/jquery-jvectormap-2.0.5.css">
    <!-- Tiny MCE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/plugins/table/ui/trumbowyg.table.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="../../template/admin/css/main.css">
</head>

<body>
    <div class="preloader">
        <div class="loader"></div>
    </div>

    <div class="side-overlay"></div>

    <aside class="sidebar">
        <button type="button" class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute"><i
                class="ph ph-x"></i></button>

        <a href="/" class="sidebar__logo d-flex align-items-center justify-content-center text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
            <img style="width: 40px" src="../../template/img/favicon.png" alt="Logo">
            <div class="font-bold ms-4 fs-5 text-dark">Thái</div>
        </a>

        <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
            <div class="p-20 pt-10">
                <ul class="sidebar-menu">
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                    <li class="sidebar-menu__item">
                        <a href="/admin/categories" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-cube"></i></span>
                            <span class="text">Thể loại</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="/admin/foods" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-cooking-pot"></i></span>
                            <span class="text">Món ăn</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="/admin/users" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-users"></i></span>
                            <span class="text">Tài khoản</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="sidebar-menu__item">
                        <a href="/admin/favorite" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-heart"></i></span>
                            <span class="text">Yêu thích của tôi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>

    <div class="dashboard-main-wrapper">
        <div class="top-navbar flex-between gap-16">
            <div class="flex-align gap-16"></div>

            <div class="flex-align gap-16">
                <div class="dropdown">
                    <button class="users arrow-down-icon border border-gray-200 rounded-pill p-4 d-inline-block pe-40 position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="position-relative">
                            <img src="../../template/img/favicon.png" alt="Image" class="h-32 w-32 rounded-circle">
                            <span class="activation-badge w-8 h-8 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                        <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                            <div class="card-body">
                                <?php if (isset($_SESSION['user'])): ?>
                                <div class="flex-align gap-8 mb-20 pb-20">
                                    <img src="../../template/img/favicon.png" alt="" class="w-54 h-54 rounded-circle">
                                    <div>
                                        <h4 class="mb-0"><?=htmlspecialchars($_SESSION['user']['username'])?></h4>
                                        <p class="fw-medium text-13 text-gray-200"><?=htmlspecialchars($_SESSION['user']['email'])?></p>
                                    </div>
                                </div>
                                <ul class="max-h-270 overflow-y-auto scroll-sm pe-4">
                                    <li class="pt-8 border-top border-gray-100">
                                        <a href="/logout.php" class="py-12 text-15 px-20 hover-bg-danger-50 text-gray-300 hover-text-danger-600 rounded-8 flex-align gap-8 fw-medium text-15">
                                            <span class="text-2xl text-danger-600 d-flex"><i class="ph ph-sign-out"></i></span>
                                            <span class="text">Đăng xuất</span>
                                        </a>
                                    </li>
                                </ul>
                                <?php else: ?>
                                <p class="text-center text-muted">Chưa đăng nhập</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>