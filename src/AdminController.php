<?php

namespace Selfreliance\Adminamazing;

use App\Http\Controllers\Controller;
use App\User;
use View;

class AdminController extends Controller
{
    public static function createTree(&$list, $parent, &$accessible)
    {
        $tree = array();
        foreach ($parent as $k=>$l){
            if(is_null($accessible)){
                if(isset($list[$l->id])){
                    $l->children = self::createTree($list, $list[$l->id], $accessible);
                }
                $tree[] = $l;
            }else if(in_array($l->package, $accessible)){
                if(isset($list[$l->id])){
                    $l->children = self::createTree($list, $list[$l->id], $accessible);
                }
                $tree[] = $l;
            }
        }
        return $tree;
    }

    public static function getTree($category, $type)
    {
        if($type == 1){
            $package = ($category->package == config('adminamazing.path')) ? config('adminamazing.path') : config('adminamazing.path').'/'.$category->package;
            $check = (\Request::route()->getPrefix() == $package) ? ' active' : NULL;
            $menu = '<li>';
            $menu .= '<a class="has-arrow'.$check.'" href="'.url($package).'" aria-expanded="false">'.$category->title.'</a>';
            if(isset($category->children)){
                $menu .= '<ul aria-expanded="false" class="collapse">'.self::showTree($category->children, $type).'</ul>';
            }
            $menu .= '</li>';
        }else if($type == 2){
            $menu = '<li class="dd-item dd3-item" data-id="'.$category->id.'">';
            $menu .= '<div class="dd-handle dd3-handle"></div>';
            $menu .= '<div class="dd3-content">'.$category->title;
            $menu .= '<div class="pull-right"><a href='.route('AdminMenuDelete', $category->id).'  data-toggle="tooltip" data-original-title="Удалить"><i class="fa fa-close text-danger"></i></a></div></div>';
            if(isset($category->children)){
                $menu .= '<ol class="dd-list">'.self::showTree($category->children, $type).'</ol>';
            }
        }
        return $menu;
    }

    public static function showTree($data, $type)
    {
        $string = '';
        $temp = null;
        foreach($data as $item){
            if(!empty($item->package)){
                $string .= self::getTree($item, $type);
            }
        }
        return $string;
    }

    public static function makeMenu($menu, $pages, $type)
    {
        $new = array();
        foreach ($menu as $a){
            $new[$a->parent][] = $a;
        }
        $tree = self::createTree($new, $new[0], $pages);
        return self::showTree($tree, $type);
    }

    public function index()
    {
        $CountAllUsers = User::count("id");
        return view('adminamazing::home')->with(['CountAllUsers'=>$CountAllUsers]);
    }
}
