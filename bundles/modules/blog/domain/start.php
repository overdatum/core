<?php

Module::register('page', 'blog.post.(:any)', 'blog_admin::post@(:1)', function($config)
{
	$config->url('GET', 'blog/post/all', 'get_all');
	$config->();
});

Module::register('blog', )

'blog'

'blog.post.(:any)' => 'blog_admin::post@(:1)',

'POST', 'v1/blog/post' => 'blog_domain::v1.post@post_add'
'PUT', 'v1/blog/post/(:num)' => 'blog_domain::v1.post@put_edit'
'DELETE', 'v1/blog/post/(:num)' => 'blog_domain::v1.post@pdelete_delete'

Route::get('v'.$api_version.'/page/all', 'domain::v'.$api_version.'.page@page_all');
Route::get('v'.$api_version.'/page/(:num)', 'domain::v'.$api_version.'.page@page');
Route::post('v'.$api_version.'/page', 'domain::v'.$api_version.'.page@page');
Route::put('v'.$api_version.'/page/(:num)', 'domain::v'.$api_version.'.page@page');
Route::delete('v'.$api_version.'/page/(:num)', 'domain::v'.$api_version.'.page@page');

Route::controller(array(
	'domain::v1.account'
), '(:controller)/(:wildcards)');