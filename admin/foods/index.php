<?php include '../header.php'?>
<?php
    $q = trim($_GET['q'] ?? '');

    $sql = 'SELECT * FROM foods
        LEFT JOIN categories ON foods.category_id = categories.category_id';

    if ($q !== '') {
        $q_safe = addslashes($q);
        $sql .= " WHERE food_name LIKE '%{$q_safe}%'";
    }

    $foodList = SQLQuery::GetData($sql);
?>
<?php
    if (isset($_GET['del-id'])) {
        $delId = intval($_GET['del-id']);

        $food = SQLQuery::GetData("SELECT thumbnail FROM foods WHERE food_id = {$delId}");
        // if ($food && !empty($food[0]['thumbnail'])) {
        //     $filePath = '../../' . ltrim($food[0]['thumbnail'], '/');
        //     if (file_exists($filePath)) {
        //         unlink($filePath);
        //     }
        // }

        SQLQuery::NonQuery("DELETE FROM foods WHERE food_id = {$delId}");

        header('Location: /admin/foods/');
        exit;
    }
?>
<div class="dashboard-body">
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="/" class="text-gray-200 fw-normal text-15 hover-text-main-600">Trang chủ</a></li>
            <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
            <li><a href="/admin/foods" class="text-main-600 fw-normal text-15">Món ăn</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-16 border-bottom border-gray-100 d-flex align-items-center justify-content-between">
                    <a href="/admin/foods/add.php" class="btn btn-main rounded-pill py-7 flex-align gap-4 fw-normal">
                        <span class="d-flex text-md">
                            <i class="ph ph-plus"></i>
                        </span>
                        <span>Thêm mới</span>
                    </a>

                    <form class="position-relative">
                        <button type="submit" class="input-icon text-xl d-flex text-gray-100 pointer-event-none"><i class="ph ph-magnifying-glass"></i></button>
                        <input value="<?=$q?>" name="q" type="text" class="form-control ps-40 h-40 border-transparent focus-border-main-600 bg-main-50 rounded-pill placeholder-15" placeholder="Tìm kiếm...">
                    </form>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mã món ăn</th>
                                <th scope="col">Tên món ăn</th>
                                <th scope="col">Loại món</th>
                                <th width="200">Công cụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($foodList as $item) {?>
                            <tr>
                                <th>
                                    <?=$item['food_id']?>
                                </th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-3" style="height: auto; aspect-ratio: 3 / 2; width: 100px; object-fit: cover;" src="<?=$item['thumbnail']?>" alt="">
                                        <div class="ms-6"><?=$item['food_name']?></div>
                                    </div>
                                </td>
                                <td><?=$item['category_name']?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-4">
                                        <a href="/admin/foods/edit.php?id=<?=$item['food_id']?>" class="btn btn-warning rounded-pill py-7 flex-align gap-4 fw-normal">
                                            <span class="d-flex text-md">
                                                <i class="ph ph-pencil"></i>
                                            </span>
                                            <span>Sửa</span>
                                        </a>
                                        <div onclick="removeRow(<?=$item['food_id']?>)" class="btn btn-danger rounded-pill py-7 flex-align gap-4 fw-normal">
                                            <span class="d-flex text-md">
                                                <i class="ph ph-trash"></i>
                                            </span>
                                            <span>Xoá</span>
                                        </div>
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