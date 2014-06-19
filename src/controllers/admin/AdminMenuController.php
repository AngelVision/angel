<?php namespace Angel\Core;

class AdminMenuController extends AdminCrudController {

	protected $model	= 'Menu';
	protected $uri		= 'menus';
	protected $plural	= 'menus';
	protected $singular	= 'menu';
	protected $package	= 'core';

	public function index()
	{
		$menuModel = App::make('Menu');

		$paginator = $menuModel::withTrashed()->with('menuItems', 'menuItems.childMenu');
		if (Config::get('core::languages')) {
			$paginator = $paginator->where('language_id', $this->data['active_language']->id);
		}
		$paginator = $paginator->paginate(5);

		$model_list = array();
		$this->data['linkable_models'] = array();

		foreach (Config::get('core::linkable_models') as $model=>$uri) {
			$model_list[$model] = $model;
			$this->data['linkable_models'][$model] = array(
				'add' => admin_url($uri.'/add')
			);
		}
		
		$this->data['model_select'] = Form::select('fmodel', $model_list, null, array('id'=>'modelSelect', 'class' => 'form-control', 'autocomplete'=>'off'));

		$menus = $menuModel::all();
		$menu_list = array('0'=>'None');
		foreach ($menus as $menu) {
			$menu_list[$menu->id] = $menu->name;
		}
		
		$this->data['menus'] = $paginator->getCollection();
		$appends = $_GET;
		unset($appends['page']);
		$this->data['links'] = $paginator->appends($appends)->links();

		return View::make('core::admin.menus.index', $this->data);
	}

	public function validate_rules($id = null)
	{
		return array(
			'name' => 'required'
		);
	}

	/**
	 * AJAX for getting 'existing model' dropdown in menu link creation wizard.
	 *
	 * @return string - HTML of the select element
	 */
	public function model_drop_down()
	{
		$model = Input::get('model');
		$arr = LinkableModel::drop_down($model);
		if (!count($arr)) return 0;
		return Form::select('fid', $arr, null, array('id'=>'thingSelect', 'class' => 'form-control'));
	}
}