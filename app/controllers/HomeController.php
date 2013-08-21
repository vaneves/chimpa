<?php
class HomeController extends Controller
{
	/**
	 * @Master("public") 
	 */
	public function __construct()
	{
		$this->_set('categories', Category::findAll());
	}
	
	public function index($p = 1, $o = 'Id', $t = 'DESC')
	{
		$m = 20;
		$this->_set('m', $m);
		
		$q = Request::get('q');
		$filters = array();
		if($q)
		{
			$filters['Title'] = "%$q%";
		}
		
		$posts = Post::search($p, $m, $o, $t, $filters);
		
		$post = null;
		if($posts->Data)
		{
			$post = $posts->Data[0];
			$post->humanize();
			unset($posts->Data[0]);
		}
		
		$this->_set('post', $post);
		
		return $this->_view($posts);
	}
}