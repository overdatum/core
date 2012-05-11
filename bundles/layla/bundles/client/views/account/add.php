<div id="main">
	<div class="page-header">
		<h1>Create a new Account</h1>
	</div>
	<?= Form::open($url.'account/add', 'POST', array('class' => 'form-horizontal')) ?>
		<?= Form::field('text', 'name', 'Name', array(Input::old('name')), array('error' => $errors->first('name'))) ?>
		<?= Form::field('text', 'email', 'E-mail address', array(Input::old('email')), array('error' => $errors->first('email'))) ?>
		<?= Form::field('password', 'password', 'Password', array(), array('error' => $errors->first('password'))) ?>
		<?= Form::field('select', 'role_ids[]', 'Groups', array($roles, array(), array('multiple' => 'multiple')), array('error' => $errors->first('role_ids'))) ?>
		<?= Form::field('select', 'language_id', 'Language', array($languages, array()), array('error' => $errors->first('language_id'))) ?>

		<?= Form::actions(array(Form::submit('Add account', array('class' => 'btn btn-large btn-primary')))) ?>
	<?= Form::close() ?>
</div>