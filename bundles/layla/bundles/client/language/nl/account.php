<?php

return array(

	'index' => array(
		'title' => 'Accounts',
		'table' => array(
			'name' => 'naam',
			'email' => 'email adres',
			'roles' => 'rollen',
			'no_results' => 'Er zijn geen accounts gevonden, voeg er een toe!'
		),
		'buttons' => array(
			'add' => 'Account toevoegen'
		)
	),
	
	'add' => array(
		'title' => 'Account maken',
		'form' => array(
			'name' => 'Naam',
			'email' => 'E-mail adres',
			'password' => 'Wachtwoord',
			'roles' => 'Rollen',
			'language' => 'Taal'
		),
		'buttons' => array(
			'add' => 'Account toevoegen'
		)
	),
	
	'edit' => array(
		'title' => 'Account wijzigen',
		'form' => array(
			'name' => 'Naam',
			'email' => 'E-mail adres',
			'password' => 'Wachtwoord',
			'roles' => 'Rollen',
			'language' => 'Taal'
		),
		'buttons' => array(
			'edit' => 'Wijzigingen opslaan'
		)
	),
	
	'delete' => array(
		'title' => 'Weet u het zeker?',
		'message' => 'U staat op het punt om het account te verwijderen van ":name (:email)". <b>U kunt deze stap hierna niet ongedaan maken!</b>',
		'buttons' => array(
			'delete' => 'Account verwijderen',
			'cancel' => 'Nee, ik heb me bedacht'
		)
	)

);