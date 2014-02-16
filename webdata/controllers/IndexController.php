<?php

class IndexController extends Pix_Controller
{
    public function indexAction()
    {
        $this->view->level = Level::find_by_level_no(1);
        return $this->redraw('/index/level.phtml');
    }

    public function levelAction($id)
    {
        $this->view->level = Level::find_by_level_no($id);
        if (!$this->view->level) {
            return $this->redirect('/');
        }
    }

    public function checkAction()
    {
        list(, /*index*/, /*check*/, $id) = explode('/', $this->getURI());
        $level = Level::find_by_level_no($id);

        if (!$level) {
            return $this->alert("找不到關卡 {$level}", '/');
        }

        $answer = $_POST['answer'];
        if (!$answer = json_decode($answer)) {
            return $this->alert("不是合法的 JSON", '/level/' . $id);
        }

        $ret = $level->check($answer);
        if (!$ret) {
            return $this->alert("答案不正確", "/level/{$id}");
        }

        if ($_POST['name']) {
            LevelHero::insert(array(
                'level_id' => $level->id,
                'name' => mb_strimwidth(strval($_POST['name']), 0, 16),
                'created_at' => time(),
                'created_from' => intval(ip2long($_SERVER['REMOTE_ADDR'])),
            ));
        }

        return $this->alert("挑戰成功!在下面留言把你的程式碼傳到 GitHub 分享給大家吧!", "/level/{$id}");

    }
}
