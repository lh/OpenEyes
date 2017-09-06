<?php

class m170602_062108_add_patient_referral_table extends OEMigration
{
    public function up()
    {
        $this->createOETable('patient_referral', array(
            'patient_id' => 'int unsigned NOT NULL PRIMARY KEY',
            'file_content' => 'mediumblob NOT NULL',
            'file_type' => 'varchar(30) NOT NULL',
            'file_size' => 'int unsigned NOT NULL',
            'file_name' => 'varchar(255) NOT NULL',
            'constraint patient_referral_id_fk foreign key (patient_id) references patient (id)',
        ));
    }

    public function down()
    {
        $this->dropOETable('patient_referral');
    }
}