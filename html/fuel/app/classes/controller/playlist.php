<?php


use Fuel\Core\View;
Use Fuel\Core\Response;

class Controller_Playlist extends Controller_App
{
    public function action_index():void {
        $playlists = [];

        $current = 1;
        if(isset($_GET['page'])){
            $current = $_GET['page'];
        }

        $option = $this->getPagingOptions($current);

        try{
            $playlists = $this->api->getMyPlaylists($option);
        } catch (Exception $e){
            // 未ログイン時
            Response::redirect('/start');
        }

        $data['current'] = $current;
        $data['playlists'] = $playlists;
        $this->template->content = View::forge('playlist/index',$data);
    }

    public function action_detail($id):void {
        $data = [];
        $current = 1;
        if(isset($_GET['page'])){
            $current = $_GET['page'];
        }

        $option = $this->getPagingOptions($current);

        try {
            $data['playlist_name'] = $this->api->getPlaylist($id)->name;
            $data['tracks'] = $this->api->getPlaylistTracks($id, $option);
        }catch (Exception $e){
            Response::redirect('/start');
        }

        $data['current'] = $current;

        $this->template->content = View::forge('playlist/detail',$data);
    }
}