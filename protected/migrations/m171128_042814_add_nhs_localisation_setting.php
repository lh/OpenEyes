<?php

class m171128_042814_add_nhs_localisation_setting extends OEMigration
{
    public function safeUp()
    {
        $this->insert('setting_metadata', array(
            'element_type_id' => null,
            'field_type_id' => 4, // Text field
            'key' => 'nhs_label',
            'name' => 'NHS Label',
            'default_value' => 'NHS',
        ));
    }

    public function safeDown()
    {
        $this->delete('setting_metadata', '`key` = \'nhs_label\'');
    }
}