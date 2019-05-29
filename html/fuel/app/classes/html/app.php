<?php

//namespace Fuel\Core;
use \Fuel\Core\Html;

class Html_App extends Html
{
    public static function pager(int $current_page, int $total_rec, int $par_page = 20):string
    {
        $page_rec = $par_page;   //１ページに表示するレコード
        $total_page = ceil($total_rec / $page_rec); //総ページ数
        $show_nav = 5;  //表示するナビゲーションの数
        $path = '?page=';   //パーマリンク

        //全てのページ数が表示するページ数より小さい場合、総ページを表示する数にする
        if ($total_page < $show_nav) {
            $show_nav = $total_page;
        }
        //トータルページ数が2以下か、現在のページが総ページより大きい場合表示しない
        if ($total_page <= 1 || $total_page < $current_page){
            return '';
        }
        //総ページの半分
        $show_navh = floor($show_nav / 2);
        //現在のページをナビゲーションの中心にする
        $loop_start = $current_page - $show_navh;
        $loop_end = $current_page + $show_navh;
        //現在のページが両端だったら端にくるようにする
        if ($loop_start <= 0) {
            $loop_start = 1;
            $loop_end = $show_nav;
        }
        if ($loop_end > $total_page) {
            $loop_start = $total_page - $show_nav + 1;
            $loop_end = $total_page;
        }
        //2ページ移行だったら「一番前へ」を表示
        $paginator = '';
        if ($current_page > 2) {
            $paginator .= '<li class="page-item"><a class="page-link" href="'. $path .'1">&laquo;</a></li>';
        }
        //最初のページ以外だったら「前へ」を表示
        if ($current_page > 1) {
            $paginator .= '<li class="page-item"><a class="page-link" href="'. $path . ($current_page-1).'">&lsaquo;</a></li>';
        }

        for ($i=$loop_start; $i<=$loop_end; $i++) {
            if ($i > 0 && $total_page >= $i) {
                if($i == $current_page){
                    $paginator .= '<li class="page-item active">';
                } else {
                    $paginator .= '<li class="page-item">';
                }
                $paginator .= '<a class="page-link" href="'. $path . $i.'">'.$i.'</a>';
                $paginator .= '</li>';
            }
        }
        //最後のページ以外だったら「次へ」を表示
        if ($current_page < $total_page) {
            $paginator .= '<li class="page-item"><a class="page-link" href="'. $path . ($current_page+1).'">&rsaquo;</a></li>';
        }
        //最後から２ページ前だったら「一番最後へ」を表示
        if ($current_page < $total_page - 1) {
            $paginator .= '<li class="page-item"><a class="page-link" href="'. $path . $total_page.'">&raquo;</a></li>';
        }

        return <<<HTML
   <nav aria-label="Page navigation ">
        <ul class="pagination text-center">
        $paginator
        </ul>
    </nav>
HTML;

    }
}
