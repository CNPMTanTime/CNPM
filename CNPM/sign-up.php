<?php
    ob_start();
    session_start();
?>

<?php include 'config/SQLQuery.php'; ?>

<?php
    $success = '';
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $rePassword = trim($_POST['re-password'] ?? '');

        if ($username === '' || $email === '' || $password === '' || $rePassword === '') {
            $error = 'Vui lòng nhập đầy đủ thông tin.';
        } elseif ($password !== $rePassword) {
            $error = 'Mật khẩu không khớp.';
        } else {
            $userExists = SQLQuery::GetData("SELECT * FROM users WHERE username = '{$username}' OR email = '{$email}'");

            if (count($userExists) > 0) {
                $error = 'Tên đăng nhập hoặc email đã được sử dụng.';
            } else {
                $hashedPassword = hash('sha256', $password);
                $insertSql = "INSERT INTO users (username, email, password, role) VALUES ('{$username}', '{$email}', '{$hashedPassword}', 'user')";
                $result = SQLQuery::NonQuery($insertSql);

                if ($result) {
                    $success = 'Đăng ký thành công';
                } else {
                    $error = 'Đăng ký thất bại. Vui lòng thử lại.';
                }
            }
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

<body>
    <div class="uk-grid-collapse" data-uk-grid>
        <div class="uk-width-1-2@m uk-padding-large uk-flex uk-flex-middle uk-flex-center" data-uk-height-viewport>
            <div class="uk-width-3-4@s">
                <div class="uk-text-center uk-margin-bottom">
                    <a class="uk-logo uk-text-primary uk-text-bold" href="/">Hướng dẫn nấu ăn</a>
                </div>
                <div class="uk-text-center uk-margin-medium-bottom">
                    <h1 class="uk-h2 uk-letter-spacing-small">Tạo tài khoản</h1>
                </div>

                <?php if (!empty($success)): ?>
                <div class="uk-text-center uk-label-green uk-margin-medium-bottom" style="padding: 8px">
                    <?=$success?>
                </div>
                <?php endif; ?>

                <?php if (!empty($error)): ?>
                <div class="uk-text-center uk-label-danger uk-margin-medium-bottom" style="padding: 8px">
                    <?=$error?>
                </div>
                <?php endif; ?>

                <form class="uk-text-center" method="POST">
                    <div class="uk-width-1-1 uk-margin">
                        <label class="uk-form-label" for="name">Tên đăng nhập</label>
                        <input name="username" class="uk-input uk-form-large uk-border-pill uk-text-center" type="text">
                    </div>
                    <div class="uk-width-1-1 uk-margin">
                        <label class="uk-form-label" for="email">Email</label>
                        <input name="email" class="uk-input uk-form-large uk-border-pill uk-text-center" type="email">
                    </div>
                    <div class="uk-width-1-1 uk-margin">
                        <label class="uk-form-label" for="password">Mật khẩu</label>
                        <input name="password" class="uk-input uk-form-large uk-border-pill uk-text-center" type="password">
                    </div>
                    <div class="uk-width-1-1 uk-margin">
                        <label class="uk-form-label" for="password">Nhập lại mật khẩu</label>
                        <input name="re-password" class="uk-input uk-form-large uk-border-pill uk-text-center" type="password">
                    </div>
                    <div class="uk-width-1-1 uk-text-center">
                        <button class="uk-button uk-button-primary uk-button-large">Đăng ký</button>
                    </div>
                    <div class="uk-width-1-1 uk-margin uk-text-center">
                        <p class="uk-text-small uk-margin-remove">Bằng việc đăng ký, bạn đồng ý với <a class="uk-link-border" href="#">điều khoản</a> dịch vụ của chúng tôi.</p>
                    </div>
                </form>
            </div>
        </div>

        <div class="uk-width-1-2@m uk-padding-large uk-flex uk-flex-middle uk-flex-center uk-light" data-uk-height-viewport>
            <div class="uk-background-cover uk-background-norepeat uk-background-blend-overlay uk-background-overlay uk-border-rounded-large uk-width-1-1 uk-height-xlarge uk-flex uk-flex-middle uk-flex-center"
                style="background-image: url(/template/img/background.jpg);">
                <div class="uk-padding-large">
                    <div class="uk-text-center">
                        <h2 class="uk-letter-spacing-small">Chào mừng bạn quay lại</h2>
                    </div>
                    <div class="uk-margin-top uk-margin-medium-bottom uk-text-center">
                        <p>Bạn đã có tài khoản? Nhập thông tin để bắt đầu nấu món ăn đầu tiên ngay hôm nay</p>
                    </div>
                    <div class="uk-width-1-1 uk-text-center">
                        <a href="/sign-in.php" class="uk-button uk-button-primary uk-button-large">Đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>