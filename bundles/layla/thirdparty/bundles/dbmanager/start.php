<?php

Autoloader::map(array(
	'DBManager' => __DIR__.DS.'dbmanager'.EXT,
));

Autoloader::namespaces(array(
	'DBManager' => __DIR__
));