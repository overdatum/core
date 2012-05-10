<div id="main">
	<div class="page-header">
		<h1>Are you sure?</h1>
	</div>
	<div class="well">
		You are about to delete the account for "<?= $account->name . ' ('.$account->email.')' ?>". <b>If you do, there is no turning back!</b>
	</div>
	<?= Form::open($url.'account/delete/'.$account->id, 'PUT') ?>
		<?= Form::actions(array(Form::submit('Delete account', array('class' => 'btn btn-large btn-danger')), ' &nbsp; '.HTML::link($url.'account', 'Nope, I changed my mind', array('class' => 'btn btn-large')))) ?>
	<?= Form::close() ?>
</div>