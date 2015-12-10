<?php
$EM_CONF[$_EXTKEY] = array(
	'title' => 'BERGWERK Address',
	'description' => 'Manage addresses, display a list of all addresses, define a custom order and display detail views of every address.',
	'category' => 'plugin',
	'version' => '0.4.0',
	'state' => 'alpha',
	'author' => 'Daniel Maier',
	'author_email' => 'dm@bergwerk.ag',
	'author_company' => 'BERGWERK Werbeagentur GmbH',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.2.0-7.6.99',
			'bwrk_utility' => '1.0.0-1.9.99'
		),
		'conflicts' => array(),
		'suggests' => array()
	)
);
