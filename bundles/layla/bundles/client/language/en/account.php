<?php

return array(

	'index' => array(
		'title' => 'Accounts',
		'table' => array(
			'name' => 'name',
			'email' => 'email',
			'roles' => 'roles',
			'no_results' => 'There are no accounts yet, add one!'
		),
		'buttons' => array(
			'add' => 'Add account'
		)
	),
	
	'add' => array(
		'title' => 'Create Account',
		'form' => array(
			'name' => 'Name',
			'email' => 'E-mail address',
			'password' => 'Password',
			'roles' => 'Roles',
			'language' => 'Language'
		),
		'buttons' => array(
			'add' => 'Add account'
		)
	),
	
	'edit' => array(
		'title' => 'Edit Account',
		'form' => array(
			'name' => 'Name',
			'email' => 'E-mail address',
			'password' => 'Password',
			'roles' => 'Roles',
			'language' => 'Language'
		),
		'buttons' => array(
			'edit' => 'Save changes'
		)
	),
	
	'delete' => array(
		'title' => 'Are you sure?',
		'message' => 'You are about to delete the account for ":name (:email)". <b>If you do, there is no turning back!</b>',
		'buttons' => array(
			'delete' => 'Delete account',
			'cancel' => 'Nope, I changed my mind'
		)
	)

);