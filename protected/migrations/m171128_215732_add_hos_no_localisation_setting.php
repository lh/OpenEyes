<?php

class m171128_215732_add_hos_no_localisation_setting extends OEMigration
{
    public function safeUp()
    {
        $this->insert('setting_metadata', array(
            'element_type_id' => null,
            'field_type_id' => 4, // Text field
            'key' => 'hos_label_short',
            'name' => 'Short Hospital Label',
            'default_value' => 'Hos',
        ));

        $this->insert('setting_metadata', array(
            'element_type_id' => null,
            'field_type_id' => 4, // Text field
            'key' => 'hos_label_long',
            'name' => 'Long Hospital Label',
            'default_value' => 'Hospital',
        ));
    }

    public function safeDown()
    {
        $this->delete('setting_metadata', '`key` = \'hos_label_short\'');
        $this->delete('setting_metadata', '`key` = \'hos_label_long\'');
    }
}