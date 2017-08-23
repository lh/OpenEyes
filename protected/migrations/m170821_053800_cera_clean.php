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
	    $source->save();

	    $contact = new Contact;
	    $contact->save();

	    $institution = new Institution;
	    $institution->name = 'Center for Eye Research Australia';
	    $institution->remote_id = 'CERA';
	    $institution->contact = $contact->id;
	    $institution->source_id = $source->id;
	    $institution->save();

	    $site = new Site;
	    $site->name = 'Center for Eye Research Australia';
	    $site->remote_id = 'CERA';
	    $site->short_name = 'CERA';
	    $site->telephone = '0399298360';
	    $site->institution_id = $institution->id;
	    $site->contact_id = $contact->id;
	    $site->source_id = $source->id;
	    $site->save();

	    $address = new Address;
	    $address->address1 = 'Level 7';
	    $address->address2 = '32 Gisborne St';
	    $address->city = 'East Melbourne';
	    $address->county = 'VIC';
	    $address->country_id = 15;
	    $address->contact_id = $contact->id;
	    $address->date_end = null;
	    $address->save();
	}

	public function safeDown()
	{

	}

}