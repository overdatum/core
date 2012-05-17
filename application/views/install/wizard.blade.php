<div class="container">
	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1><?= __('layla.install.title') ?></h1>
			</div>
			{{ Form::open('', 'POST', array('class' => 'form-horizontal')) }}

				<ul class="nav nav-tabs" id="install_type">
					<li class="active"><a href="#common"><i class="icon-star"></i>  {{ __('layla.install.install_type.common') }}</a></li>
					<li><a href="#custom"><i class="icon-wrench"></i> {{ __('layla.install.install_type.custom') }}</a></li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="common">
						<div class="control-group">
							<div class="controls">
								<h3>{{ __('layla.install.sections.account') }}</h3>
							</div>
						</div>
						{{ Form::field('text', 'account_email', __('layla.install.account.email'), array(), array('error' => $errors->first('db_user'))) }}
						{{ Form::field('password', 'account_password', __('layla.install.account.password'), array(), array('error' => $errors->first('db_password'))) }}

						<div class="control-group">
							<div class="controls">
								<h3>{{ __('layla.install.sections.database') }}</h3>
							</div>
						</div>
						{{ Form::field('select', 'database_connection', __('layla.install.database.connection'), array(array('mysql' => 'MySQL', 'pgsql' => 'PostgreSQL', 'sqlite' => 'SQLite', 'sqlsrv' => 'SQL Server'), array(), array()), array('error' => $errors->first('db_connection'))) }}
						{{ Form::field('text', 'database_user', __('layla.install.database.user'), array(), array('error' => $errors->first('db_user'))) }}
						{{ Form::field('password', 'database_password', __('layla.install.database.password'), array(), array('error' => $errors->first('db_password'))) }}
						{{ Form::field('text', 'database_name', __('layla.install.database.name'), array('layla'), array('error' => $errors->first('db_name'))) }}
					</div>

					<div class="tab-pane" id="custom">
						Coming soon...
					</div>
				</div>

				{{ Form::actions(array(Form::submit('Install Layla!', array('class' => 'btn-large btn-primary')))) }}

			{{ Form::close() }}
		</div>
	</div>
</div>
{{ HTML::script('js/bootstrap-tab.js') }}
<script>
$(function () {
	$('#install_type a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
});
</script>