<?php
/**
 * OpenEyes.
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.openeyes.org.uk
 *
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/agpl-3.0.html The GNU Affero General Public License V3.0
 */

return array(
    'patient1' => array(
        'id' => 1,
        'pas_key' => '123',
        'title' => 'Mr.',
        'first_name' => 'John',
        'last_name' => 'Jones',
        'dob' => (new DateTime())->modify('-47 year')->format('Y-m-d'),
        'gender' => 'M',
        'hos_num' => 12345,
        'nhs_num' => 54321,
        'practice_id' => 1,
        'address_id' => 1,
        'contact_id' => 1,
    ),
    'patient2' => array(
        'id' => 2,
        'pas_key' => '456',
        'title' => 'Mr.',
        'dob' => (new DateTime())->modify('-45 year')->format('Y-m-d'),
        'gender' => 'M',
        'first_name' => 'John',
        'last_name' => 'Jones',
        'hos_num' => 23456,
        'nhs_num' => 65432,
        'practice_id' => 2,
        'address_id' => 2,
        'contact_id' => 2,
    ),
    'patient3' => array(
        'id' => 3,
        'pas_key' => '789',
        'title' => 'Mrs.',
        'first_name' => 'Katherine',
        'last_name' => 'Smith',
        'dob' => (new DateTime())->modify('-57 year')->format('Y-m-d'),
        'gender' => 'F',
        'hos_num' => 34567,
        'nhs_num' => 76543,
        'practice_id' => 3,
        'address_id' => 3,
        'contact_id' => 3,
    ),
    'patient4' => array(
        'id' => 4,
        'pas_key' => '123',
        'title' => 'Mrs.',
        'first_name' => 'Carla',
        'last_name' => 'Bruni',
        'dob' => (new DateTime())->modify('-40 year')->format('Y-m-d'),
        'gender' => 'F',
        'hos_num' => 34321,
        'nhs_num' => 76567,
        'practice_id' => 3,
        'practice_id' => 3,
        'address_id' => 4,
        'contact_id' => 4,
    ),
    'patient5' => array(
        'id' => 5,
        'pas_key' => '1010',
        'title' => 'Mrs',
        'first_name' => 'Carla',
        'last_name' => 'Bruni',
        'dob' => (new DateTime())->modify('-40 year')->format('Y-m-d'),
        'gender' => 'F',
        'hos_num' => 34322,
        'nhs_num' => 76568,
        'practice_id' => 3,
        'practice_id' => 3,
        'address_id' => 4,
        'contact_id' => 5,
    ),
    'patient6' => array(
        'id' => 6,
        'pas_key' => '10107',
        'title' => 'Mrs',
        'first_name' => 'Carla',
        'last_name' => 'Bruni',
        'dob' => (new DateTime())->modify('-40 year')->format('Y-m-d'),
        'gender' => 'F',
        'hos_num' => 34323,
        'nhs_num' => 76569,
        'practice_id' => 3,
        'practice_id' => 3,
        'address_id' => 4,
        'contact_id' => 6,
    ),

    'patient7' => array(
        'id' => 7,
        'pas_key' => '1010',
        'title' => 'Mrs',
        'first_name' => 'Carla',
        'last_name' => 'Bruni',
        'dob' => (new DateTime())->modify('-40 year')->format('Y-m-d'),
        'gender' => 'F',
        'hos_num' => 34322,
        'nhs_num' => 76568,
        'practice_id' => 3,
        'practice_id' => 3,
        'address_id' => 4,
        'contact_id' => 5,
        'is_local' => 0,
    ),
    'patient8' => array(
        'id' => 8,
        'pas_key' => '10107',
        'title' => 'Mrs',
        'first_name' => 'Carla',
        'last_name' => 'Bruni',
        'dob' => (new DateTime())->modify('-40 year')->format('Y-m-d'),
        'gender' => 'F',
        'hos_num' => 34323,
        'nhs_num' => 76569,
        'practice_id' => 3,
        'practice_id' => 3,
        'address_id' => 4,
        'contact_id' => 6,
        'is_local' => 0,
    ),
    'patient9' => array(
        'id' => 9,
        'pas_key' => '10109',
        'title' => 'Mrs',
        'first_name' => 'Agne',
        'last_name' => 'Bray',
        'dob' => (new DateTime())->modify('-40 year')->format('Y-m-d'),
        'gender' => 'F',
        'hos_num' => 34323,
        'nhs_num' => 76570,
        'practice_id' => 3,
        'address_id' => 4,
        'contact_id' => 6,
        'is_local' => 0,
        'is_deceased' => 1,
        'date_of_death' => '2000-01-01'
    ),

);
