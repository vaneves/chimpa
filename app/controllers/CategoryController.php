<?php

class CategoryController extends AdminController
{
	/**
	 * @Auth("Admin","Manager") 
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->_set('active', 'category');
	}
	
	/**
	 * @Auth("*")
	 * @Master("public")
	 */
	public function index($slug, $p = 1, $m = 20, $o = 'Id', $t = 'DESC')
	{
		$category = ViewCategory::getBySlug($slug);
		$posts = ViewPost::allByCategory($category->Id, $p, $m, $o, $t);
		$this->_set('categories', Category::findAll());
		$this->_set('category', $category);
		return $this->_view($posts);
	}

	public function admin_index($p = 1, $m = 20, $o = 'Id', $t = 'DESC')
	{	
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
				$this->_flash('alert alert-success', 'Categoria salva com sucesso.');
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
				$this->_flash('alert alert-success', 'Categoria salva com sucesso.');
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
				$this->_flash('alert alert-success', 'Categorias excluídas com sucesso.');
			} catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível excluir as categorias.');
			}
		}
		$this->_redirect('~/admin/category');
	}

}