<?php

namespace app\admin\controller;

use think\View;
use think\Db;
use think\Request;
use app\admin\model\Notice;
use think\Model;
use think\captcha;

class Noticement extends Index
{
    public function edit()
    {
        if (!$this->accountok()) {
            $this->redirect(url('/admin'));
        }

        $title = input('param.title');
        $publisher = input('param.publisher');
        $content = input('param.content');
        if ($title <> '') {
            $notice = new Notice;
            $notice->add($title, $publisher, $content);
            return $this->success('恭喜您公告添加成功^_^', '__PUBLIC__/admin/index/manage');
        }
        return $this->fetch();
    }

    public function show() {
        $show = new Notice;
        $show = Notice::where('id','>',0)->order('id' , 'desc')->paginate(5);
        $this->assign('show',$show);
        return $this->fetch();
    }

}