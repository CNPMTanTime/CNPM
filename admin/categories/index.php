<?php include '../header.php'?>
<?php
    $q = trim($_GET['q'] ?? '');

    $sql = 'SELECT * FROM categories';

    if ($q !== '') {
        $q_safe = addslashes($q);
        $sql .= " WHERE category_name LIKE '%{$q_safe}%'";
    }

    $categoryList = SQLQuery::GetData($sql);
?>
<?php
    if (isset($_GET['del-id'])) {
        $delId = intval($_GET['del-id']);

        SQLQuery::NonQuery("DELETE FROM categories WHERE category_id = {$delId}");

        header('Location: /admin/categories/');
        exit;
    }
?>

<div class="dashboard-body">
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="/" class="text-gray-200 fw-normal text-15 hover-text-main-600">Trang chủ</a></li>
            <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
            <li><a href="/admin/categories" class="text-main-600 fw-normal text-15">Loại món</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-16 border-bottom border-gray-100 d-flex align-items-center justify-content-between">
                    <a href="/admin/categories/add.php" class="btn btn-main rounded-pill py-7 flex-align gap-4 fw-normal">
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
                                <th scope="col">Mã thể loại</th>
                                <th scope="col">Tên thể loại</th>
                                <th width="200">Công cụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categoryList as $item) {?>
                            <tr>
                                <th><?=$item['category_id']?></th>
                                <td><?=$item['category_name']?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-4">
                                        <a href="/admin/categories/edit.php?id=<?=$item['category_id']?>" class="btn btn-warning rounded-pill py-7 flex-align gap-4 fw-normal">
                                            <span class="d-flex text-md">
                                                <i class="ph ph-pencil"></i>
                                            </span>
                                            <span>Sửa</span>
                                        </a>
                                        <div onclick="removeRow(<?=$item['category_id']?>)" class="btn btn-danger rounded-pill py-7 flex-align gap-4 fw-normal">
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