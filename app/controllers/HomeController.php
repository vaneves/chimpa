<?php
class HomeController extends AppController
{	
	public function index($p = 1, $o = 'Id', $t = 'DESC')
	{
		$m = 20;
		$this->_set('m', $m);
		
		$posts = Post::all($p, $m, $o, $t);
		
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