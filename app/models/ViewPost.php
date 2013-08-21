<?php

/**
 * @View("view_post")
 */
class ViewPost extends Post
{
	/**
	 * @Column(Type="Int")
	 */
	public $CategoryId;
	
	/**
	 * @Column(Type="String")
	 */
	public $CategoryName;
	
	/**
	 * @Column(Type="String")
	 */
	public $CategorySlug;
	
	/**
	 * @Column(Type="String")
	 */
	public $Author;
	
	/**
	 * Retorna os posts de uma categoria pelo id.
	 * @param int		$id	Id da categoria desejada
	 * @param int		$p	Pagina de resultados
	 * @param int		$m	Quantidade máxima de resultados retornados
	 * @param string	$o	Coluna para ordenação
	 * @param string	$t	Tipo da ordenação
	 * @return array		Array contendo os posts desejados
	 */
	public static function allByCategory($id, $p = 0, $m = 10, $o = 'UpdatedDate', $t = 'DESC')
	{
		$p = ($p < 1 ? 1 : $p) - 1;
		$db = Database::factory();
		return $db->ViewPost->where('CategoryId = ?', $id)->orderBy($o, $t)->paginate($p, $m);
	}
	
	/**
	 * Retorna os posts de uma categoria pelo slug.
	 * @param int		$id	Id da categoria desejada
	 * @param int		$p	Pagina de resultados
	 * @param int		$m	Quantidade máxima de resultados retornados
	 * @param string	$o	Coluna para ordenação
	 * @param string	$t	Tipo da ordenação
	 * @return array		Array contendo os posts desejados
	 */
	public static function allByCategorySlug($slug, $p = 1, $m = 10, $o = 'PublicatedDate', $t = 'DESC')
	{
		$p = ($p < 1 ? 1 : $p) - 1;
		$db = Database::factory();
		return $db->ViewPost->where('CategorySlug = ?', $slug)->orderBy($o, $t)->paginate($p, $m);
	}
}

?>
