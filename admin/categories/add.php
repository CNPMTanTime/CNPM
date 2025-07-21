<?php include '../header.php'; ?>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['category_name'] ?? '');

        if ($name === '') {
            echo "<div class='alert alert-warning'>Vui lòng điền đầy đủ thông tin.</div>";
        } else {
            $sql = "INSERT INTO categories (category_name) VALUES ('" . addslashes($name) . "')";

            $affected = SQLQuery::NonQuery($sql);
            if ($affected) {
                echo "<div class='alert alert-success'>Thêm loại món thành công!</div>";
                header('Location: /admin/categories/');
                exit;
            } else {
                echo "<div class='alert alert-danger'>Không thể thêm loại món. Vui lòng thử lại.</div>";
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
            <li><a href="#" class="text-main-600 fw-normal text-15">Thêm</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="row gy-20">
                            <div class="col-sm-12">
                                <label class="h5 mb-8 fw-semibold font-heading">Tên loại món</label>
                                <div class="position-relative">
                                    <input name="category_name" type="text" class="placeholder-13 form-control py-11 pe-76">
                                </div>
                            </div>

                            <div class="flex-align justify-content-end gap-8">
                                <a href="/admin/categories" class="btn btn-outline-main rounded-pill py-9">Huỷ</a>
                                <button type="submit" class="btn btn-main rounded-pill py-9">Thêm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'?>