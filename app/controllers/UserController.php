<?php
class UserController extends AdminController
{
	/**
	 * @Auth("*")
	 */
	public function admin_login()
	{
		if(Auth::isLogged())
		{
			return $this->_redirect('~/admin/post');
		}
		
		if(Request::isPost())
		{
			$dados = $this->_data();
			$user = User::login($dados->Email, $dados->Password);
			if($user)
			{
				Session::set('user', $user);
				Auth::set('user');
				$this->_redirect('~/admin/post');
			}
			else
			{
				$this->_flash('alert alert-error', 'Dados incorretos!');
			}
		}
		return $this->_view();
	}
	
	public function admin_logout()
	{
		Session::clear();
		Auth::clear();
		return $this->_redirect('~/admin/');
	}
	
	public function admin_index($p = 1, $m = 20, $o = 'Id', $t = 'DESC')
	{
		$users = User::all($p, $m, $o, $t);
		return $this->_view($users);
	}
	
	public function admin_add()
	{
		$user = new User();
		if(Request::isPost())
		{
			try
			{
				$user = $this->_data($user);
				$user->setPassword(Request::post('password'));
				$user->save();
				$this->_flash('alert alert-success', 'Usuário criado com sucesso.');
				return $this->_redirect('~/admin/user');
			} 
			catch (ValidationException $e)
			{
				$this->_flash('alert', $e->getMessage());
			}
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar o usuário.');
			}
		}
		
		$this->_set('label', 'Criar');
		
		return $this->_view($user);
	}
	
	public function admin_edit($id)
	{
		$user = User::get($id);
		if(Request::isPost())
		{
			try
			{
				$user = $this->_data($user);
				$user->setPassword(Request::post('password'));
				$user->save();
				$this->_flash('alert alert-success', 'Usuário salvo com sucesso.');
				return $this->_redirect('~/admin/user');
			} 
			catch (ValidationException $e)
			{
				$this->_flash('alert', $e->getMessage());
			}
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar o usuário.');
			}
		}
		
		$this->_set('label', 'Editar');
		
		return $this->_view('admin_add', $user);
	}
	
	public function admin_remove()
	{
		if (Request::isPost())
		{
			try
			{
				$ids = Request::post('items', array());
				User::deleteAll($ids);
				$this->_flash('alert alert-success', 'Usuários excluídos com sucesso.');
			} catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível excluir os usuários.');
			}
		}
		$this->_redirect('~/admin/user');
	}
}