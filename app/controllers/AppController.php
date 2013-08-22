<?php

class AppController extends Controller
{
	public function beforeRender()
	{
		if(isset($this->args['prefix']) && $this->args['prefix'] == 'admin')
		{
			if($this->args['action'] != 'admin_login')
				Auth::allow('Admin', 'Manager', 'Author');
			
			$this->Template->setMaster('admin');
			$this->_set('active', 'post');
		}
		else
		{
			$this->Template->setDirectory(App::ROOT . 'app/views/theme/' . Config::get('theme') . '/');
			$this->_set('categories', Category::findAll());
		}
	}
}