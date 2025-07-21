<?php include 'header.php'; ?>
<?php
    $id = $_GET['id'] ?? '';

    $food = SQLQuery::GetData("SELECT * FROM foods LEFT JOIN users ON foods.user_id = users.user_id WHERE food_id = {$id}")[0];
    $foodList = SQLQuery::GetData("SELECT * FROM foods LEFT JOIN users ON foods.user_id = users.user_id WHERE food_id = {$food['food_id']} AND food_id != {$id}");

    $favoriteFoods = [];

    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['user_id'];
        $favoriteFoods = SQLQuery::GetData("SELECT * FROM favorite_foods WHERE user_id = '$userId' AND food_id = '$id'");
    }
?>

<div class="uk-container">
    <div data-uk-grid>
        <div class="uk-width-1-2@s">
            <div><img class="uk-border-rounded-large" src="<?=$food['thumbnail']?>" alt="Image alt" style="aspect-ratio: 3/2; object-fit: cover; width: 100%;"></div>
        </div>
        <div class="uk-width-expand@s uk-flex uk-flex-middle">
            <div>
                <h1><?=$food['food_name']?></h1>
                <p><?=$food['description']?></p>
                <div class="uk-margin-medium-top uk-child-width-expand uk-text-center uk-grid-divider" data-uk-grid>
                    <div>
                        <span data-uk-icon="icon: users; ratio: 1.4"></span>
                        <h5 class="uk-text-500 uk-margin-small-top uk-margin-remove-bottom">Tác giả</h5>
                        <span class="uk-text-small"><?=$food['username']?></span>
                    </div>
                    <div>
                        <span data-uk-icon="icon: clock; ratio: 1.4"></span>
                        <h5 class="uk-text-500 uk-margin-small-top uk-margin-remove-bottom">Thời gian chuẩn bị</h5>
                        <span class="uk-text-small"><?=$food['preparation_time']?> phút</span>
                    </div>
                    <div>
                        <span data-uk-icon="icon: future; ratio: 1.4"></span>
                        <h5 class="uk-text-500 uk-margin-small-top uk-margin-remove-bottom">Tổng thời gian</h5>
                        <span class="uk-text-small"><?=$food['total_minute']?> phút</span>
                    </div>
                </div>
                <hr>
                <div data-uk-grid>
                    <div class="uk-width-auto@s uk-text-small"></div>
                    <div class="uk-width-expand@s uk-flex uk-flex-middle uk-flex-right@s">
                        <?php
                            $currentUrl = urlencode($_SERVER['REQUEST_URI']);
                        ?>
<?php if (count($favoriteFoods) > 0) {?>
                        <span>Đã yêu thích</span>
                        <a href="/unfavorite.php?food_id=<?=$food['food_id']?>&url=<?=$currentUrl?>" class="uk-icon-link" data-uk-icon="icon: heart; ratio: 1.2" style="color: #ED4B35;" data-uk-tooltip="title: Huỷ bỏ yêu thích"></a>
                        <?php } else {?>
                        <a href="/favorite.php?food_id=<?=$food['food_id']?>&url=<?=$currentUrl?>" class="uk-icon-link" data-uk-icon="icon: heart; ratio: 1.2" data-uk-tooltip="title: Thêm vào yêu thích"></a>
                        <?php }?>
                        <a href="#" class="uk-icon-link uk-margin-left" data-uk-icon="icon: print; ratio: 1.2" data-uk-tooltip="title: In bài viết nấu ăn" onclick="window.print(); return false;"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="uk-section uk-section-default">
    <div class="uk-container uk-container-small">
        <div class="uk-grid-large" data-uk-grid>
            <div class="uk-width-expand@m">
                <div class="uk-article">
                    <h3>Quy trình chế biến</h3>
                    <div><?=$food['content']?></div>
                    <hr class="uk-margin-medium-top uk-margin-large-bottom">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="uk-section uk-section-muted">
    <div class="uk-container">
        <h3>Cùng món ăn của tác giả khác</h3>
        <div class="uk-child-width-1-2 uk-child-width-1-3@s" data-uk-grid>
            <?php foreach ($foodList as $item) {?>
            <div>
                <div class="uk-card">
                    <div class="uk-card-media-top uk-inline uk-light">
                        <img class="uk-border-rounded-medium" src="<?=$item['thumbnail']?>" alt="<?=$item['food_name']?>" style="aspect-ratio: 3/2; object-fit: cover; width: 100%;">
                        <div class="uk-position-cover uk-card-overlay uk-border-rounded-medium"></div>
                    </div>
                    <div>
                        <h3 class="uk-card-title uk-text-500 uk-margin-small-bottom uk-margin-top"><?=$item['food_name']?></h3>
                        <div class="uk-text-xsmall uk-text-muted" data-uk-grid>
                            <div class="uk-width-expand uk-text-right">Tác giả: <?=$item['username']?></div>
                        </div>
                    </div>
                    <a href="/detail.php?id=<?=$item['food_id']?>" class="uk-position-cover"></a>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<?php include 'footer.php'?>