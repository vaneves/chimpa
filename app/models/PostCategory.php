<?php

/**
 * @Entity("post_category")
 */
class PostCategory extends Model
{
	/**
	 * @Column(Type="Int",Key="Primary")
	 */
	public $PostId;
	
	/**
	 * @Column(Type="Int",Key="Primary")
	 */
	public $CategoryId;
	
	public function __construct($postId = 0, $categoryId = 0)
	{
		//parent::__construct();
		$this->PostId = (int) $postId;
		$this->CategoryId = (int) $categoryId;
	}
}

?>
