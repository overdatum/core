<div class="container">
	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1><?php echo __('layla.install.title') ?></h1>
			</div>
			@if( ! $writable)
				<div class="control-group">
					<div class="controls">
						<h3>{{ __('layla.install.sections.unwritable_paths_found') }}</h3>
					</div>
				</div>
				@foreach($paths as $path => $is_writable)
					@if( ! $is_writable)
						<i class="icon-<?php echo $is_writable ? 'ok' : 'remove' ?>-circle"></i> {{ $path }}<br>
					@endif
				@endforeach
			@else
				{{ Form::open('', 'POST', array('class' => 'form-horizontal')) }}
					<div class="control-group">
						<div class="controls">
							<h3>{{ __('layla.install.sections.general') }}</h3>
						</div>
					</div>
					{{ Form::field('text', 'url', __('layla.install.general.url'), array('manage', array('style' => 'width: 125px')), array('add_on' => 'domain.com/')) }}

					<div class="control-group">
						<div class="controls">
							<h3>{{ __('layla.install.sections.account') }}</h3>
						</div>
					</div>
					{{ Form::field('text', 'account_email', __('layla.install.account.email'), array(), array('error' => $errors->first('db_user'))) }}
					{{ Form::field('password', 'account_password', __('layla.install.account.password'), array(), array('error' => $errors->first('db_password'))) }}

					<div class="control-group">
						<div class="controls">
							<h3>{{ __('Select the components to be installed') }}</h3>
						</div>
					</div>
					{{ Form::field('checkbox', 'start_domain', 'API', array('1', array(), array('class' => 'toggle', 'checked' => 'checked'))) }}
					<div class="sub-form" id="start_domain_div">
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
					
					{{ Form::field('checkbox', 'start_client', 'Client', array('1', array(), array('class' => 'toggle', 'checked' => 'checked'))) }}
					<div class="sub-form" id="start_client_div">
						{{ Form::field('checkbox', 'client_api', 'Use different API', array('1', array(), array('class' => 'toggle'))) }}
						<div id="client_api_div" class="hide">
							{{ Form::field('text', 'client_api_url', 'API URL') }}
						</div>
					</div>

					{{ Form::field('checkbox', 'start_admin', 'Admin', array('1', array(), array('class' => 'toggle', 'checked' => 'checked'))) }}
					<div class="sub-form" id="start_admin_div">
						{{ Form::field('checkbox', 'admin_api', 'Use different API', array('1', array(), array('class' => 'toggle'))) }}
						<div id="admin_api_div" class="hide">
							{{ Form::field('text', 'admin_api_url', 'API URL') }}
						</div>
					</div>

					{{ Form::actions(array(Form::submit('Install Layla!', array('class' => 'btn-large btn-primary')))) }}
				{{ Form::close() }}
			@endif
		</div>
	</div>
</div>

<style>
.sub-form {
	padding: 17px 0 18px 0;
	margin-top: 18px;
	margin-bottom: 18px;
	background-color: #f5f5f5;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
}
</style>
<script>
$('#start_domain').click(function() {
	if( ! $(this).attr('checked')) {
		$('#start_client_div div:first').slideUp();
		$('#start_admin_div div:first').slideUp();
		if( ! $('#start_client_div input[type=checkbox]').attr('checked')) {
			$('#client_api_div').slideDown();
		}
		if( ! $('#start_admin_div input[type=checkbox]').attr('checked')) {
			$('#admin_api_div').slideDown();
		}
	}
	else {
		$('#start_client_div div:first').slideDown();
		$('#start_admin_div div:first').slideDown();
		$('#client_api_div').slideUp();
		$('#admin_api_div').slideUp();
	}
});

/*;
#start_admin_div input[type=checkbox]
	admin_api_div slideDown();
*/
$('.toggle').click(function() {
	$('#' + $(this).attr('name') + '_div').slideToggle();
});
</script>