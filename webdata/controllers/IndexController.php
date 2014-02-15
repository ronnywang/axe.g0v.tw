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
}
