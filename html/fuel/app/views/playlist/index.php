<div id="playlists">
    <form action="/playlist" type="GET">
        件数<select name="max" id="">
            <option value="20">20</option>
            <option value="50">50</option>
        </select>
    </form>
    <table>
        <tr>
            <th></th>
            <th>プレイリスト名</th>
            <th>作成者</th>
        </tr>

        <?php if(isset($playlists->items)):
            foreach($playlists->items as $playlist):

                ?>
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
</div>
