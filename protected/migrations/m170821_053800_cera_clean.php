<?php

class m170821_053800_cera_clean extends OEMigration
{
//	public function up()
//	{
//
//	}
//
//	public function down()
//	{
//		echo "m170821_053800_cera_clean does not support migration down.\n";
//		return false;
//	}


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	    $source = new ImportSource;
	    $source->name = 'Fivium Australia';
        if (!$source->save()) {
            throw new CDbException("Unable to save source $source->name");
        }
        else {
            $source->save();
        }

	    $contact = new Contact;
        if (!$contact->save()) {
            throw new CDbException("Unable to save contact");
        }
        else {
            $contact->save();
        }

	    $institution = new Institution;
	    $institution->name = 'Center for Eye Research Australia';
	    $institution->remote_id = 'CERA';
	    $institution->contact = $contact->id;
	    $institution->source_id = $source->id;
        if (!$institution->save()) {
            throw new CDbException("Unable to save institution");
        }
        else {
            $institution->save();
        }

	    $site = new Site;
	    $site->name = 'Center for Eye Research Australia';
	    $site->remote_id = 'CERA';
	    $site->short_name = 'CERA';
	    $site->telephone = '0399298360';
	    $site->institution_id = $institution->id;
	    $site->contact_id = $contact->id;
	    $site->source_id = $source->id;
        if (!$site->save()) {
            throw new CDbException("Unable to save site");
        }
        else {
            $site->save();
        }

	    $address = new Address;
	    $address->address1 = 'Level 7';
	    $address->address2 = '32 Gisborne St';
	    $address->city = 'East Melbourne';
	    $address->county = 'VIC';
	    $address->country_id = 15;
	    $address->contact_id = $contact->id;
	    $address->date_end = null;
        if (!$address->save()) {
            throw new CDbException("Unable to save address");
        }
        else {
            $address->save();
        }
	}

	public function safeDown()
	{

	}

}