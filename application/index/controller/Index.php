<?php

namespace app\index\controller;

use think\Paginator;
use think\Db;
use app\admin\model\Notice;
use app\admin\model\Team;

class Index extends \think\Controller
{
    //徐汉雄
    public function index()
    {
        $ress = Db::name("notice")->field("title,create_time")->order("id DESC")->limit(5)->select();
        $res = Team::where("id", ">", 12)->select();
        $this->assign("ress", $ress);
        $this->assign("res", $res);
        return $this->fetch();
        //return view();
    }


    //帅中贤
    public function download()
    {
        $res = Db::name("download")->field("title,path")->order("id DESC")->paginate(1);
        $this->assign("res", $res);
        return $this->fetch();
    }

    public function upload()
    {
        $list = Db::name('notice')->paginate(5);
// 把分页数据赋值给模板变量list
        $this->assign('list', $list);
// 渲染模板输出
        return $this->fetch();
    }

    public function test()
    {
        /* $id=input("get.id");
          $res = Db::name("download")->where ([
           "id"=>$id
          ])->field("path")->find();*/
        echo 1;
    }

    public function newnotice()
    {
        $res = new Notice;
        $res = Notice::field("title,create_time")->order("id DESC")->limit(5)->select();
        $this->assign("res", $res);
        return $this->fetch();
    }

    public function news()
    {
        $res = Db::name("notice")->field("title,create_time")->order("id DESC")->select();
        $this->assign("res", $res);
        return $this->fetch();
    }

    //刘启明
    public function introduction()
    {
        return view();
    }

    public function loading()
    {
        return view();
    }

    public function team()
    {
        $all = "";
        $team = Team::where('name', 'like', "%{$all}%")->paginate(5, false);
        $page = $team->render();
        $this->assign('team', $team);
        $this->assign('page', $page);
        return $this->fetch();
    }

    public function search()
    {
        return view();
    }

    public function searchshow($page = '0')
    {
        if (empty($page)) {
            $search_name = input('search_name');
            if (empty($search_name) and $page == 0) {
                $this->redirect('__PUBLIC__/index.php/index/index/search');
            }
            $search = ['query' => []];
            $search['query']['search_name'] = $search_name;
            new Notice();
            $title = Notice::where('title', 'like', "%{$search_name}%")->paginate(5, false);
            $publisher = Notice::where('publisher', 'like', "%{$search_name}%")->paginate(5, false);
            $page1 = $title->render();
            $page2 = $publisher->render();
            $this->assign('title', $title);
            $this->assign('publisher', $publisher);
            $this->assign('page1', $page1);
            $this->assign('page2', $page2);
        }
        return $this->fetch();
    }

    //周威
    public function view()
    {
        //   $list = Notice::where('id','=',0)
        //   ->find();

        // $this->assign('list',$list);
        $id = input('id');

        if ($id <> '') {

            $list = Notice::where('id', '=', $id)
                ->select();

            $this->assign('list', $list);

            return $this->fetch();
        }
        return $this->fetch('no');
        return "留言不存在";

    }

    public function show()
    {
        $list = new Notice;
        //$list = $notice->check();
        //
        $list = Notice::where('id', '>=', 1)
            ->select();

        $this->assign('list', $list);


        return $this->fetch();
    }
}
