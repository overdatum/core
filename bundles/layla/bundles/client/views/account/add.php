<div id="main">
	<div class="page-header">
		<h1><?= __('layla_client::account.add.title') ?></h1>
	</div>
	<?= Form::open($url.'account/add', 'POST', array('class' => 'form-horizontal')) ?>
		<?= Form::field('text', 'name', __('layla_client::account.add.form.name'), array(Input::old('name')), array('error' => $errors->first('name'))) ?>
		<?= Form::field('text', 'email', __('layla_client::account.add.form.email'), array(Input::old('email')), array('error' => $errors->first('email'))) ?>
		<?= Form::field('password', 'password', __('layla_client::account.add.form.password'), array(), array('error' => $errors->first('password'))) ?>
		<?= Form::field('select', 'role_ids[]', __('layla_client::account.add.form.roles'), array($roles, array(), array('multiple' => 'multiple')), array('error' => $errors->first('role_ids'))) ?>
		<?= Form::field('select', 'language_id', __('layla_client::account.add.form.language'), array($languages, array()), array('error' => $errors->first('language_id'))) ?>

		<?= Form::actions(array(Form::submit(__('layla_client::account.add.buttons.add'), array('class' => 'btn btn-large btn-primary')))) ?>
	<?= Form::close() ?>
</div>