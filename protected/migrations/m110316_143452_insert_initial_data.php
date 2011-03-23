<?php

class m110316_143452_insert_initial_data extends CDbMigration
{
    public function up()
    {
		// table name => insert statement
		$queries = array(
			'authassignment' => "INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('admin', '1', NULL, 'N;');",
			'authitem' => "INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Rbac', 0, 'Rbac', NULL, 'N;'),
('admin', 2, '', NULL, 'N;');",
			'authitemchild' => "INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('admin', 'Rbac');",
			'contact_type' => "INSERT INTO `contact_type` (`id`, `name`, `macro_only`) VALUES
(1, 'GP', 0),
(2, 'Ophthalmologist', 0),
(3, 'Optometrist', 0),
(4, 'Specialist', 0),
(5, 'Social Worker', 0),
(6, 'Health Visitor', 0),
(7, 'Solicitor', 0),
(8, 'Patient', 1);",
			'country' => "INSERT INTO `country` (`id`, `code`, `name`) VALUES
(1, 'GB', 'United Kingdom'),
(2, 'AF', 'Afghanistan'),
(3, 'AX', 'Aland Islands'),
(4, 'AL', 'Albania'),
(5, 'DZ', 'Algeria'),
(6, 'AS', 'American Samoa'),
(7, 'AD', 'Andorra'),
(8, 'AO', 'Angola'),
(9, 'AI', 'Anguilla'),
(10, 'AQ', 'Antarctica'),
(11, 'AG', 'Antigua and Barbuda'),
(12, 'AR', 'Argentina'),
(13, 'AM', 'Armenia'),
(14, 'AW', 'Aruba'),
(15, 'AU', 'Australia'),
(16, 'AT', 'Austria'),
(17, 'AZ', 'Azerbaijan'),
(18, 'BS', 'Bahamas'),
(19, 'BH', 'Bahrain'),
(20, 'BD', 'Bangladesh'),
(21, 'BB', 'Barbados'),
(22, 'BY', 'Belarus'),
(23, 'BE', 'Belgium'),
(24, 'BZ', 'Belize'),
(25, 'BJ', 'Benin'),
(26, 'BM', 'Bermuda'),
(27, 'BT', 'Bhutan'),
(28, 'BO', 'Bolivia, Plurinational State of'),
(29, 'BQ', 'Bonaire, Saint Eustatius and Saba'),
(30, 'BA', 'Bosnia and Herzegovina'),
(31, 'BW', 'Botswana'),
(32, 'BV', 'Bouvet Island'),
(33, 'BR', 'Brazil'),
(34, 'IO', 'British Indian Ocean Territory'),
(35, 'BN', 'Brunei Darussalam'),
(36, 'BG', 'Bulgaria'),
(37, 'BF', 'Burkina Faso'),
(38, 'BI', 'Burundi'),
(39, 'KH', 'Cambodia'),
(40, 'CM', 'Cameroon'),
(41, 'CA', 'Canada'),
(42, 'CV', 'Cape Verde'),
(43, 'KY', 'Cayman Islands'),
(44, 'CF', 'Central African Republic'),
(45, 'TD', 'Chad'),
(46, 'CL', 'Chile'),
(47, 'CN', 'China'),
(48, 'CX', 'Christmas Island'),
(49, 'CC', 'Cocos (Keeling) Islands'),
(50, 'CO', 'Colombia'),
(51, 'KM', 'Comoros'),
(52, 'CG', 'Congo'),
(53, 'CD', 'Congo, The Democratic Republic of the'),
(54, 'CK', 'Cook Islands'),
(55, 'CR', 'Costa Rica'),
(56, 'CI', 'Cote D''ivoire'),
(57, 'HR', 'Croatia'),
(58, 'CU', 'Cuba'),
(59, 'CW', 'Curacao'),
(60, 'CY', 'Cyprus'),
(61, 'CZ', 'Czech Republic'),
(62, 'DK', 'Denmark'),
(63, 'DJ', 'Djibouti'),
(64, 'DM', 'Dominica'),
(65, 'DO', 'Dominican Republic'),
(66, 'EC', 'Ecuador'),
(67, 'EG', 'Egypt'),
(68, 'SV', 'El Salvador'),
(69, 'GQ', 'Equatorial Guinea'),
(70, 'ER', 'Eritrea'),
(71, 'EE', 'Estonia'),
(72, 'ET', 'Ethiopia'),
(73, 'FK', 'Falkland Islands (Malvinas)'),
(74, 'FO', 'Faroe Islands'),
(75, 'FJ', 'Fiji'),
(76, 'FI', 'Finland'),
(77, 'FR', 'France'),
(78, 'GF', 'French Guiana'),
(79, 'PF', 'French Polynesia'),
(80, 'TF', 'French Southern Territories'),
(81, 'GA', 'Gabon'),
(82, 'GM', 'Gambia'),
(83, 'GE', 'Georgia'),
(84, 'DE', 'Germany'),
(85, 'GH', 'Ghana'),
(86, 'GI', 'Gibraltar'),
(87, 'GR', 'Greece'),
(88, 'GL', 'Greenland'),
(89, 'GD', 'Grenada'),
(90, 'GP', 'Guadeloupe'),
(91, 'GU', 'Guam'),
(92, 'GT', 'Guatemala'),
(93, 'GG', 'Guernsey'),
(94, 'GN', 'Guinea'),
(95, 'GW', 'Guinea-Bissau'),
(96, 'GY', 'Guyana'),
(97, 'HT', 'Haiti'),
(98, 'HM', 'Heard Island and McDonald Islands'),
(99, 'VA', 'Holy See (Vatican City State)'),
(100, 'HN', 'Honduras'),
(101, 'HK', 'Hong Kong'),
(102, 'HU', 'Hungary'),
(103, 'IS', 'Iceland'),
(104, 'IN', 'India'),
(105, 'ID', 'Indonesia'),
(106, 'IR', 'Iran, Islamic Republic of'),
(107, 'IQ', 'Iraq'),
(108, 'IE', 'Ireland'),
(109, 'IM', 'Isle of Man'),
(110, 'IL', 'Israel'),
(111, 'IT', 'Italy'),
(112, 'JM', 'Jamaica'),
(113, 'JP', 'Japan'),
(114, 'JE', 'Jersey'),
(115, 'JO', 'Jordan'),
(116, 'KZ', 'Kazakhstan'),
(117, 'KE', 'Kenya'),
(118, 'KI', 'Kiribati'),
(119, 'KP', 'Korea, Democratic People''s Republic of'),
(120, 'KR', 'Korea, Republic of'),
(121, 'KW', 'Kuwait'),
(122, 'KG', 'Kyrgyzstan'),
(123, 'LA', 'Lao People''s Democratic Republic'),
(124, 'LV', 'Latvia'),
(125, 'LB', 'Lebanon'),
(126, 'LS', 'Lesotho'),
(127, 'LR', 'Liberia'),
(128, 'LY', 'Libyan Arab Jamahiriya'),
(129, 'LI', 'Liechtenstein'),
(130, 'LT', 'Lithuania'),
(131, 'LU', 'Luxembourg'),
(132, 'MO', 'Macao'),
(133, 'MK', 'Macedonia, The Former Yugoslav Republic of'),
(134, 'MG', 'Madagascar'),
(135, 'MW', 'Malawi'),
(136, 'MY', 'Malaysia'),
(137, 'MV', 'Maldives'),
(138, 'ML', 'Mali'),
(139, 'MT', 'Malta'),
(140, 'MH', 'Marshall Islands'),
(141, 'MQ', 'Martinique'),
(142, 'MR', 'Mauritania'),
(143, 'MU', 'Mauritius'),
(144, 'YT', 'Mayotte'),
(145, 'MX', 'Mexico'),
(146, 'FM', 'Micronesia, Federated States of'),
(147, 'MD', 'Moldova, Republic of'),
(148, 'MC', 'Monaco'),
(149, 'MN', 'Mongolia'),
(150, 'ME', 'Montenegro'),
(151, 'MS', 'Montserrat'),
(152, 'MA', 'Morocco'),
(153, 'MZ', 'Mozambique'),
(154, 'MM', 'Myanmar'),
(155, 'NA', 'Namibia'),
(156, 'NR', 'Nauru'),
(157, 'NP', 'Nepal'),
(158, 'NL', 'Netherlands'),
(159, 'NC', 'New Caledonia'),
(160, 'NZ', 'New Zealand'),
(161, 'NI', 'Nicaragua'),
(162, 'NE', 'Niger'),
(163, 'NG', 'Nigeria'),
(164, 'NU', 'Niue'),
(165, 'NF', 'Norfolk Island'),
(166, 'MP', 'Northern Mariana Islands'),
(167, 'NO', 'Norway'),
(168, 'OM', 'Oman'),
(169, 'PK', 'Pakistan'),
(170, 'PW', 'Palau'),
(171, 'PS', 'Palestinian Territory, Occupied'),
(172, 'PA', 'Panama'),
(173, 'PG', 'Papua New Guinea'),
(174, 'PY', 'Paraguay'),
(175, 'PE', 'Peru'),
(176, 'PH', 'Philippines'),
(177, 'PN', 'Pitcairn'),
(178, 'PL', 'Poland'),
(179, 'PT', 'Portugal'),
(180, 'PR', 'Puerto Rico'),
(181, 'QA', 'Qatar'),
(182, 'RE', 'Reunion'),
(183, 'RO', 'Romania'),
(184, 'RU', 'Russian Federation'),
(185, 'RW', 'Rwanda'),
(186, 'BL', 'Saint Barthelemy'),
(187, 'SH', 'Saint Helena, Ascension and Tristan Da Cunha'),
(188, 'KN', 'Saint Kitts and Nevis'),
(189, 'LC', 'Saint Lucia'),
(190, 'MF', 'Saint Martin (French Part)'),
(191, 'PM', 'Saint Pierre and Miquelon'),
(192, 'VC', 'Saint Vincent and the Grenadines'),
(193, 'WS', 'Samoa'),
(194, 'SM', 'San Marino'),
(195, 'ST', 'Sao Tome and Principe'),
(196, 'SA', 'Saudi Arabia'),
(197, 'SN', 'Senegal'),
(198, 'RS', 'Serbia'),
(199, 'SC', 'Seychelles'),
(200, 'SL', 'Sierra Leone'),
(201, 'SG', 'Singapore'),
(202, 'SX', 'Sint Maarten (Dutch Part)'),
(203, 'SK', 'Slovakia'),
(204, 'SI', 'Slovenia'),
(205, 'SB', 'Solomon Islands'),
(206, 'SO', 'Somalia'),
(207, 'ZA', 'South Africa'),
(208, 'GS', 'South Georgia and the South Sandwich Islands'),
(209, 'ES', 'Spain'),
(210, 'LK', 'Sri Lanka'),
(211, 'SD', 'Sudan'),
(212, 'SR', 'Suriname'),
(213, 'SJ', 'Svalbard and Jan Mayen'),
(214, 'SZ', 'Swaziland'),
(215, 'SE', 'Sweden'),
(216, 'CH', 'Switzerland'),
(217, 'SY', 'Syrian Arab Republic'),
(218, 'TW', 'Taiwan, Province of China'),
(219, 'TJ', 'Tajikistan'),
(220, 'TZ', 'Tanzania, United Republic of'),
(221, 'TH', 'Thailand'),
(222, 'TL', 'Timor-Leste'),
(223, 'TG', 'Togo'),
(224, 'TK', 'Tokelau'),
(225, 'TO', 'Tonga'),
(226, 'TT', 'Trinidad and Tobago'),
(227, 'TN', 'Tunisia'),
(228, 'TR', 'Turkey'),
(229, 'TM', 'Turkmenistan'),
(230, 'TC', 'Turks and Caicos Islands'),
(231, 'TV', 'Tuvalu'),
(232, 'UG', 'Uganda'),
(233, 'UA', 'Ukraine'),
(234, 'AE', 'United Arab Emirates'),
(235, 'US', 'United States'),
(236, 'UM', 'United States Minor Outlying Islands'),
(237, 'UY', 'Uruguay'),
(238, 'UZ', 'Uzbekistan'),
(239, 'VU', 'Vanuatu'),
(240, 'VE', 'Venezuela, Bolivarian Republic of'),
(241, 'VN', 'Viet Nam'),
(242, 'VG', 'Virgin Islands, British'),
(243, 'VI', 'Virgin Islands, U.S.'),
(244, 'WF', 'Wallis and Futuna'),
(245, 'EH', 'Western Sahara'),
(246, 'YE', 'Yemen'),
(247, 'ZM', 'Zambia'),
(248, 'ZW', 'Zimbabwe');",
			'element_type' => "INSERT INTO `element_type` (`id`, `name`, `class_name`) VALUES
(1, 'History', 'ElementHistory'),
(2, 'Past history', 'ElementPastHistory'),
(3, 'Visual function', 'ElementVisualFunction'),
(4, 'Visual acuity', 'ElementVisualAcuity'),
(5, 'Mini-refraction', 'ElementMiniRefraction'),
(6, 'Visual fields', 'ElementVisualFields'),
(7, 'Extraocular movements', 'ElementExtraocularMovements'),
(8, 'Cranial nervers', 'ElementCranialNerves'),
(9, 'Orbital examination', 'ElementOrbitalExamination'),
(10, 'Anterior segment', 'ElementAnteriorSegment'),
(11, 'Anterior segment drawing', 'ElementAnteriorSegmentDrawing'),
(12, 'Gonioscopy', 'ElementGonioscopy'),
(13, 'Intraocular pressure', 'ElementIntraocularPressure'),
(14, 'Posterior segment', 'ElementPosteriorSegment'),
(15, 'Posterior segment drawing', 'ElementPosteriorSegmentDrawing'),
(16, 'Conclusion', 'ElementConclusion'),
(17, 'POH', 'ElementPOH'),
(18, 'FOH', 'ElementFOH'),
(19, 'PMH', 'ElementPMH'),
(20, 'Allergies', 'ElementAllergies'),
(21, 'Social History and Smoking', 'ElementSocialHistory'),
(22, 'Medication', 'ElementMedication');",
			'event_type' => "INSERT INTO `event_type` (`id`, `name`, `first_in_episode_possible`) VALUES
(17, 'amdapplication', 0),
(18, 'amdinjection', 0),
(16, 'anaesth', 0),
(13, 'bloodtest', 0),
(11, 'ctscan', 0),
(23, 'cvi', 0),
(4, 'diagnosis', 0),
(1, 'examination', 1),
(5, 'ffa', 0),
(8, 'field', 0),
(6, 'icg', 0),
(19, 'injection', 0),
(20, 'laser', 0),
(21, 'letterin', 0),
(22, 'letterout', 0),
(12, 'mriscan', 0),
(7, 'oct', 0),
(3, 'orthoptics', 0),
(15, 'preassess', 0),
(14, 'prescription', 0),
(2, 'refraction', 0),
(9, 'ultrasound', 0),
(10, 'xray', 0);",
			'firm' => "INSERT INTO `firm` (`id`, `service_specialty_assignment_id`, `pas_code`, `name`) VALUES
(1, 3, 'AEAB', 'Aylward Firm'),
(2, 4, 'ADCR', 'Collin Firm'),
(3, 5, 'CADB', 'Bessant Firm'),
(4, 6, 'EXAB', 'Allan Firm'),
(5, 7, 'MREC', 'Egan Firm');",
			'firm_user_assignment' => "INSERT INTO `firm_user_assignment` (`id`, `firm_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 5, 1);",
			'patient' => "INSERT INTO `patient` (`id`, `pas_key`, `title`, `first_name`, `last_name`, `dob`, `gender`, `hos_num`, `nhs_num`) VALUES
(1, 123, 'Mr.', 'John', 'Smith', '1970-01-01', 'M', '12345', '54321'),
(2, 456, 'Mr.', 'John', 'Jones', '1972-01-01', 'M', '23456', '65432'),
(3, 789, 'Mrs.', 'Katherine', 'Smith', '1960-01-01', 'F', '34567', '76543');",
			'possible_element_type' => "INSERT INTO `possible_element_type` (`id`, `event_type_id`, `element_type_id`, `num_views`, `order`) VALUES
(1, 1, 17, 1, 1),(2, 1, 18, 1, 1),(3, 1, 19, 1, 1),(4, 1, 20, 1, 1),(5, 1, 21, 1, 1),(6, 1, 22, 1, 1);",
			'service' => "INSERT INTO `service` (`id`, `name`) VALUES
(1, 'Accident and Emergency Service'),
(2, 'Adnexal Service'),
(3, 'Anaesthetic Service'),
(4, 'Cataract Service'),
(5, 'Corneal Service'),
(6, 'Glaucoma Service'),
(7, 'Medical Retina Service'),
(8, 'Paediatric Service'),
(9, 'Refractive Service'),
(10, 'Strabismus Service'),
(11, 'Vitreoretinal Service');",
			'service_specialty_assignment' => "INSERT INTO `service_specialty_assignment` (`id`, `service_id`, `specialty_id`) VALUES
(3, 1, 1),
(4, 2, 2),
(5, 4, 4),
(6, 5, 5),
(7, 7, 8);",
			'specialty' => "INSERT INTO `specialty` (`id`, `name`) VALUES
(1, 'Accident & Emergency'),
(2, 'Adnexal'),
(3, 'Anaesthetics'),
(4, 'Cataract'),
(5, 'Cornea'),
(6, 'External'),
(7, 'Glaucoma'),
(8, 'Medical Retina'),
(9, 'Neuro-ophthalmology'),
(10, 'Oncology'),
(11, 'Paediatrics'),
(12, 'Primary Care'),
(13, 'Refractive'),
(14, 'Strabismus'),
(15, 'Uveitis'),
(16, 'Vitreoretinal');",
			'user' => "INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `email`, `active`, `password`, `salt`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com', 1, 'd45409ef1eaa57f5041bf3a1b510097b', 'FbYJis0YG3');",
			'site_element_type' => "INSERT INTO `site_element_type` VALUES
(1, 1, 1, 1, 1, 1),(2, 1, 2, 1, 1, 1),(3, 1, 3, 1, 1, 1),(4, 1, 4, 1, 1, 1),(5, 1, 5, 1, 1, 1),(6, 1, 6, 1, 1, 1),(7, 1, 7, 1, 1, 1),(8, 1, 8, 1, 1, 1),(9, 1, 9, 1, 1, 1),(10, 1, 10, 1, 1, 1),(11, 1, 11, 1, 1, 1),(12, 1, 12, 1, 1, 1),(13, 1, 13, 1, 1, 1),(14, 1, 14, 1, 1, 1),(15, 1, 15, 1, 1, 1),(16, 1, 16, 1, 1, 1),(17, 1, 1, 1, 0, 0),(18, 1, 2, 1, 0, 0),(19, 1, 3, 1, 0, 0),(20, 1, 4, 1, 0, 0),(21, 1, 5, 1, 0, 0),(22, 1, 6, 1, 0, 0),(23, 1, 7, 1, 0, 0),(24, 1, 8, 1, 0, 0),(25, 1, 9, 1, 0, 0),(26, 1, 10, 1, 0, 0),(27, 1, 11, 1, 0, 0),(28, 1, 12, 1, 0, 0),(29, 1, 13, 1, 0, 0),(30, 1, 14, 1, 0, 0),(31, 1, 15, 1, 0, 0),(32, 1, 16, 1, 0, 0),
(33, 2, 1, 1, 1, 1),(34, 2, 2, 1, 1, 1),(35, 2, 3, 1, 1, 1),(36, 2, 4, 1, 1, 1),(37, 2, 5, 1, 1, 1),(38, 2, 6, 1, 1, 1),(39, 2, 7, 1, 1, 1),(40, 2, 8, 1, 1, 1),(41, 2, 9, 1, 1, 1),(42, 2, 10, 1, 1, 1),(43, 2, 11, 1, 1, 1),(44, 2, 12, 1, 1, 1),(45, 2, 13, 1, 1, 1),(46, 2, 14, 1, 1, 1),(47, 2, 15, 1, 1, 1),(48, 2, 16, 1, 1, 1),(49, 2, 1, 1, 0, 0),(50, 2, 2, 1, 0, 0),(51, 2, 3, 1, 0, 0),(52, 2, 4, 1, 0, 0),(53, 2, 5, 1, 0, 0),(54, 2, 6, 1, 0, 0),(55, 2, 7, 1, 0, 0),(56, 2, 8, 1, 0, 0),(57, 2, 9, 1, 0, 0),(58, 2, 10, 1, 0, 0),(59, 2, 11, 1, 0, 0),(60, 2, 12, 1, 0, 0),(61, 2, 13, 1, 0, 0),(62, 2, 14, 1, 0, 0),(63, 2, 15, 1, 0, 0),(64, 2, 16, 1, 0, 0),
(65, 3, 1, 1, 1, 1),(66, 3, 2, 1, 1, 1),(67, 3, 3, 1, 1, 1),(68, 3, 4, 1, 1, 1),(69, 3, 5, 1, 1, 1),(70, 3, 6, 1, 1, 1),(71, 3, 7, 1, 1, 1),(72, 3, 8, 1, 1, 1),(73, 3, 9, 1, 1, 1),(74, 3, 10, 1, 1, 1),(75, 3, 11, 1, 1, 1),(76, 3, 12, 1, 1, 1),(77, 3, 13, 1, 1, 1),(78, 3, 14, 1, 1, 1),(79, 3, 15, 1, 1, 1),(80, 3, 16, 1, 1, 1),(81, 3, 1, 1, 0, 0),(82, 3, 2, 1, 0, 0),(83, 3, 3, 1, 0, 0),(84, 3, 4, 1, 0, 0),(85, 3, 5, 1, 0, 0),(86, 3, 6, 1, 0, 0),(87, 3, 7, 1, 0, 0),(88, 3, 8, 1, 0, 0),(89, 3, 9, 1, 0, 0),(90, 3, 10, 1, 0, 0),(91, 3, 11, 1, 0, 0),(92, 3, 12, 1, 0, 0),(93, 3, 13, 1, 0, 0),(94, 3, 14, 1, 0, 0),(95, 3, 15, 1, 0, 0),(96, 3, 16, 1, 0, 0),
(97, 4, 1, 1, 1, 1),(98, 4, 2, 1, 1, 1),(99, 4, 3, 1, 1, 1),(100, 4, 4, 1, 1, 1),(101, 4, 5, 1, 1, 1),(102, 4, 6, 1, 1, 1),(103, 4, 7, 1, 1, 1),(104, 4, 8, 1, 1, 1),(105, 4, 9, 1, 1, 1),(106, 4, 10, 1, 1, 1),(107, 4, 11, 1, 1, 1),(108, 4, 12, 1, 1, 1),(109, 4, 13, 1, 1, 1),(110, 4, 14, 1, 1, 1),(111, 4, 15, 1, 1, 1),(112, 4, 16, 1, 1, 1),(113, 4, 1, 1, 0, 0),(114, 4, 2, 1, 0, 0),(115, 4, 3, 1, 0, 0),(116, 4, 4, 1, 0, 0),(117, 4, 5, 1, 0, 0),(118, 4, 6, 1, 0, 0),(119, 4, 7, 1, 0, 0),(120, 4, 8, 1, 0, 0),(121, 4, 9, 1, 0, 0),(122, 4, 10, 1, 0, 0),(123, 4, 11, 1, 0, 0),(124, 4, 12, 1, 0, 0),(125, 4, 13, 1, 0, 0),(126, 4, 14, 1, 0, 0),(127, 4, 15, 1, 0, 0),(128, 4, 16, 1, 0, 0),
(129, 5, 1, 1, 1, 1),(130, 5, 2, 1, 1, 1),(131, 5, 3, 1, 1, 1),(132, 5, 4, 1, 1, 1),(133, 5, 5, 1, 1, 1),(134, 5, 6, 1, 1, 1),(135, 5, 7, 1, 1, 1),(136, 5, 8, 1, 1, 1),(137, 5, 9, 1, 1, 1),(138, 5, 10, 1, 1, 1),(139, 5, 11, 1, 1, 1),(140, 5, 12, 1, 1, 1),(141, 5, 13, 1, 1, 1),(142, 5, 14, 1, 1, 1),(143, 5, 15, 1, 1, 1),(144, 5, 16, 1, 1, 1),(145, 5, 1, 1, 0, 0),(146, 5, 2, 1, 0, 0),(147, 5, 3, 1, 0, 0),(148, 5, 4, 1, 0, 0),(149, 5, 5, 1, 0, 0),(150, 5, 6, 1, 0, 0),(151, 5, 7, 1, 0, 0),(152, 5, 8, 1, 0, 0),(153, 5, 9, 1, 0, 0),(154, 5, 10, 1, 0, 0),(155, 5, 11, 1, 0, 0),(156, 5, 12, 1, 0, 0),(157, 5, 13, 1, 0, 0),(158, 5, 14, 1, 0, 0),(159, 5, 15, 1, 0, 0),(160, 5, 16, 1, 0, 0),
(161, 6, 1, 1, 1, 1),(162, 6, 2, 1, 1, 1),(163, 6, 3, 1, 1, 1),(164, 6, 4, 1, 1, 1),(165, 6, 5, 1, 1, 1),(166, 6, 6, 1, 1, 1),(167, 6, 7, 1, 1, 1),(168, 6, 8, 1, 1, 1),(169, 6, 9, 1, 1, 1),(170, 6, 10, 1, 1, 1),(171, 6, 11, 1, 1, 1),(172, 6, 12, 1, 1, 1),(173, 6, 13, 1, 1, 1),(174, 6, 14, 1, 1, 1),(175, 6, 15, 1, 1, 1),(176, 6, 16, 1, 1, 1),(177, 6, 1, 1, 0, 0),(178, 6, 2, 1, 0, 0),(179, 6, 3, 1, 0, 0),(180, 6, 4, 1, 0, 0),(181, 6, 5, 1, 0, 0),(182, 6, 6, 1, 0, 0),(183, 6, 7, 1, 0, 0),(184, 6, 8, 1, 0, 0),(185, 6, 9, 1, 0, 0),(186, 6, 10, 1, 0, 0),(187, 6, 11, 1, 0, 0),(188, 6, 12, 1, 0, 0),(189, 6, 13, 1, 0, 0),(190, 6, 14, 1, 0, 0),(191, 6, 15, 1, 0, 0),(192, 6, 16, 1, 0, 0);",

			'exam_phrase' => "INSERT INTO `exam_phrase` VALUES(1, 8, 2, 'Congenital Cataract', 0);"
		);

		$command = Yii::app()->db->createCommand('SET foreign_key_checks = 0;');
		$command->execute();

		foreach ($queries as $table => $query) {
			echo "insert into {$table}\n";
			$command = Yii::app()->db->createCommand($query);
			$command->execute();
		}

		$command = Yii::app()->db->createCommand('SET foreign_key_checks = 1;');
		$command->execute();
    }

    public function down()
    {
		$tables = array(
			'authassignment','authitem','authitemchild','contact_type','country',
			'element_type','event_type','firm','firm_user_assignment','patient',
			'possible_element_type','service','service_specialty_assignment',
			'specialty','user','site_element_type'
		);

		$command = Yii::app()->db->createCommand('SET foreign_key_checks = 0;');
		$command->execute();

		foreach ($tables as $table) {
			$this->truncateTable($table);
		}

		$command = Yii::app()->db->createCommand('SET foreign_key_checks = 1;');
		$command->execute();
    }
}