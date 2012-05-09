# Bootsparks Bundle

Twitter's Bootstrap Forms support in Laravel.

## Installation

Install via the Artisan CLI:

```sh
php artisan bundle:install bootsparks
```

## Bundle Registration

Add the following to your application/bundles.php file:

```php
'bootsparks' => array(
    'autoloads' => array(
        'map' => array(
            'Bootsparks\\Form' => '(:bundle)/form.php',
        ),
    ),
),
```

## Class Alias

`Bootsparks\Form` extends `Laravel\Form` so you can use it to replace your existing form code.  To do this you'll need to edit **application/config/application.php** and update the alias for **Form**.

## Guide

Here's an example of a Login form using Bootsparks:

```php
<article>
	<h1>Log in</h1>

	<?php echo Form::open(URL::to('login'), 'POST', array('class' => Form::TYPE_HORIZONTAL)); ?>
	<?php echo Form::token(); ?>
	<?php echo Form::hidden('from', Input::get('from', Request::uri() === 'login' ? '' : Request::uri())); ?>

	<?php if ($errors->has('login')): ?>
		<?php echo $errors->first('login', '<div class="alert-message error">:message</div>'); ?>
	<?php endif; ?>

	<?php echo Form::field('email', 'email', 'E-mail Address', array(Input::get('email')), array('error' => $errors->has('email'))); ?>
	<?php echo Form::field('password', 'password', 'Password', array(), array('error' => $errors->has('password'))); ?>
	<?php echo Form::field('labelled_checkbox', 'remember', '', array('Use a '.HTML::link('cookies', 'cookie', array('title' => 'Find out more about the cookies we use and how to delete them', 'rel' => 'twipsy', 'target' => '_blank')).' to remember my details', 'yes')); ?>

	<?php echo Form::actions(Form::submit("Log in", array('class' => 'primary'))); ?>

	<?php echo Form::close(); ?>
</article>
```

The **Form::field** method allows you to generate a field for any Form:: field.  The parameters are:

* $type (string) Any **Laravel\Form** method with $name as the first parameter.
* $name (string) The name of the HTML field.
* $label (string) A HTML label for this field.
* $args (array) Additional parameters passed in order to the Form method.
* $opts (array) Additional form field parameters; help, error, warning or success.
