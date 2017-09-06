<?php

class m170821_053800_cera_clean extends OEMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $source = new ImportSource;
        $source->name = 'Fivium Australia';
        if (!$source->save()) {
            throw new CDbException('Unable to save source: ' . print_r($source->getErrors(), true));
        }

        $contact = new Contact;
        if (!$contact->save()) {
            throw new CDbException('Unable to save contact: ' . print_r($contact->getErrors(), true));
        }

        $institution = new Institution;
        $institution->name = 'Centre for Eye Research Australia';
        $institution->remote_id = 'CERA';
        $institution->contact_id = $contact->id;
        $institution->source_id = $source->id;
        if (!$institution->save()) {
            throw new CDbException('Unable to save institution: ' . print_r($institution->getErrors(), true));
        }

        $site = new Site;
        $site->name = 'Centre for Eye Research Australia';
        $site->remote_id = 'CERA';
        $site->short_name = 'CERA';
        $site->telephone = '0399298360';
        $site->institution_id = $institution->id;
        $site->contact_id = $contact->id;
        $site->source_id = $source->id;
        if (!$site->save()) {
            throw new CDbException('Unable to save site: ' . print_r($site->getErrors(), true));
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
            throw new CDbException('Unable to save address: ' . print_r($address->getErrors(), true));
        }
    }

    public function safeDown()
    {
        echo "m170821_053800_cera_clean does not support migration down.\n";

        return false;
    }

}