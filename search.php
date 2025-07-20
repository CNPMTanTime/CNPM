<?php include 'header.php'?>
<?php
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;

    $q = $_GET['q'] ?? '';
    $cat = $_GET['cat'] ?? '';

    $sql = 'SELECT foods.*, categories.category_id AS cat_id, categories.category_name
        FROM foods
        LEFT JOIN categories ON foods.category_id = categories.category_id
        WHERE 1';

    $params = [];

    if (!empty($q)) {
        $sql .= ' AND food_name LIKE :q';
        $params[':q'] = '%' . $q . '%';
    }

    if (!empty($cat)) {
        $sql .= ' AND categories.category_id = :cat';
        $params[':cat'] = $cat;
    }

    $foodPagination = SQLQuery::GetDataWithPagination($sql, $page, 12, $params);
    $foodList = $foodPagination['data'];
    $totalPages = $foodPagination['page_number'];
    $currentPage = $page;
?>
<div class="uk-section uk-section-default uk-padding-remove-top">
    <div class="uk-container">
        <h1 class="uk-nav-center">Tìm kiếm</h1>

        <div data-uk-grid>
            <div class="uk-width-1@m">
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
<?php include 'footer.php'?>