<?php include '../header.php'; ?>

<?php
    $q = trim($_GET['q'] ?? '');

    $sql = 'SELECT * FROM users';

    if ($q !== '') {
        $q_safe = addslashes($q);
        $sql .= " WHERE username LIKE '%{$q_safe}%' OR email LIKE '%{$q_safe}%'";
    }

    $userList = SQLQuery::GetData($sql);
?>

<div class="dashboard-body">
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="/" class="text-gray-200 fw-normal text-15 hover-text-main-600">Trang chủ</a></li>
            <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
            <li><a href="/admin/users" class="text-main-600 fw-normal text-15">Tài khoản</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-16 border-bottom border-gray-100 d-flex align-items-center justify-content-between">
                    <!-- <a href="/admin/users/add.php" class="btn btn-main rounded-pill py-7 flex-align gap-4 fw-normal">
                        <span class="d-flex text-md">
                            <i class="ph ph-plus"></i>
                        </span>
                        <span>Thêm mới</span>
                    </a> -->
                    <div></div>

                    <form class="position-relative">
                        <button type="submit" class="input-icon text-xl d-flex text-gray-100 pointer-event-none"><i class="ph ph-magnifying-glass"></i></button>
                        <input value="<?=$q?>" name="q" type="text" class="form-control ps-40 h-40 border-transparent focus-border-main-600 bg-main-50 rounded-pill placeholder-15" placeholder="Tìm kiếm...">
                    </form>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tài khoản</th>
                                <th scope="col">Email</th>
                                <th scope="col">Vai trò</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $index = 1;
                            foreach ($userList as $item) {?>
                            <tr>
                                <th><?=$index++?></th>
                                <td><?=$item['username']?></td>
                                <td><a href="mailto:<?=htmlspecialchars($item['email'])?>"><?=htmlspecialchars($item['email'])?></a></td>
                                <td>
                                    <?php if ($item['role'] == 'admin') {?>
                                    <span class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                        <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                        Admin
                                    </span>
                                    <?php } else {?>
                                    <span class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                        <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                                        Người dùng
                                    </span>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'?>