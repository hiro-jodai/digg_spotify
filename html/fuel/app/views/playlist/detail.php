<div id="playlist">
    <ul class="breadcrumb">
        <li><a href="/playlist">プレイリスト一覧</a></li>
        <li><?=$playlist_name?></li>
    </ul>

    <h2><?=$playlist_name?></h2>

    <table class="table table-responsive table-hover">
        <tr>
            <th></th>
            <th>title</th>
            <th>artist</th>
            <th>album</th>
            <th>release date</th>
            <th>search</th>
        </tr>
        <?php foreach ($tracks->items as $track): ?>

            <tr>
                <td>
                    <iframe src="https://open.spotify.com/embed/track/<?=$track->track->id?>" width="80" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                </td>
                <td>
                    <?=$track->track->name?>
                </td>
                <td>
                    <?php
                    $artists = [];
                    foreach ( $track->track->artists as $artist){
                        $artists[] = $artist->name;
                        echo $artist->name . '<br>';
                    }
                    ?>
                </td>
                <td>
                    <a href="/album/detail/<?=$track->track->album->id?>"><?=$track->track->album->name?></a>
                </td>
                <td>
                    <?=$track->track->album->release_date?>
                </td>
                <td>
                    <?php
                    $artists = implode(' ', $artists);
                    $search_keyword = urlencode("{$track->track->name} {$artists}");
                    ?>
                    <a class="icons soundcloud" href="https://soundcloud.com/search?q=<?=$search_keyword?>" target="_blank" ><img src="/assets/img/logo/soundcloud.png" alt=""></a>
                    <a class="icons beatport" target="_blank" href="https://www.beatport.com/search?q=<?=$search_keyword?>"><img src="/assets/img/logo/beatport.png" alt=""></a>
                    <a class="icons juno" target="_blank" href="https://www.junodownload.com/search/?q%5Ball%5D%5B%5D=<?=$search_keyword?>"><img src="/assets/img/logo/juno.jpg" alt=""></a>
                    <a class="icons google_play" target="_blank" href="https://play.google.com/store/search?q=<?=$search_keyword?>&c=music&hl=ja"><img src="/assets/img/logo/google_play.jpg" alt=""></a>
                    <a class="icons bandcamp" target="_blank" href="https://bandcamp.com/search?q=<?=$search_keyword?>"><img src="/assets/img/logo/bandcamp.jpg" alt=""></a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <?php
    if ($tracks->total >= PAGE_LIMIT) {
        echo Html_App::pager($current,$tracks->total );
    }?>
</div>
