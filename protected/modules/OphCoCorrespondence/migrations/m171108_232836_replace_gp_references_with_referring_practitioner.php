<?php

class m171108_232836_replace_gp_references_with_referring_practitioner extends CDbMigration
{
	public function safeUp()
	{
	    $this->update('ophcocorrespondence_letter_recipient', array('name' => 'Referring Practitioner'), "name = 'GP'");
	}

	public function safeDown()
	{
        $this->update('ophcocorrespondence_letter_recipient', array('name' => 'GP'), "name = 'Referring Practitioner'");
	}
}