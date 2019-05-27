<!DOCTYPE html>
<html>
<head>
    <title>Digg(仮)</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no,shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/css/style.css"/>
</head>
<body>
<header>
    <a href="/"><h1 id="site_title">Digg(仮)</h1></a>
    <div>
        <?php if(isset($user_id)):?>
        <p>hello <?=$user_id?></p>
        <?php else:?>
        <a href="/start">Spotifyでログイン</a>
        <?php endif;?>
    </div>
</header>
<div id="main_content">
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
