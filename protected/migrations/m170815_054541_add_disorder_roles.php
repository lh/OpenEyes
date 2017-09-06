<?php

class m170815_054541_add_disorder_roles extends OEMigration
{
    const MANAGE_DISORDER_ROLE = 'Manage Disorder';
    const VIEW_DISORDER_ROLE = 'View Disorder';
    const MANAGE_DISORDER_TASK = 'TaskManageDisorder';
    const VIEW_DISORDER_TASK = 'TaskViewDisorder';

    public function safeUp()
    {

        $this->insert('authitem', array('name' => self::MANAGE_DISORDER_ROLE, 'type' => 2));
        $this->insert('authitem', array('name' => self::VIEW_DISORDER_ROLE, 'type' => 2));

        $this->insert('authitem', array('name' => self::MANAGE_DISORDER_TASK, 'type' => 1));
        $this->insert('authitem', array('name' => self::VIEW_DISORDER_TASK, 'type' => 1));

        $this->insert('authitemchild',
            array('parent' => self::MANAGE_DISORDER_ROLE, 'child' => self::MANAGE_DISORDER_TASK));
        $this->insert('authitemchild',
            array('parent' => self::MANAGE_DISORDER_ROLE, 'child' => self::VIEW_DISORDER_TASK));

        $this->insert('authitemchild',
            array('parent' => self::VIEW_DISORDER_ROLE, 'child' => self::VIEW_DISORDER_TASK));
    }

    public function safeDown()
    {
        $this->delete('authassignment', 'itemname = "' . self::MANAGE_DISORDER_ROLE . '"');
        $this->delete('authassignment', 'itemname = "' . self::VIEW_DISORDER_ROLE . '"');

        $this->delete('authitemchild',
            'parent = "' . self::MANAGE_DISORDER_ROLE . '" AND child = "' . self::MANAGE_DISORDER_TASK . '"');
        $this->delete('authitem', 'name = "' . self::MANAGE_DISORDER_TASK . '"');
        $this->delete('authitem', 'name = "' . self::MANAGE_DISORDER_ROLE . '"');

        $this->delete('authitemchild',
            'parent = "' . self::VIEW_DISORDER_ROLE . '" AND child = "' . self::VIEW_DISORDER_TASK . '"');
        $this->delete('authitem', 'name = "' . self::VIEW_DISORDER_TASK . '"');
        $this->delete('authitem', 'name = "' . self::VIEW_DISORDER_ROLE . '"');
    }
}