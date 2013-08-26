<?php
class InstallController extends AppController
{
	public function admin_index()
	{
		if(Config::get('installed'))
			return $this->_view('admin_installed');
		
		return $this->_view();
	}
	
	public function admin_config()
	{
		if(Config::get('installed'))
			return $this->_view('admin_installed');
			
		if(Request::isPost())
		{
			$data = $this->_data();
			
			Config::set('database', array(
				'default' => array(
					'type' => 'mysql',
					'host' => $data->host,
					'name' => $data->name,
					'user' => $data->user,
					'pass' => $data->pass,
					'validate' => true
				)
			));
			
			try
			{
				$db = Database::factory();
				
				$script = file_get_contents(App::ROOT . 'schema.sql');
				
				$db->query($script);
				
				header(ROOT_VIRTUAL . 'install.php/user');
				exit;
			}
			catch (Exception $e)
			{
				return $this->_view('admin_error');
			}
		}
		return $this->_view();
	}
	
	public function admin_user()
	{
		if(Request::isPost())
		{
			
		}
		return $this->_view();
	}
}