<?php
/**
 * OpenEyes.
 *
 * 
 * Copyright OpenEyes Foundation, 2017
 *
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.openeyes.org.uk
 *
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright 2017, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/agpl-3.0.html The GNU Affero General Public License V3.0
 */
class PatientSearch
{
    // NHS number (assume 10 digit number is an NHS number)
    const NHS_NUMBER_REGEX_1 = '/^(N|NHS)\s*[:;]\s*([0-9\- ]+)$/i';
    const NHS_NUMBER_REGEX_2 = '/^([0-9]{1,}[- ]?[0-9]{1,}[- ]?[0-9]{1,})$/i';
    
    // Hospital number (assume a < 10 digit number is a hosnum)
    const HOSPITAL_NUMBER_REGEX = '/^(H|Hosnum)\s*[:;]\s*([0-9\- ]+)$/i';

    // Patient name
    const PATIENT_NAME_REGEX = '/^(?:P(?:atient)?[:;\s]+)?([\a-zA-Z-]+[ ,]?[\a-zA-Z-]*)$/';


    private $searchTerms = array();

    public $use_pas = true;

    /**
     * Suppress PAS integration.
     *
     * @return Patient
     */
    public function noPas()
    {
        // Clone to avoid singleton problems with use_pas flag
        $model = clone $this;
        $model->use_pas = false;

        return $model;
    }

    /**
     * Checking the search term if it is a NHS number, Hospital number or Patient name.
     *
     * @param string $term
     */
    public function parseTerm($term)
    {
        $term = trim($term);

        $search_terms = array(
            'hos_num' => null,
            'nhs_num' => null,
            'patient_name' => null,
        );

        // NHS number
        if ($nhs = $this->getNHSnumber($term)) {
            $search_terms['nhs_num'] = $nhs;
        // Hospital number
        } elseif ($hos_num = $this->getHospitalNumber($term)) {
            $search_terms['hos_num'] = $hos_num;
        // Patient name
        } elseif ($name = $this->getPatientName($term)) {
            $search_terms['patient_name'] = trim($name['patient_name']);
        }
        $this->searchTerms = CHtml::encodeArray($search_terms);

        return $this->searchTerms;
    }

    /**
     * Searching for patients.
     * 
     * @param string $term search term
     */
    public function search($term)
    {
        $search_terms = $this->parseTerm($term);

        $patient = new Patient();

        $patient->hos_num = $search_terms['hos_num'];
        $patient->nhs_num = $search_terms['nhs_num'];

        // Get the valuse from URL
        $currentPage = Yii::app()->request->getParam('Patient_page');
        $pageSize = Yii::app()->request->getParam('pageSize', 20);

        // if no GET param we try to fetch the value from the $criteria, default value 0 is none of them set
        $sortDir = Yii::app()->request->getParam('sort_dir', 0);
        $sortDir = ($sortDir == 0 || $sortDir == 'asc') ? 'asc' : 'desc';

        $sortBy = Yii::app()->request->getParam('sort_by');
        switch ($sortBy) {
                case 0:
                        $sortBy = 'hos_num*1';
                        break;
                case 1:
                        $sortBy = 'title';
                        break;
                case 2:
                        $sortBy = 'first_name';
                        break;
                case 3:
                        $sortBy = 'last_name';
                        break;
                case 4:
                        $sortBy = 'dob';
                        break;
                case 5:
                        $sortBy = 'gender';
                        break;
                case 6:
                        $sortBy = 'nhs_num*1';
                        break;
                default:
                        $sortBy = 'hos_num*1';
        }

        $patientCriteria = array(
            'pageSize' => $pageSize,
            'sortBy' => $sortBy,
            'sortDir' => $sortDir,
            'currentPage' => $currentPage,
            'hos_num' => CHtml::decode($search_terms['hos_num']),
            'nhs_num' => CHtml::decode($search_terms['nhs_num']),
            'patient_name'=>CHtml::decode($search_terms['patient_name']),
        );

        if( $this->use_pas == false ){
            $patient->use_pas = false;
        }

        $dataProvider = $patient->search($patientCriteria);

        return $dataProvider;
    }

    public function getSearchTerms()
    {
        return $this->searchTerms;
    }

    /**
     * Tries to fetch NHS Number from the search term.
     *
     * @param array|null $result
     */
    public function getNHSnumber($term)
    {
        $result = null;
        if (preg_match(self::NHS_NUMBER_REGEX_1, $term, $matches) || preg_match(self::NHS_NUMBER_REGEX_2, $term, $matches)) {
            $nhs = (isset($matches[2])) ? $matches[2] : $matches[1];
            $nhs = str_replace(array('-', ' '), '', $nhs);
            $result = $nhs;
        }

        return $result;
    }

    /**
     * Tries to fetch Hospital Number from the search term.
     *
     * @param array|null $result
     */
    public function getHospitalNumber($term)
    {
        $result = null;
        if (preg_match(self::HOSPITAL_NUMBER_REGEX, $term, $matches) || preg_match(Yii::app()->params['hos_num_regex'], $term, $matches)) {
            $hosnum = (isset($matches[2])) ? $matches[2] : $matches[1];
            $result = $hosnum;
        }

        return $result;
    }

    /**
     * Tries to fetch Patient name from the search term.
     *
     * @param array|null $result
     */
    public function getPatientName($term)
    {
        $result = null;
        if (preg_match(self::PATIENT_NAME_REGEX, $term, $m)) {
            $name = $m[1];
            if (strpos($name, ',') !== false) {
                list($surname, $firstname) = explode(',', $name, 2);
                $patientname = $firstname.' '.$surname;
            } else {
                $patientname = $name;
            }
            $result['patient_name'] = trim($patientname);
        }
        return $result;
    }

    /**
     * Fetch contact name and title from search term
     */
    public function getContactTitleName($term)
    {
        $contacts_result = Contact::model()->findAll(array('select'=>'title', 'distinct'=>true,));
        $titles = array();
        foreach ($contacts_result as $contact) {
            array_push($titles, strtolower($contact['title']));
        }

        $terms = explode(' ', $term, 3);
        $result = null;
        $result['contact_name'] = array();
        foreach ($terms as $term){
            if (in_array($term, $titles)) {
                $result['title'] = $term;
            } else {
                array_push($result['contact_name'], $term);
            }
        }
        return $result;
    }

    /**
     * Checks if the term is a NHS number, Hospital number or Patient name.
     *
     * @param string $term
     *
     * @return bool
     */
    public function isValidSearchTerm($term)
    {
        if ($this->getNHSnumber($term) || $this->getHospitalNumber($term) || $this->getPatientName($term)) {
            return true;
        }

        return false;
    }
}
