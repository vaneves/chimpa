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
		$posts = ViewPost::all($p, $m, $o, $t);
		
		$post = $posts->Data ? $posts->Data[0] : null;
		$post->humanize();
		unset($posts->Data[0]);
		$this->_set('post', $post);
		
		return $this->_view($posts);
	}
}