<?php

class CategoryController extends AdminController
{

	public function admin_index($p = 1, $m = 20, $o = 'Id', $t = 'DESC')
	{
		$msg = Session::get('message');
		if($msg)
		{
			$this->_flash('alert ' . $msg->Class, $msg->Text);
			Session::del('message');
		}
		
		$categories = Category::all($p, $m, $o, $t);
		return $this->_view($categories);
	}

	public function admin_add()
	{
		$category = new Category();
		if (Request::isPost())
		{
			try
			{
				$category = $this->_data($category);
				$category->Slug = Inflector::slugify($category->Name);
				$category->save();
				Session::set('message', array('Class' => 'alert-success', 'Text' => 'Categoria salva com sucesso.'));
				return $this->_redirect('~/admin/category');
			} catch (ValidationException $e)
			{
				$this->_flash('alert', $e->getMessage());
			} catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar a categoria.');
			}
		}

		$this->_set('label', 'Criar');

		return $this->_view($category);
	}

	public function admin_edit($id)
	{
		$category = Category::get($id);
		if (Request::isPost())
		{
			try
			{
				$category = $this->_data($category);
				$category->Slug = Inflector::slugify($category->Name);
				$category->save();
				Session::set('message', array('Class' => 'alert-success', 'Text' => 'Categoria alterada com sucesso.'));
				return $this->_redirect('~/admin/category');
			} catch (ValidationException $e)
			{
				$this->_flash('alert', $e->getMessage());
			} catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar a categoria.');
			}
		}

		$this->_set('label', 'Editar');

		return $this->_view('admin_add', $category);
	}

	public function admin_remove()
	{
		if (Request::isPost())
		{
			try
			{
				$ids = Request::post('items', array());
				Category::deleteAll($ids);
				Session::set('message', array('Class' => 'alert-success', 'Text' => 'Categorias excluídas com sucesso.'));
			} catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível excluir as categorias.');
			}
		}
		$this->_redirect('~/admin/category');
	}

}