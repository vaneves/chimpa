<?php
class UserController extends AdminController
{
	/**
	 *@Auth("Admin") 
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
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
				Auth::set($user->getBaseRole());
				$this->_redirect('~/admin/post');
			}
			else
			{
				$this->_flash('alert alert-error', 'Dados incorretos!');
			}
		}
		return $this->_view();
	}
	
	/**
	 * @Auth("*")
	 */
	public function admin_logout()
	{
		Session::clear();
		Auth::clear();
		return $this->_redirect('~/admin/');
	}
	
	public function admin_index($p = 1, $m = 20, $o = 'Name', $t = 'ASC')
	{
		$users = User::search($p, $m, $o, $t, array(array('Id', '<>', Session::get('user')->Id)));
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
				$user->setPassword(Request::post('Password'));
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
		
		$user->humanize();
		unset(User::$_roles[$user->Role->Id]);
		
		return $this->_view($user);
	}
	
	public function admin_edit($id)
	{
		$user = User::get($id);
		if(Request::isPost())
		{
			try
			{
				$oldPass = $user->Password;
				$user = $this->_data($user);
				$user->setPassword(Request::post('Password'), $oldPass);
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
		
		$user->humanize();
		unset(User::$_roles[$user->Role->Id]);
		
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

	/**
	 * @Auth("Admin","Manager","Author")
	 */
	public function admin_me()
	{
		$user = Session::get('user');

		if (Request::isPost()) 
		{
			try
			{
				$user = User::get($user->Id);

				//preservar o password antigo
				$oldpass = $user->Password;
				$user = $this->_data($user);
				$user->Password = $oldpass;

				$pass = Request::post('Password');
				if ($pass) 
				{
					$repass = Request::post('Repassword');
					$oldpass = Request::post('OldPassword');
					if ($user->checkPassword($oldpass)) 
					{
						if($pass === $repass)
						{
							$user->setPassword($pass);
						}
						else
						{
							throw new ValidationException('As senhas devem ser iguais.', 1);
						}
					}
					else
					{
						throw new ValidationException('A senha antiga não confere.', 1);
					}

					$user->save();
					$this->_flash('alert alert-success', 'Usuário salvo com sucesso.');
				}
			}catch(ValidationException $e)
			{
				$this->_flash('alert alert-error', $e->getMessage());
			}catch(Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro ao tentar salvar o usuário.');
			}
		}

		return $this->_view($user);
	}
}