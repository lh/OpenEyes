<?php

class m171011_232539_remove_diagnosis_confirmation_column extends OEMigration
{
    public function up()
    {
        $this->dropColumn('secondary_diagnosis', 'is_confirmed');
        $this->dropColumn('secondary_diagnosis_version', 'is_confirmed');
    }

    public function down()
    {
        $this->addColumn('secondary_diagnosis', 'is_confirmed', 'tinyint(1) unsigned');
        $this->addColumn('secondary_diagnosis_version', 'is_confirmed', 'tinyint(1) unsigned');
    }
}