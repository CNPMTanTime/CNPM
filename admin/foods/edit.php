<?php include '../header.php'; ?>

<?php
    $categoryList = SQLQuery::GetData('SELECT * FROM categories');
    $food_id = intval($_GET['id'] ?? 0);

    $currentFood = SQLQuery::GetData("SELECT * FROM foods WHERE food_id = {$food_id}");
    if (!$currentFood) {
        echo "<div class='alert alert-danger'>Món ăn không tồn tại.</div>";
        exit;
    }
    $currentFood = $currentFood[0];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['food_name'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $category_id = intval($_POST['category_id'] ?? 0);
        $description = trim($_POST['description'] ?? '');
        $preparation_time = intval($_POST['preparation_time'] ?? 0);
        $total_minute = intval($_POST['total_minute'] ?? 0);

        $image_path = $currentFood['thumbnail'];

        if (!empty($_FILES['thumbnail']['tmp_name'][0])) {
            $uploadDir = '../../uploads/';
            $filename = basename($_FILES['thumbnail']['name'][0]);
            $targetFile = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'][0], $targetFile)) {
                $image_path = '/uploads/' . $filename;
            } else {
                echo "<div class='alert alert-danger'>Upload ảnh thất bại.</div>";
            }
        }

        if ($name === '' || $content === '' || $category_id <= 0) {
            echo "<div class='alert alert-warning'>Vui lòng điền đầy đủ thông tin.</div>";
        } else {
            $sql = "
                UPDATE foods SET
                    food_name = '" . addslashes($name) . "',
                    content = '" . addslashes($content) . "',
                    category_id = {$category_id},
                    thumbnail = " . ($image_path ? "'{$image_path}'" : 'NULL') . ",
                    description = '" . addslashes($description) . "',
                    preparation_time = {$preparation_time},
                    total_minute = {$total_minute}
                WHERE food_id = {$food_id}
            ";

            $affected = SQLQuery::NonQuery($sql);
            if ($affected !== false) {
                echo "<div class='alert alert-success'>Cập nhật món ăn thành công!</div>";
                header('Location: /admin/foods/');
                exit;
            } else {
                echo "<div class='alert alert-danger'>Không thể cập nhật. Vui lòng thử lại.</div>";
            }
        }
    }
?>

<div class="dashboard-body">
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="/" class="text-gray-200 fw-normal text-15 hover-text-main-600">Trang chủ</a></li>
            <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
            <li><a href="/admin/foods" class="text-gray-200 fw-normal text-15 hover-text-main-600">Món ăn</a></li>
            <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
            <li><a href="#" class="text-main-600 fw-normal text-15">Chỉnh sửa</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="row gy-20">
                            <div class="col-xxl-3 col-md-4 col-sm-5">
                                <div class="mb-20">
                                    <label class="h5 fw-semibold font-heading mb-0">Hình ảnh</label>
                                </div>
                                <div id="fileUpload" class="fileUpload image-upload">
                                    <?php if (!empty($currentFood['thumbnail'])): ?>
                                    <img src="<?=htmlspecialchars($currentFood['thumbnail'])?>" alt="Ảnh món ăn" class="img-thumbnail mb-2" style="max-width: 100%;">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-xxl-9 col-md-8 col-sm-7">
                                <div class="row g-20">
                                    <div class="col-sm-12">
                                        <label class="h5 mb-8 fw-semibold font-heading">Tên món ăn</label>
                                        <input name="food_name" type="text" value="<?=htmlspecialchars($currentFood['food_name'])?>" class="form-control py-11 pe-76">
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="h5 mb-8 fw-semibold font-heading">Thể loại</label>
                                        <select class="form-select py-9 placeholder-13 text-15" name="category_id">
                                            <?php foreach ($categoryList as $item): ?>
                                            <option value="<?=$item['category_id']?>" <?=$item['category_id'] == $currentFood['category_id'] ? 'selected' : ''?>>
                                                <?=htmlspecialchars($item['category_name'])?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="h5 mb-8 fw-semibold font-heading">Thời gian chuẩn bị (phút)</label>
                                        <input name="preparation_time" type="number" class="form-control py-11 pe-76" value="<?=htmlspecialchars($currentFood['preparation_time'])?>">
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="h5 mb-8 fw-semibold font-heading">Tổng thời gian (phút)</label>
                                        <input name="total_minute" type="number" class="form-control py-11 pe-76" value="<?=htmlspecialchars($currentFood['total_minute'])?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label class="h5 mb-8 fw-semibold font-heading">Mô tả ngắn</label>
                                <input name="description" type="text" class="form-control py-11 pe-76" value="<?=htmlspecialchars($currentFood['description'])?>">
                            </div>

                            <div class="col-sm-12">
                                <label class="h5 mb-8 fw-semibold font-heading">Mô tả</label>
                                <textarea id="editor" name="content" class="form-control py-11 pe-76"><?=htmlspecialchars($currentFood['content'])?></textarea>
                            </div>

                            <div class="flex-align justify-content-end gap-8">
                                <a href="/admin/foods" class="btn btn-outline-main rounded-pill py-9">Huỷ</a>
                                <button type="submit" class="btn btn-main rounded-pill py-9">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'?>