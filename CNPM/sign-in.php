<?php
    ob_start();
    session_start();
?>

<?php include 'config/SQLQuery.php'; ?>

<?php
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usernameOrEmail = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userList = SQLQuery::GetData("SELECT * FROM users WHERE username = '{$usernameOrEmail}' OR email = '{$usernameOrEmail}' LIMIT 1");

        if (count($userList) > 0 && hash('sha256', $password) === $userList[0]['password']) {
            $_SESSION['user'] = [
                'user_id'  => $userList[0]['user_id'],
                'username' => $userList[0]['username'],
                'email'    => $userList[0]['email'],
                'role'     => $userList[0]['role'],
            ];

            if ($userList[0]['role'] == 'admin') {
                header('Location: /admin/foods/');
            } else {
                header('Location: /admin/favorite/');
            }
            exit;
        } else {
            $error = 'Tên đăng nhập hoặc mật khẩu không đúng.';
        }
    }
?>

<!DOCTYPE html>
<html lang="vi" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Món ăn</title>
    <link type="image/png" href="/template/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Leckerli+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/template/client/css/main.css" />
    <script src="/template/client/js/uikit.js"></script>
</head>

<body <div class="uk-grid-collapse" data-uk-grid>
    <div class="uk-width-1-2@m uk-padding-large uk-flex uk-flex-middle uk-flex-center" data-uk-height-viewport>
        <div class="uk-width-3-4@s">
            <div class="uk-text-center uk-margin-bottom">
                <a class="uk-logo uk-text-primary uk-text-bold" href="/">Thái</a>
            </div>
            <div class="uk-text-center uk-margin-medium-bottom">
                <h1 class="uk-h2 uk-letter-spacing-small">Đăng nhập</h1>
            </div>

            <?php if (!empty($error)): ?>
            <div class="uk-text-center uk-label-danger uk-margin-medium-bottom" style="padding: 8px">
                <?=$error?>
            </div>
            <?php endif; ?>

            <form method="POST" class="uk-text-center">
                <div class="uk-width-1-1 uk-margin">
                    <label class="uk-form-label" for="email">Tên đăng nhập</label>
                    <input name="email" class="uk-input uk-form-large uk-border-pill uk-text-center" type="text" placeholder="Tên đăng nhập hoặc email">
                </div>
                <div class="uk-width-1-1 uk-margin">
                    <label class="uk-form-label" for="password">Mật khẩu</label>
                    <input name="password" class="uk-input uk-form-large uk-border-pill uk-text-center" type="password" placeholder="Mật khẩu">
                </div>
                <div class="uk-width-1-1 uk-margin uk-text-center">
                    <a class="uk-text-small uk-link-muted" href="#">Quên mật khẩu?</a>
                </div>
                <div class="uk-width-1-1 uk-text-center">
                    <button class="uk-button uk-button-primary uk-button-large">Đăng nhập</button>
                </div>
            </form>
        </div>
    </div>

    <div class="uk-width-1-2@m uk-padding-large uk-flex uk-flex-middle uk-flex-center uk-light" data-uk-height-viewport>
        <div class="uk-background-cover uk-background-norepeat uk-background-blend-overlay uk-background-overlay uk-border-rounded-large uk-width-1-1 uk-height-xlarge uk-flex uk-flex-middle uk-flex-center"
            style="background-image: url(/template/img/background.jpg);">
            <div class="uk-padding-large">
                <div class="uk-text-center">
                    <h2 class="uk-letter-spacing-small">Hi, Hãy tham gia cùng chúng tôi</h2>
                </div>
                <div class="uk-margin-top uk-margin-medium-bottom uk-text-center">
                    <p>Nhập thông tin cá nhân của bạn và trở thành một phần của cộng đồng nấu ăn</p>
                </div>
                <div class="uk-width-1-1 uk-text-center">
                    <a href="/sign-up.php" class="uk-button uk-button-primary uk-button-large">Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>