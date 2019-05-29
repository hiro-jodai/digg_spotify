<div class="container text-center">

    <?php if(!isset($user_id)):?>
        <h2 class="title">Spotify上のプレイリストから音源を買う</h2>
        <br>
        <br>
        <p>Spotifyで作成したプレイリストを元に各音源販売サイト上で検索を行うリンクを生成します。</p>
        <p>まずは<a href="/start">Spotifyを連携</a>してプレイリストを読み込もう！</p>

    <?php else:?>
        <a href="/playlist">プレイリスト</a>
    <?php endif;?>
</div>

