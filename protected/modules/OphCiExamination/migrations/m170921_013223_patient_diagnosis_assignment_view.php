<?php

class m170921_013223_patient_diagnosis_assignment_view extends CDbMigration
{
    public function createView($view_name, $select)
    {
        $this->dbConnection->createCommand('create view ' . $view_name . ' as ' . $select)->execute();
    }

    public function dropView($view_name)
    {
        $this->dbConnection->createCommand('drop view ' . $view_name)->execute();
    }

    public function up()
    {
        $this->createView('diagnosis_examination_events', <<<EOSQL
select event_date, event.created_date, event_id, patient_id from et_ophciexamination_diagnoses et
join event on et.event_id = event.id
join episode on event.episode_id = episode.id
EOSQL
        );
        $this->createView('latest_diagnosis_examination_events', <<<EOSQL
select t1.event_id, t1.patient_id from diagnosis_examination_events t1
left outer join diagnosis_examination_events t2
on t1.patient_id = t2.patient_id
   and (t1.event_date < t2.event_date
   		or (t1.event_date = t2.event_date and t1.created_date < t2.created_date))
where t2.patient_id is null
EOSQL
        );
        $this->createView('patient_diagnosis_assignment', <<<EOSQL
select
  aa.id,
  latest.patient_id as patient_id,
  aa.element_diagnoses_id,
  aa.disorder_id,
  aa.eye_id,
  aa.principal,
  aa.last_modified_user_id,
  aa.last_modified_date,
  aa.created_user_id,
  aa.created_date
from ophciexamination_diagnosis as aa 
  join et_ophciexamination_diagnoses element on aa.element_diagnoses_id = element.id
  join latest_diagnosis_examination_events latest on element.event_id = latest.event_id
EOSQL
        );
    }

    public function down()
    {
        $this->dropView('patient_diagnosis_assignment');
        $this->dropView('latest_diagnosis_examination_events');
        $this->dropView('diagnosis_examination_events');
    }
}