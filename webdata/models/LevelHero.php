<?php

class LevelHero extends Pix_Table
{
    public function init()
    {
        $this->_name = 'level_hero';
        $this->_primary = 'id';

        $this->_columns['id'] = array('type' => 'int', 'auto_increment' => true);
        $this->_columns['level_id'] = array('type' => 'int');
        $this->_columns['name'] = array('type' => 'varchar', 'size' => 32);
        $this->_columns['created_at'] = array('type' => 'int');
        $this->_columns['created_from'] = array('type' => 'int', 'unsigned' => true);

        $this->addIndex('levelid_createdat_id', array('level_id', 'created_at', 'id'));
    }
}
