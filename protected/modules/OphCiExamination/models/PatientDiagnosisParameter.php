<?php

/**
 * Class PatientDiagnosisParameter
 */
class PatientDiagnosisParameter extends CaseSearchParameter implements DBProviderInterface
{
    /**
     * @var string $term
     */
    public $term;

    /**
     * @var integer $firm_id
     */
    public $firm_id;

    /**
     * PatientAgeParameter constructor. This overrides the parent constructor so that the name can be immediately set.
     * @param string $scenario
     */
    public function __construct($scenario = '')
    {
        parent::__construct($scenario);
        $this->name = 'diagnosis';
        $this->operation = 'LIKE';
    }

    public function getLabel()
    {
        return 'Diagnosis';
    }

    /**
     * Override this function for any new attributes added to the subclass. Ensure that you invoke the parent function first to obtain and augment the initial list of attribute names.
     * @return array An array of attribute names.
     */
    public function attributeNames()
    {
        return array_merge(parent::attributeNames(), array('term', 'firm_id'));
    }

    /**
     * Override this function if the parameter subclass has extra validation rules. If doing so, ensure you invoke the parent function first to obtain the initial list of rules.
     * @return array The validation rules for the parameter.
     */
    public function rules()
    {
        return array_merge(parent::rules(), array(
                array('term', 'required'),
                array('term, firm_id', 'safe'),
            )
        );
    }

    public function renderParameter($id)
    {
        $ops = array(
            'LIKE' => 'Diagnosed with',
            'NOT LIKE' => 'Not diagnosed with',
        );
        $firmModel = new Firm();

        $firms = $firmModel->getListWithSpecialties();
        ?>
      <div class="row field-row">
        <div class="large-2 column">
            <?php echo CHtml::label($this->getLabel(), false); ?>
        </div>
        <div class="large-3 column">
            <?php echo CHtml::activeDropDownList($this, "[$id]operation", $ops, array('prompt' => 'Select One...')); ?>
            <?php echo CHtml::error($this, "[$id]operation"); ?>
        </div>

        <div class="large-3 column">
            <?php
            $html = Yii::app()->controller->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => $this->name . $this->id,
                'model' => $this,
                'attribute' => "[$id]term",
                'source' => Yii::app()->controller->createUrl('AutoComplete/commonDiagnoses'),
                'options' => array(
                    'minLength' => 2,
                ),
                'htmlOptions' => array(
                    'placeholder' => 'Type to search for a diagnosis',
                ),
            ), true);
            Yii::app()->clientScript->render($html);
            echo $html;
            ?>
            <?php echo CHtml::error($this, "[$id]term"); ?>
        </div>
        <div class="large-4 column">
          <div class="row field-row">
            <div class="large-2 column">
              <p>by</p>
            </div>
            <div class="large-10 column end">
                <?php echo CHtml::activeDropDownList($this, "[$id]firm_id", $firms,
                    array('empty' => 'Any ' . Firm::contextLabel())); ?>
            </div>
          </div>
        </div>
      </div>

        <?php
    }

    /**
     * Generate a SQL fragment representing the subquery of a FROM condition.
     * @param $searchProvider DBProvider The search provider. This is used to determine whether or not the search provider is using SQL syntax.
     * @return string The constructed query string.
     * @throws CHttpException
     */
    public function query($searchProvider)
    {
        $query = "SELECT p.id
FROM patient p
JOIN patient_diagnosis_assignment paa
  ON paa.patient_id = p.id
JOIN disorder d
  ON d.id = paa.disorder_id
WHERE LOWER(d.term) LIKE LOWER(:p_d_value_$this->id)

UNION

SELECT p2.id
FROM patient p2 
JOIN patient_systemic_diagnosis psd
  ON psd.patient_id = p2.id
JOIN disorder d2
  ON d2.id = psd.disorder_id
WHERE LOWER(d2.term) LIKE LOWER(:p_d_value_$this->id)

UNION

SELECT p3.id
FROM patient p3 
JOIN secondary_diagnosis sd
  ON sd.patient_id = p3.id
JOIN disorder d3
  ON d3.id = sd.disorder_id
WHERE LOWER(d3.term) LIKE LOWER(:p_d_value_$this->id)";
        if ($this->firm_id !== '' && $this->firm_id !== null) {
            $query = "SELECT DISTINCT p.id 
FROM patient p
JOIN patient_diagnosis_assignment paa
  ON paa.patient_id = p.id
JOIN disorder d
  ON d.id = paa.disorder_id
JOIN et_ophciexamination_diagnoses et_diag
  ON et_diag.id = paa.element_diagnoses_id
JOIN latest_diagnosis_examination_events latest
  ON latest.event_id = et_diag.event_id
  AND latest.patient_id = p.id
JOIN event e
  ON e.id = latest.event_id
JOIN episode ep
  ON ep.id = e.episode_id
WHERE LOWER(d.term) LIKE LOWER(:p_d_value_$this->id)
  AND ep.firm_id = :p_d_firm_$this->id
  
UNION

SELECT p2.id
FROM patient p2 
JOIN patient_systemic_diagnosis psd
  ON psd.patient_id = p2.id
JOIN disorder d2
  ON d2.id = psd.disorder_id
JOIN et_ophciexamination_systemic_diagnoses et_systemic
  ON et_systemic.id = psd.element_id
JOIN latest_systemic_examination_events latest2
  ON latest2.event_id = et_systemic.event_id
  AND latest2.patient_id = p2.id
JOIN event e2
  ON e2.id = latest2.event_id
JOIN episode ep2
  ON ep2.id = e2.episode_id
WHERE LOWER(d2.term) LIKE LOWER(:p_d_value_$this->id)
  AND ep2.firm_id = :p_d_firm_$this->id";
        }
        switch ($this->operation) {
            case 'LIKE':
                // Do nothing extra.
                break;
            case 'NOT LIKE':
                $query = "SELECT DISTINCT p1.id
FROM patient p1
WHERE p1.id NOT IN (
  $query
)";
                break;
            default:
                throw new CHttpException(400, 'Invalid operator specified.');
                break;
        }

        return $query;
    }

    /**
     * Get the list of bind values for use in the SQL query.
     * @return array An array of bind values. The keys correspond to the named binds in the query string.
     */
    public function bindValues()
    {
        if ($this->firm_id !== '' && $this->firm_id !== null) {
            return array(
                "p_d_value_$this->id" => '%' . $this->term . '%',
                "p_d_firm_$this->id" => $this->firm_id,
            );
        }

        return array(
            "p_d_value_$this->id" => '%' . $this->term . '%',
        );
    }

    /**
     * @inherit
     */
    public function getAuditData()
    {
        if ($this->firm_id !== '' && $this->firm_id !== null) {
            $firm = Firm::model()->findByPk($this->firm_id);

            return "$this->name: $this->operation \"$this->term\" diagnosed by {$firm->getNameAndSubspecialty()}";
        }

        return "$this->name: $this->operation \"$this->term\"";
    }
}
