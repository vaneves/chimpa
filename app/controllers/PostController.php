<?php
class PostController extends AdminController
{
	public function admin_index($p = 1, $m = 20, $o = 'Id', $t = 'DESC')
	{
		$posts = Post::all($p, $m, $o, $t);
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
				$post->save();
				$this->_flash('alert', 'Post salvo com sucesso.');
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
				$post->save();
				$this->_flash('alert', 'Post salvo com sucesso.');
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