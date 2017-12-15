<?php

class m171117_001321_remove_nod_export_authitem extends OEMigration
{
    public function safeUp()
    {
        $this->delete('authassignment', 'itemname = "NOD Export"');
        $this->removeRole('NOD Export');
    }

    public function safeDown()
    {
        $this->addRole('NOD Export');
    }
}