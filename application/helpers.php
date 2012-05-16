<?php

/**
 * Transform Eloquent models to a JSON object.
 *
 * @param  Eloquent|array  $models
 * @return object
 */
function to_array($models)
{
	if ($models instanceof Laravel\Database\Eloquent)
	{
		return $models->to_array();
	}

	return array_map(function($m) { return $m->to_array(); }, $models);
}

function model_array_pluck($models, $value, $key = null)
{
	$result = array();
	if( ! is_array($models)) return $result;
	
	$i = 0;
	foreach ($models as $model)
	{
		$result[is_null($key) ? $model->get_key() : ($key instanceof Closure ? $key($model) : ($key == '' ? $i : $model->$key))] = $value instanceof Closure ? $value($model) : $model->$value;
		$i++;
	}

	return $result;
}