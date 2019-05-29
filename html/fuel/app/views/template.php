<!DOCTYPE html>
<html>
<head>
    <title>Digg(仮)</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no,shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/css/style.css"/>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/assets/css/bootstrap-theme.min.css"/>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="collapse navbar-collapse">
                <a href="/" class="title navbar-brand">Digg(仮)</a>
                <?php if(isset($user_id)):?>
                    <a class="navbar-text" href="/playlist">プレイリスト一覧</a>
<!--                    <a class="navbar-text" href="/label">レーベル</a>-->
                    <p class="navbar-text navbar-right"><?=$user_id?>でログイン中</p>
                    <a class="navbar-text navbar-right" href="/logout">ログアウト</a>
                <?php else:?>
                    <a class="navbar-text navbar-right" href="/start">Spotifyでログイン</a>
                <?php endif;?>
            </div>
        </div>
    </div>
</nav>
<div id="container">
    <?php echo $content; ?>
</div>
<footer>
    <p id="copyright">© <?= date('Y')?> Hiroyuki Jodai</p>
</footer>
    <script type="text/javascript" src="/assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/index.js"></script>
</body>
</html>
