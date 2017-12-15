<?php

class m170804_003027_create_patient_user_referral_table extends OEMigration
{
    public function up()
    {
        $this->createOETable('patient_user_referral', array(
            'id' => 'pk',
            'patient_id' => 'int(10) unsigned NOT NULL',
            'user_id' => 'int(10) unsigned NOT NULL',
        ), true
        );

        $this->addForeignKey('patient_user_referral_patient', 'patient_user_referral', 'patient_id', 'patient', 'id');
        $this->addForeignKey('patient_user_referral_user', 'patient_user_referral', 'user_id', 'user', 'id');
    }

    public function down()
    {
        $this->dropOETable('patient_user_referral', true);
    }
}
