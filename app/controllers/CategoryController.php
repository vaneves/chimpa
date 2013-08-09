<?php
class CategoryController extends AdminController
{
	public function admin_index($p = 1, $m = 20, $o = 'Id', $t = 'DESC')
	{
		$categories = Category::all($p, $m, $o, $t);
		return $this->_view($categories);
	}
	
	public function admin_add()
	{
		$category = new Category();
		if(Request::isPost())
		{
			try
			{
				$category = $this->_data($category);
				$category->Slug = Inflector::slugify($category->Title);
				$category->save();
				$this->_flash('alert', 'Categoria salva com sucesso.');
			} 
			catch (ValidationException $e)
			{
				$this->_flash('alert', $e->getMessage());
			}
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar a categoria.');
			}
		}
		return $this->_view($category);
	}
	
	public function admin_edit($id)
	{
		$category = Category::get($id);
		if(Request::isPost())
		{
			try
			{
				$category = $this->_data($category);
				$category->save();
				$this->_flash('alert', 'Categoria salva com sucesso.');
			} 
			catch (ValidationException $e)
			{
				$this->_flash('alert', $e->getMessage());
			}
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar a categoria.');
			}
		}
		return $this->_view('admin_add', $category);
	}
	
	public function admin_remove($id)
	{
		$category = Category::get($id);
		if($category)
		{
			try
			{
				$category->delete();
				$this->_flash('alert', 'Categoria salva com sucesso.');
			}
			catch(Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível excluir a categoria.');
			}
		}
		$this->_redirect('~/admin/categoria');
	}
}