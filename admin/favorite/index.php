<?php include '../header.php'; ?>

<?php
    $q = trim($_GET['q'] ?? '');

    $sql = "SELECT * FROM favorite_foods LEFT JOIN foods ON favorite_foods.food_id = foods.food_id LEFT JOIN users ON foods.user_id = users.user_id WHERE favorite_foods.user_id = {$_SESSION['user']['user_id']} AND food_name LIKE '%{$q}%'";

    $favoriteList = SQLQuery::GetData($sql);
?>

<div class="dashboard-body">
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="/" class="text-gray-200 fw-normal text-15 hover-text-main-600">Trang chủ</a></li>
            <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
            <li><a href="/admin/favorite" class="text-main-600 fw-normal text-15">Yêu thích của tôi</a></li>
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
                                <th scope="col">Món ăn</th>
                                <th scope="col">Tác giả</th>
                                <th width="266">Xem nội dung</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $index = 1;
                            foreach ($favoriteList as $item) {?>
                            <tr>
                                <th><?=$index++?></th>
                                <td><?=$item['food_name']?></td>
                                <td><?=$item['username']?></td>
                                <td>
                                    <?php $currentUrl = urlencode($_SERVER['REQUEST_URI']); ?>
                                    <div class="d-flex align-items-center gap-4">
                                        <a href="/detail.php?id=<?=$item['food_id']?>" class="btn btn-info rounded-pill py-7 flex-align gap-4 fw-normal">
                                            <span class="d-flex text-md">
                                                <i class="ph ph-eye"></i>
                                            </span>
                                            <span>Xem</span>
                                        </a>
                                        <a href="/unfavorite.php?food_id=<?=$item['food_id']?>&url=<?=$currentUrl?>" class="btn btn-danger rounded-pill py-7 flex-align gap-4 fw-normal">
                                            <span class="d-flex text-md">
                                                <i class="ph ph-heart"></i>
                                            </span>
                                            <span>Bỏ yêu thích</span>
                                        </a>
                                    </div>
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