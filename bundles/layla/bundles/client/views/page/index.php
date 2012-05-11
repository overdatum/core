<div id="main">
	<div class="page-header">
		<div class="pull-right">
			<?= Form::open($url.'page', 'GET') ?>
				<?= Form::input('text', 'q', Input::get('q')) ?> &nbsp;
				<button type="submit" class="btn btn-small btn-primary"><i class="icon-white icon-search">&nbsp;</i></button>
			<?= Form::close() ?>
		</div>
		<h1>Pages</h1>
	</div>

	<?php Notification::show() ?>

	<?php if(count($pages->results) > 0): ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?= HTML::sort_link($url.'page', 'meta_title', 'title') ?></th>
					<th><?= HTML::sort_link($url.'page', 'account_id', 'author') ?></th>
					<th><?= HTML::sort_link($url.'page', 'created_at', 'created at') ?></th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pages->results as $page): ?>
				<tr>
					<td>
						<h2><?= $page->meta_title ?></h2>
					</td>
					<td>
						<?= $page->account->name ?>
					</td>
					<td>
						<?= $page->created_at ?>
					</td>
					<td style="text-align:right">
						<?= HTML::link($url.'page/edit/'.$page->id, '<i class="icon-pencil"></i>', array('class' => 'btn btn-small')) ?>
						<?= HTML::link($url.'page/delete/'.$page->id, '<i class="icon-trash icon-white"></i>', array('class' => 'btn btn-danger')) ?>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
		<div class="pull-left">
			<?= $pages->links() ?>
		</div>
	<?php else: ?>
		<div class="well">
			Er zijn geen pages gevonden...
		</div>
	<?php endif ?>
	<div class="pull-right">
		<?= HTML::link($url.'page/add', '<i class="icon-white icon-plus-sign"></i> Add Page', array('class' => 'btn btn-large btn-primary')) ?>
	</div>
</div>