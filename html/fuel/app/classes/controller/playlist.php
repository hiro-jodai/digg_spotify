<?php


use Fuel\Core\View;
Use Fuel\Core\Response;

class Controller_Playlist extends Controller_App
{
    public function action_index():void {
        $playlists = [];
        try{
            $playlists = $this->api->getMyPlaylists();
        } catch (Exception $e){
            // 未ログイン時
            Response::redirect('/start');
        }
        $data['playlists'] = $playlists;
        $this->template->content = View::forge('playlist/index',$data);
    }
}