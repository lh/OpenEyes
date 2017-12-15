<?php

class m170928_220619_create_cera_number_sequence extends OEMigration
{
    public function up()
    {
        // CERA need the sequence to start above their current CERA number (around 17000)
        $this->insert('sequence_data', array('sequence_name' => 'patient_cera_number', 'sequence_cur_value' => 17000));
    }

    public function down()
    {
        $this->delete('sequence_data', 'sequence_name = "patient_cera_number"');
    }
}
