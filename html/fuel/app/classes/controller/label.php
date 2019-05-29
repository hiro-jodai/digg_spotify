<?php


use Fuel\Core\View;
Use Fuel\Core\Response;
Use Fuel\Core\Input;

class Controller_Label extends Controller_App
{
    public function action_index():void {
        $data = [];
        $this->template->content = View::forge('label/index',$data);
    }

    public function action_detail($name):void {
    }

    public function action_add(){
        if(!Input::is_Ajax()){
            // エラー処理
            die();
        }


     }


}