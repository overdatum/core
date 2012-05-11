<div id="main">
	<div class="page-header">
		<h1>Update the account for "<?= $account->name ?>"</h1>
	</div>

	<?= Form::open($url.'account/edit/'.$account->id, 'PUT', array('class' => 'form-horizontal')) ?>
		<?= Form::field('text', 'name', 'Name', array(Input::old('name', $account->name)), array('error' => $errors->first('name'))) ?>
		<?= Form::field('text', 'email', 'E-mail address', array(Input::old('email', $account->email)), array('error' => $errors->first('email'))) ?>
		<?= Form::field('text', 'password', 'New password', array(), array('error' => $errors->first('password'))) ?>
		<?= Form::field('select', 'role_ids[]', 'Roles', array($roles, $active_roles, array('multiple' => 'multiple')), array('error' => $errors->first('password'))) ?>
		<?= Form::field('select', 'language_id', 'Language', array($languages, array($account->language->id)), array('error' => $errors->first('language_id'))) ?>

		<?= Form::actions(array(Form::submit('Save changes', array('class' => 'btn btn-large btn-primary')))) ?>
	<?= Form::close() ?>
</div>