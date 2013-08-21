<?php

/**
 * @View("view_category")
 */
class ViewCategory extends Category
{
	public $PostId;
	
	public $PostSlug;
	
	public $PostTitle;
	
	/**
	 * Retorna as categorias de um post pelo id.
	 * @param int		$id	Id do post desejado
	 * @param int		$p	Pagina de resultados
	 * @param int		$m	Quantidade máxima de resultados retornados
	 * @param string	$o	Coluna para ordenação
	 * @param string	$t	Tipo da ordenação
	 * @return array		Array contendo as categorias desejadas
	 */
	public static function allByPost($id, $p = 1, $m = 10, $o = 'Id', $t = 'DESC')
	{
		$p = ($p < 1 ? 1 : $p) - 1;
		$db = Database::factory();
		return $db->ViewCategory->where('PostId = ?', $id)->orderBy($o, $t)->paginate($p, $m);
	}
}

?>
