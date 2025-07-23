<?php include '../header.php'; ?>

<?php
    $id = intval($_GET['id'] ?? 0);
    $category = null;

    if ($id > 0) {
        $category = SQLQuery::GetData("SELECT * FROM categories WHERE category_id = {$id}")[0];
        if (!$category) {
            echo "<div class='alert alert-danger'>Không tìm thấy loại món.</div>";
            include '../footer.php';
            exit;
        }
    } else {
        echo "<div class='alert alert-danger'>ID không hợp lệ.</div>";
        include '../footer.php';
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['category_name'] ?? '');

        if ($name === '') {
            echo "<div class='alert alert-warning'>Vui lòng nhập tên loại món.</div>";
        } else {
            $sql = "UPDATE categories SET category_name = '" . addslashes($name) . "' WHERE category_id = {$id}";
            $affected = SQLQuery::NonQuery($sql);

            if ($affected) {
                header('Location: /admin/categories/');
                exit;
            } else {
                echo "<div class='alert alert-danger'>Không thể cập nhật loại món. Vui lòng thử lại.</div>";
            }
        }
    }
?>

<div class="dashboard-body">
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="/" class="text-gray-200 fw-normal text-15 hover-text-main-600">Trang chủ</a></li>
            <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
            <li><a href="/admin/categories" class="text-gray-200 fw-normal text-15 hover-text-main-600">Loại món</a></li>
            <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
            <li><a href="#" class="text-main-600 fw-normal text-15">Chỉnh sửa</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="#" method="POST">
                        <div class="row gy-20">
                            <div class="col-sm-12">
                                <label class="h5 mb-8 fw-semibold font-heading">Tên loại món</label>
                                <div class="position-relative">
                                    <input name="category_name" type="text" class="placeholder-13 form-control py-11 pe-76" value="<?=htmlspecialchars($category['category_name'])?>">
                                </div>
                            </div>

                            <div class="flex-align justify-content-end gap-8">
                                <a href="/admin/categories" class="btn btn-outline-main rounded-pill py-9">Huỷ</a>
                                <button type="submit" class="btn btn-main rounded-pill py-9">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>