<?php


use Fuel\Core\View;
Use Fuel\Core\Response;

class Controller_Album extends Controller_App
{
    public function action_index():void {

    }

    public function action_detail($id):void {
        $data = [];
        $data['album'] = $this->api->getAlbum($id);
        $this->template->content = View::forge('album/detail',$data);
    }
}