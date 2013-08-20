<?php
class PostController extends AdminController
{
	public function admin_index($p = 1, $m = 20, $o = 'Id', $t = 'DESC')
	{
		$filters = array();
		
		if(Auth::is(User::$_baseRoles[20]))
		{
			$filters['UserId'] = Session::get('user')->Id;
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
	
	public function admin_remove($id)
	{
		$post = Post::get($id);
		if($post)
		{
			try
			{
				$post->delete();
				$this->_flash('alert', 'Post salvo com sucesso.');
			}
			catch(Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível excluir o post.');
			}
		}
		$this->_redirect('~/admin/post');
	}
}