<?php

/**
 * Twitter's Bootstrap for Laravel
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Phill Sparks <me@phills.me.uk>
 * 
 * @see  http://github.com/sparksp/laravel-twitter
 * @see  http://twitter.github.com/bootstrap/
 */

Autoloader::map(array(
	'Bootsparks\\Form' => __DIR__.DS.'form'.EXT,
));


// --------------------------------------------------------------
// For Layla
// --------------------------------------------------------------
Autoloader::alias('Form', 'Bootsparks\\Form');
// --------------------------------------------------------------
// End for Layla
// --------------------------------------------------------------