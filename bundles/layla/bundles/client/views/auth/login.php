<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1><?= __('layla_client::auth.login.title') ?></h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="span12">
		<?= Form::open($url.'auth/login', 'PUT', array('class' => 'form-horizontal')) ?>
			<?= Form::field('text', 'email', __('layla_client::auth.login.form.email'), array(Input::old('email')), array('error' => $errors->first('email'))) ?>
			<?= Form::field('password', 'password', __('layla_client::auth.login.form.password'), array(), array('error' => $errors->first('password'))) ?>
			<?= Form::actions(array(Form::submit(__('layla_client::auth.login.buttons.login'), array('class' => 'btn-large btn-primary')))) ?>
		<?= Form::close() ?>
	</div>
</div>testing