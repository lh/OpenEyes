<?php

class m170821_053800_cera_clean extends CDbMigration
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
	    Yii::app()->db->createCommand('
            USE openeyes;
            
            DROP PROCEDURE IF EXISTS  make_cera;
            CREATE PROCEDURE make_cera()
            BEGIN
              DECLARE contact_id, import_source_id, institution_id INT;
            
              INSERT INTO openeyes.import_source
              (name, created_user_id, last_modified_user_id, created_date, last_modified_date)
              VALUES  (\'Fivium Australia\', 1, 1, NOW(), NOW());
              SET import_source_id = LAST_INSERT_ID();
              COMMIT;
            
              INSERT INTO openeyes.contact (nick_name, primary_phone, title, first_name, last_name, qualifications, last_modified_user_id, last_modified_date, created_user_id, created_date, contact_label_id, maiden_name)
              VALUES (\'NULL\', \'NULL\', null, \'\', \'\', null, 1, NOW(), 1, NOW(), null, null);
              SET contact_id = LAST_INSERT_ID();
              COMMIT;
            
              INSERT INTO openeyes.institution
              (name, remote_id, last_modified_user_id, last_modified_date, created_user_id, created_date, short_name, contact_id, source_id, active)
              VALUES (\'Center for Eye Research Australia\', \'CERA\', 1, NOW(), 1, NOW(), \'\', contact_id, import_source_id, 1);
              set institution_id = LAST_INSERT_ID();
              COMMIT;
            
              INSERT INTO openeyes.site
              (name, remote_id, short_name, location_code, fax, telephone, last_modified_user_id, last_modified_date, created_user_id, created_date, institution_id, location, contact_id, replyto_contact_id, source_id, active)
              VALUES (\'Center for Eye Research Australia\', \'CERA\', \'CERA\', \'\', \'\', \'0399298360\', 1, NOW(), 1, NOW(), institution_id, \'\', contact_id, null, import_source_id, 1);
              COMMIT;
            END;
            CALL make_cera;
            DROP PROCEDURE IF EXISTS make_cera;
            //
	    ')->execute();

	}

	public function safeDown()
	{

	}

}