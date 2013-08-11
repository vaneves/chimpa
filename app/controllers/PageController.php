<?php
class PageController extends AdminController
{
	public function admin_index($p = 1, $m = 20, $o = 'Id', $t = 'DESC')
	{
		$pages = Page::all($p, $m, $o, $t);
		return $this->_view($pages);
	}
	
	public function admin_add()
	{
		$page = new Page();
		if(Request::isPost())
		{
			try
			{
				$page = $this->_data($page);
				$page->Slug = Inflector::slugify($page->Title);
				$page->Status = Request::post('Draft') ? 0 : 1;
				$page->Content = Request::post('Content');
				$page->save();
				$this->_flash('alert', 'Página salva com sucesso.');
			} 
			catch (ValidationException $e)
			{
				$this->_flash('alert', $e->getMessage());
			}
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar a página.');
			}
		}
		$pages = Page::all(1, 100, 'Title');
		$this->_set('pages', $pages);
		$this->_set('label', 'Criar');
		
		return $this->_view($page);
	}
	
	public function admin_edit($id)
	{
		$page = Page::get($id);
		if(!$page)
		{
			$this->_flash('alert alert-error', 'Página não encontrada.');
			$this->_redirect('~/admin/page');
		}
		if(Request::isPost())
		{
			try
			{
				$page = $this->_data($page);
				$page->save();
				$this->_flash('alert', 'Página salva com sucesso.');
			} 
			catch (ValidationException $e)
			{
				$this->_flash('alert', $e->getMessage());
			}
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar a página.');
			}
		}
		
		$pages = Page::all(1, 100, 'Title');
		$this->_set('pages', $pages);
		$this->_set('label', 'Editar');
		
		return $this->_view('admin_add', $page);
	}
	
	public function admin_remove($id)
	{
		$page = Page::get($id);
		if($page)
		{
			try
			{
				$page->delete();
				$this->_flash('alert', 'Página excluída com sucesso.');
			}
			catch(Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível excluir a página.');
			}
		}
		else
		{
			$this->_flash('alert alert-error', 'Página não encontrada.');
		}
		$this->_redirect('~/admin/page');
	}
}