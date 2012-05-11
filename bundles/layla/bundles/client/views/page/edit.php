<div id="main">
	<div class="page-header">
		<h1>Edit page "<?= $page->lang->menu ?>"</h1>
	</div>
	<?= Form::open($url.'page/add', 'POST', array('class' => 'form-horizontal')) ?>
		<?= Form::field('checkbox', 'online', 'Online', array(1, Input::old('online'), array('checked' => 'checked'))) ?>
		<?= Form::field('checkbox', 'hidden', 'Hidden', array(Input::old('hidden'))) ?>
		<?= Form::field('checkbox', 'homepage', 'Homepage', array(Input::old('homepage'))) ?>
		<?= Form::field('select', 'layout_id', 'Layout', array($layouts)) ?>
		
		<?= Form::actions(array(Form::submit('Add Page', array('class' => 'btn btn-large btn-primary')))) ?>
	<?= Form::close() ?>
</div>