<div id="playlists">
    <h2>プレイリスト一覧</h2>
    <table class="table table-hover">
        <tr>
            <th></th>
            <th>プレイリスト名</th>
            <th>作成者</th>
        </tr>

        <?php if(isset($playlists->items)):
            foreach($playlists->items as $playlist):?>
                <tr>
                    <td>
                        <img class="thumbnail" src="<?=$playlist->images[0]->url?>" alt="">
                    </td>
                    <td>
                        <a href="/playlist/detail/<?=htmlspecialchars($playlist->id)?>"><?=htmlspecialchars($playlist->name)?></a>
                    </td>
                    <td>
                        <?=$playlist->owner->id?>
                    </td>
                    <td>
                    </td>
                </tr>
            <?php endforeach;
        endif;?>
    </table>
    <?= $ret = Html_App::pager($current,$playlists->total);?>
</div>
