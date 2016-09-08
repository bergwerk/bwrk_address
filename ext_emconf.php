<?php
$EM_CONF[$_EXTKEY] = array(
	'title' => 'BERGWERK Address',
	'description' => 'Manage addresses, display a list of all addresses, or display a single entry - detail pages are also an option.',
	'category' => 'plugin',
	'version' => '2.0.1',
	'state' => 'stable',
	'author' => 'Daniel Maier',
	'author_email' => 'typo3@bergwerk.ag',
	'author_company' => 'BERGWERK Werbeagentur GmbH',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.2.0-7.6.99',
			'bwrk_utility' => '2.0.0-2.99.99'
		),
		'conflicts' => array(),
		'suggests' => array()
	)
);
