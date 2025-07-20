<?php include 'header.php'?>
<?php
    $categoryList = SQLQuery::GetData('SELECT * FROM categories');

    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;

    $q = $_GET['q'] ?? '';
    $search = '%' . $q . '%';

    $sql = 'SELECT foods.*, categories.category_id AS cat_id, categories.category_name
        FROM foods
        LEFT JOIN categories ON foods.category_id = categories.category_id
        WHERE food_name LIKE :q';

    $foodPagination = SQLQuery::GetDataWithPagination($sql, $page, 12, [':q' => $search]);
    $foodList = $foodPagination['data'];
    $totalPages = $foodPagination['page_number'];
    $currentPage = $page;
?>

<div class="uk-container">
    <div class="uk-border-rounded-large uk-background-top-center uk-background-cover
    uk-background-norepeat uk-light uk-inline uk-overflow-hidden uk-width-1-1" style="background-image: url(https://html-theme-kocina.vercel.app/img/header.jpg);">
        <div class="uk-position-cover uk-header-overlay"></div>
        <div class="uk-position-relative" data-uk-grid>
            <div class="uk-width-1-2@m uk-flex uk-flex-middle">
                <div class="uk-padding-large uk-padding-remove-right">
                    <h1 class="uk-heading-small uk-margin-remove-top">
                        hãy cùng lưu lại công thức nấu ăn
                    </h1>
                    <p class="uk-text-secondary">Hàng ngàn món ăn hấp dẫn, dễ làm và phù hợp với mọi khẩu vị. Cùng bạn tạo nên những bữa ăn ngon miệng mỗi ngày!</p>
                    <a class="uk-text-secondary uk-text-600 uk-text-small hvr-forward" href="sign-up.php">Đăng ký ngay<span class="uk-margin-small-left" data-uk-icon="arrow-right"></span></a>
                </div>
            </div>
            <div class="uk-width-expand@m">
            </div>
        </div>
    </div>
</div>

<div class="uk-section uk-section-default">
    <div class="uk-container">
        <div data-uk-grid>
            <div class="uk-width-1-4@m sticky-container">
                <div data-uk-sticky="offset: 100; bottom: true; media: @m;">
                    <h2>Công Thức Nấu Ăn</h2>
                    <ul class="uk-nav-default uk-nav-parent-icon uk-nav-filter uk-margin-medium-top" data-uk-nav>
                        <li class="uk-parent uk-open">
                            <a href="#">Loại Món</a>
                            <ul class="uk-nav-sub">
                                <?php foreach ($categoryList as $item) {?>
                                <li><a href="/search.php?cat=<?=$item['category_id']?>"><?=$item['category_name']?></a></li>
                                <?php }?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="uk-width-expand@m">
                <div data-uk-grid>
                    <div class="uk-width-expand@m">
                        <form class="uk-search uk-search-default uk-width-1-1">
                            <span data-uk-search-icon></span>
                            <input name="q" class="uk-search-input uk-text-small uk-border-rounded uk-form-large" type="search" placeholder="Tìm kiếm món ăn..." value="<?=$q?>">
                        </form>
                    </div>
                </div>
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
                                    <div class="uk-width-expand uk-text-right">by <?=$item['category_name']?></div>
                                </div>
                            </div>
                            <a href="/detail.php?id=<?=$item['food_id']?>" class="uk-position-cover"></a>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <div class="uk-margin-large-top uk-text-small">
                    <ul class="uk-pagination uk-flex-center uk-text-500 uk-margin-remove" data-uk-margin>
                        <?php if ($currentPage > 1) {?>
                        <li><a href="?page=<?=$currentPage - 1?>"><span data-uk-pagination-previous></span></a></li>
                        <?php }?>

                        <?php for ($i = 1; $i <= $totalPages; $i++) {?>
                        <li class="<?=$i == $currentPage ? 'uk-active' : ''?>">
                            <?php if ($i == $currentPage) {?>
                            <span><?=$i?></span>
                            <?php } else {?>
                            <a href="?page=<?=$i?>"><?=$i?></a>
                            <?php }?>
                        </li>
                        <?php }?>

                        <?php if ($currentPage < $totalPages) {?>
                        <li><a href="?page=<?=$currentPage + 1?>"><span data-uk-pagination-next></span></a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="uk-container">
    <div class="uk-background-primary uk-border-rounded-large uk-light">
        <div class="uk-width-3-4@m uk-margin-auto uk-padding-large">
            <div class="uk-text-center">
                <h2 class="uk-h2 uk-margin-remove">Hãy là người đầu tiên biết về các thông tin mới nhất, nhận công thức nấu ăn thịnh hành mới và nhiều hơn nữa!</h2>
            </div>
            <div class="uk-margin-medium-top">
                <div data-uk-scrollspy="cls: uk-animation-slide-bottom; repeat: true">
                    <form>
                        <div class="uk-grid-small" data-uk-grid>
                            <div class="uk-width-1-1 uk-width-expand@s uk-first-column">
                                <input type="email" placeholder="Địa chỉ email" class="uk-input uk-form-large uk-width-1-1 uk-border-pill">
                            </div>
                            <div class="uk-width-1-1 uk-width-auto@s">
                                <input type="submit" value="Đăng ký" class="uk-button uk-button-large uk-button-warning">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'?>