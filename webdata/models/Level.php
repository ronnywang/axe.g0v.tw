<?php

class LevelRow extends Pix_Table_Row
{
    public function getEAVs()
    {
        return EAV::search(array('table' => 'Level', 'id' => $this->set_id));
    }

}

class Level extends Pix_Table
{
    public function init()
    {
        $this->_name = 'level';
        $this->_primary = 'id';
        $this->_rowClass = 'LevelRow';

        $this->_columns['id'] = array('type' => 'int', 'auto_increment' => true);
        $this->_columns['level_no'] = array('type' => 'int');
        $this->_columns['title'] = array('type' => 'text');
        $this->_columns['desc'] = array('type' => 'text');
        $this->_columns['url'] = array('type' => 'text');

        $this->addRowHelper('Pix_Table_Helper_EAV', array('getEAV', 'setEAV'));
    }

    public function getLevels()
    {
        return Level::search("level_no > 0");
    }
}
