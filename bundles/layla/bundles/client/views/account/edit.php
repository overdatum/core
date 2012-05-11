<div id="main">
	<div class="page-header">
		<h1><?= __('layla_client::account.edit.title') ?></h1>
	</div>

	<?= Form::open($url.'account/edit/'.$account->id, 'PUT', array('class' => 'form-horizontal')) ?>
		<?= Form::field('text', 'name', __('layla_client::account.edit.form.name'), array(Input::old('name', $account->name)), array('error' => $errors->first('name'))) ?>
		<?= Form::field('text', 'email', __('layla_client::account.edit.form.email'), array(Input::old('email', $account->email)), array('error' => $errors->first('email'))) ?>
		<?= Form::field('text', 'password', __('layla_client::account.edit.form.password'), array(), array('error' => $errors->first('password'))) ?>
		<?= Form::field('select', 'role_ids[]', __('layla_client::account.edit.form.roles'), array($roles, $active_roles, array('multiple' => 'multiple')), array('error' => $errors->first('password'))) ?>
		<?= Form::field('select', 'language_id', __('layla_client::account.edit.form.language'), array($languages, array($account->language->id)), array('error' => $errors->first('language_id'))) ?>

		<?= Form::actions(array(Form::submit(__('layla_client::account.edit.buttons.edit'), array('class' => 'btn btn-large btn-primary')))) ?>
	<?= Form::close() ?>
</div>