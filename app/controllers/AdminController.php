<?php

class AdminController extends Controller
{
	/**
	 * @Auth("user")
	 * @Master("admin")
	 */
	public function __construct()
	{
		//carregar mensagem passada por outra action via session
		$msg = Session::get('message');
		if($msg)
		{
			$this->_flash('alert ' . $msg->Class, $msg->Text);
			Session::del('message');
		}
	}
}