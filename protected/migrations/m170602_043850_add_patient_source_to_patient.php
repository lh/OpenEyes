<?php

class m170602_043850_add_patient_source_to_patient extends OEMigration
{
    public function up()
    {
        $this->addColumn('patient', 'patient_source', 'tinyint(1) unsigned NOT NULL DEFAULT 0');
        $this->addColumn('patient_version', 'patient_source', 'tinyint(1) unsigned NOT NULL DEFAULT 0');
    }

    public function down()
    {
        $this->dropColumn('patient', 'patient_source');
        $this->dropColumn('patient_version', 'patient_source');
    }
}