<?php

// NOTE: Always eager-load the language relationship when grabbing linkable models

abstract class LinkableModel extends Eloquent {

	///////////////////////////////////////////////
	//               Relationships               //
	///////////////////////////////////////////////
	// All menu-linkable models must have a language associated
	public function language()
	{
		return $this->belongsTo('Language');
	}

	// Handling relationships in controller CRUD methods
	public function pre_delete()
	{
		MenuItem::where('fmodel', get_class($this))
				->where('fid', $this->id)
				->delete();
	}
	public function pre_restore()
	{
		MenuItem::withTrashed()
				->where('fmodel', get_class($this))
				->where('fid', $this->id)
				->restore();
	}
	public function pre_hard_delete()
	{
		MenuItem::withTrashed()
				->where('fmodel', get_class($this))
				->where('fid', $this->id)
				->forceDelete();
	}

	///////////////////////////////////////////////
	//               Menu Linkable               //
	///////////////////////////////////////////////
	abstract public function link();
	abstract public function link_edit();
	public function name()
	{
		return $this->name;
	}
	public function name_full()
	{
		if (Config::get('core::languages')) return $this->language->name . ' | ' . $this->name;
		return $this->name;
	}
	public static function drop_down($model)
	{
		if (Config::get('core::languages')) $objects = $model::orderBy('language_id')->get();
		else $objects = $model::get();
		$arr = array();
		foreach ($objects as $object) {
			$arr[$object->id] = $object->name_full();
		}
		return $arr;
	}
}