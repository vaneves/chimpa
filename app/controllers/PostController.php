<?php
class PostController extends AdminController
{
	public function admin_index($p = 1, $m = 20, $o = 'Id', $t = 'DESC')
	{
		$filters = array();
		
		if(Auth::is('Author'))
		{
			$filters['UserId'] = Session::get('user')->Id;
		}
		
		$q = Request::get('q');
		if($q)
		{
			$filters['Title'] = "%$q%";
			$filters['Author'] = "%$q%";
		}
		
		$posts = ViewPost::search($p, $m, $o, $t, $filters);
		return $this->_view($posts);
	}
	
	public function admin_add()
	{
		$post = new Post();
		if(Request::isPost())
		{
			try
			{
				$post = $this->_data($post);
				$post->Content = strip_tags(Request::post('Content'), Config::get('html_safe_list'));
				$post->UserId = Session::get('user')->Id;
				$post->CreatedDate = time();
				$post->Slug = Inflector::slugify(Request::post('Title'));
				
				if(Request::post('Draft'))
				{
					$post->Status = 0;
				}
				else
				{
					$post->PublicatedDate = time();
					$post->Status = 1;
				}
				
				$post->save();
				$post->setCategories(Request::post('categories'));
				
				$this->_flash('alert alert-success', 'Post salvo com sucesso.');
			} 
			catch (ValidationException $e)
			{
				$this->_flash('alert', $e->getMessage());
			}
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar o post.');
			}
		}
		
		$this->_set('label', 'Criar');
		$this->_set('categories', Category::findAll());
		$this->_set('selectedCategories', $post->getCategoriesIds());
		return $this->_view($post);
	}
	
	public function admin_edit($id)
	{
		$post = Post::get($id);
		
		if(!$post->isAuthorizedManager(Session::get('user')->Id))
		{
			$this->_flash('alert', 'Você não pode editar este post.');
			return $this->_redirect('~/admin/post');
		}
		
		if(Request::isPost())
		{
			try
			{
				$post = $this->_data($post);
				$post->Content = strip_tags(Request::post('Content'), Config::get('html_safe_list'));
				$post->UserId = Session::get('user')->Id;
				$post->UpdatedDate = time();
				
				if(Request::post('Draft'))
				{
					$post->Status = 0;
				}
				else
				{
					$post->PublicatedDate = time();
					$post->Status = 1;
				}
				
				$post->save();
				$post->unsetCategories();
				$post->setCategories(Request::post('categories'));
				$this->_flash('alert alert-success', 'Post salvo com sucesso.');
			} 
			catch (ValidationException $e)
			{
				$this->_flash('alert', $e->getMessage());
			}
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar o post.');
			}
		}
		
		$this->_set('label', 'Editar');
		$this->_set('categories', Category::findAll());
		$this->_set('selectedCategories', $post->getCategoriesIds());
		return $this->_view('admin_add', $post);
	}
	
	public function admin_remove()
	{
		if (Request::isPost())
		{
			try
			{
				$ids = Request::post('items', array());
				Post::deleteAll($ids);
				$this->_flash('alert alert-success', 'Posts excluídos com sucesso.');
			} catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível excluir os posts.');
			}
		}
		$this->_redirect('~/admin/post');
	}
	
	public function admin_publish()
	{
		if (Request::isPost())
		{
			try
			{
				$ids = Request::post('items', array());
				Post::publishAll($ids);
				$this->_flash('alert alert-success', 'Posts publicados com sucesso.');
			} catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível publicar os posts.');
			}
		}
		$this->_redirect('~/admin/post');
	}
}