<?php

class m170602_044204_add_confirmation_to_secondary_diagnosis extends OEMigration
{
    public function up()
    {
        $this->addColumn('secondary_diagnosis', 'is_confirmed', 'tinyint(1) unsigned');
        $this->addColumn('secondary_diagnosis_version', 'is_confirmed', 'tinyint(1) unsigned');
    }

    public function down()
    {
        $this->dropColumn('secondary_diagnosis', 'is_confirmed');
        $this->dropColumn('secondary_diagnosis_version', 'is_confirmed');
    }
}