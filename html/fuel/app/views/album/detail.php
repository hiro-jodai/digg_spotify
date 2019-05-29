<div class="row">
    <div class="col-sm-6">
        <img class="img-responsive" src="<?=$album->images[0]->url?>" alt="">
    </div>
    <div class="col-sm-6">
        <div class="row">
            <h2 class="title"><?=$album->name?></h2>
            <p class="artist">
                <?php
                $artist_name = [];
                foreach ($album->artists as $artist){
                    $artist_name[] = $artist->name;
                }
                echo implode(' ', $artist_name);
                ?>
            </p>
            <p><?=$album->label?></p>
<!--            <button type="button" id="label_name" value="--><?//=$album->label?><!--" class="btn btn-success"><span class="oi" data-glyph="star" title="star" aria-hidden="true"></span>レーベルをお気に入りに追加する</button>-->
        </div>
        <div class="row col-sm-4">
            <hr>
            <?php
            $artists = implode(' ', $artist_name);
            $search_keyword = urlencode("{$album->name} {$artists}");
            ?>
            <a class="icons soundcloud" href="https://soundcloud.com/search?q=<?=$search_keyword?>" target="_blank" ><img src="/assets/img/logo/soundcloud.png" alt=""></a>
            <a class="icons beatport" target="_blank" href="https://www.beatport.com/search?q=<?=$search_keyword?>"><img src="/assets/img/logo/beatport.png" alt=""></a>
            <a class="icons juno" target="_blank" href="https://www.junodownload.com/search/?q%5Ball%5D%5B%5D=<?=$search_keyword?>"><img src="/assets/img/logo/juno.jpg" alt=""></a>
            <a class="icons google_play" target="_blank" href="https://play.google.com/store/search?q=<?=$search_keyword?>&c=music&hl=ja"><img src="/assets/img/logo/google_play.jpg" alt=""></a>
            <a class="icons bandcamp" target="_blank" href="https://bandcamp.com/search?q=<?=$search_keyword?>"><img src="/assets/img/logo/bandcamp.jpg" alt=""></a>
        </div>
    </div>
    <hr>
    <div class="col-sm-12">
        <table class="table table-responsive table-hover">
            <tr>
                <th></th>
                <th>title</th>
                <th>artist</th>
                <th>search</th>
            </tr>
            <?php foreach ($album->tracks->items as $track): ?>

                <tr>
                    <td>
                        <iframe src="https://open.spotify.com/embed/track/<?=$track->id?>" width="80" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                    </td>
                    <td>
                        <?=$track->name?>
                    </td>
                    <td>
                        <?php
                        $artists = [];
                        foreach ( $track->artists as $artist){
                            $artists[] = $artist->name;
                            echo $artist->name . '<br>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $artists = implode(' ', $artists);
                        $search_keyword = urlencode("{$track->name} {$artists}");
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
    </div>

</div>
