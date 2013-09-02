<?php
/*
 * Copyright (c) Trilado Team (triladophp.org)
 * All rights reserved.
 */


/**
 * Classe principal do Framework, responsável pelo controlar todo o fluxo, fazendo chama de outras classes
 * 
 * @author		Valdirene da Cruz Neves Júnior <vaneves@vaneves.com>
 * @author		Diego Oliveira <diegopso2@gmail.com>
 * @author		Jackson Gomes <jackson.souza@gmail.com>
 * @version		2.7
 *
 */ 
class App 
{
	/**
	 * Guarda o caminho do diretório raiz da aplicação.
	 */
	public static $root;

	/**
	 * Guarda o caminho virtual da aplicação.
	 */
	public static $rootVirtual;

	/**
	 * Guarda o caminho do diretório WWWROOT.
	 */
	public static $wwwroot;

	/**
	 * Guarda o caminho do diretório core.
	 */
	public static $rootCore;

	/**
	 * Guarda o cache time.
	 */
	public static $cacheTime = 60;

	/**
	 * Guarda os argumentos passados pela URL (prefixo, controller, action e parâmetros)
	 * @var	array
	 */
	public static $args = array();
	
	/**
	 * Guarda o nome do módulo a ser executado
	 * @var	string
	 */
	public static $module;
	
	/**
	 * Guarda o nome do controller a ser executado
	 * @var String
	 */
	public static $controller;
	
	/**
	 * Guarda o nome da action a ser executada
	 * @var String
	 */
	public static $action;

	/**
	* Inicia a aplicação e calcula as constantes iniciais.
	*/
	public static function init($root)
	{
		self::$root = $root;
		self::$rootVirtual = str_replace($_SERVER['DOCUMENT_ROOT'], '', self::$root);
		self::$wwwroot = self::$root . 'app/wwwroot/';
		self::$rootCore = self::$root . 'core/';

		//define as constantes de root
		define('root', $root);
		define('root_virtual', str_replace($_SERVER['DOCUMENT_ROOT'], '', self::$root));
		define('wwwroot', self::$root . 'app/wwwroot/');
		
		define('ROOT', $root);
		define('ROOT_VIRTUAL', str_replace($_SERVER['DOCUMENT_ROOT'], '', self::$root));
		define('WWWROOT', self::$root . 'app/wwwroot/');

		define('CACHE_TIME', self::$cacheTime);
	}
	
	/**
	 * Contrutor da classe
	 * @param	string	$url	url acessada pelo usuário
	 */
	public function __construct($url)
	{
		$cache_config = Config::get('cache');
		if($cache_config['enabled'] && $cache_config['page'])
		{
			$cache = Cache::factory();
			if($cache->has(URL))
			{
				$data = $cache->read(URL);
				exit($data);
			}
		}
		
		$registry = Registry::getInstance();
		
		self::$args = $this->args($url);
		
		//I18n
		if (!defined('LANG')) 
		{
			define('lang', self::$args['lang']);
			define('LANG', self::$args['lang']);
		}
		
		$i18n = I18n::getInstance();
		$i18n->setLang(LANG);
		
		$registry->set('I18n', $i18n);
		
		if(!function_exists('__'))
		{
			function __($string, $format = null)
			{
				return I18n::getInstance()->get($string, $format);
			}
			function _e($string, $format = null)
			{
				echo I18n::getInstance()->get($string, $format);
			}
		}
		
		self::$controller = Inflector::camelize(self::$args['controller']) .'Controller';
		self::$action = str_replace('-', '_', self::$args['action']);
		self::$module = self::$args['module'];
		
		if (!defined('CONTROLLER')) 
		{
			define('controller', self::$controller );
			define('action', self::$action);
			
			define('CONTROLLER', self::$controller );
			define('ACTION', self::$action);
		}
		
		try
		{
			header('Content-type: text/html; charset='. Config::get('charset'));
			
			Import::core('Controller', 'Template', 'Annotation');
			Import::controller(self::$controller);
		
			$this->controller();
			$this->auth();
			$tpl = new Template();
			$registry->set('Template', $tpl);
			$tpl->render(self::$args);
			
			if($cache_config['enabled'] && $cache_config['page'])
			{
				$cache = Cache::factory();
				$data = ob_get_clean();
				$cache->write(URL, $data, $cache_config['time']);
			}
			
			$debug_config = Config::get('debug');
			if(isset($debug_config['sql']) && $debug_config['sql'])
				Debug::show();
		}
		catch(HTTPException $e)
		{
			$errors = array();
			$errors[400] = 'Bad Request';
			$errors[401] = 'Unauthorized';
			$errors[402] = 'Payment Required';
			$errors[403] = 'Forbidden';
			$errors[404] = 'Not Found';
			$errors[405] = 'Method Not Allowed';
			$errors[406] = 'Not Acceptable';
			$errors[407] = 'Proxy';
			$errors[408] = 'Request Timeout';
			$errors[500] = 'Internal Server Error';
			$errors[501] = 'Not Implemented';
			$errors[502] = 'Bad Gateway';
			$errors[503] = 'Service Unavailable';
			$errors[504] = 'Gateway Timeout';
			
			header('HTTP/1.1 ' . $e->getCode() . ' ' . $errors[$e->getCode()]);
			Error::render($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString(), method_exists($e, 'getDetails') ? $e->getDetails() : '');
			exit;
		}
		catch(Exception $e)
		{
			header('HTTP/1.1 500 Internal Server Error');
			Error::render(500, $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString(), method_exists($e, 'getDetails') ? $e->getDetails() : '');
		}
	}
	
	/**
	 * Extrai os argumentos a partir de URL
	 * @param	string	$url	url acessada pelo usuário
	 * @return	array			retorna um array com os argumentos
	 */
	private function args($url)
	{
		$args = Route::exec($url);

		if(empty($args['module']))
			$args['module'] = null;
		if(empty($args['controller']))
			$args['controller'] = Config::get('default_controller');
		if(empty($args['action']))
			$args['action'] = Config::get('default_action');
		if(empty($args['lang']))
			$args['lang'] = Config::get('default_lang');
		return $args;
	}
	
	/**
	 * Valida o controller requisitado pelo usuário através da URL
	 * @throws	ControllerInheritanceException	dispara se o controller não for subclasse de Controller
	 * @throws	ActionNotFoundException			dispara se a action não existir no controller
	 * @throws	ActionVisibilityException		dispara se a action não estiver como públic
	 * @throws	ActionStaticException			dispara se a action for estática
	 * @throws	PageNotFoundException			dispara se a quantidade obrigatório na action for diferente do esperado
	 * @return	void
	 */
	private function controller()
	{
		if(!is_subclass_of(self::$controller, 'Controller'))
			throw new ControllerInheritanceException(self::$controller);
		
		if(!method_exists(self::$controller, self::$action)) 
			throw new ActionNotFoundException(self::$controller .'->'. self::$action .'()');
		
		$method = new ReflectionMethod(self::$controller, self::$action);
		if(!$method->isPublic()) 
			throw new ActionVisibilityException(self::$controller .'->'. self::$action .'()');
		
		if($method->isStatic()) 
			throw new ActionStaticException(self::$controller .'->'. self::$action .'()');
		
		if(!$this->isValidParams($method))
			throw new PageNotFoundException('A quantidade de parâmetros obrigatórios não conferem');
	}
	
	/**
	 * Verifica se os parâmetros são válidos
	 * @param	object	$method	instância de ReflectionMethod da action requisitada
	 * @return	boolean			retorna true se os parâmetros estiverem certos, ou false no contrário
	 */
	private function isValidParams($method)
	{
		$params = $method->getParameters();
		if(count(self::$args['params']) > count($params)) 
			return false;
		if(count(self::$args['params']) < count($params))
		{
			$cont = 0;
			foreach ($params as $param)
			{
				if(!$param->isOptional()) 
					$cont++;		
			}
			if(count(self::$args['params']) < $cont) 
				return false;
		}
		return true;
	}
	
	/**
	 * Carrega a página de erro de acordo com as configurações e mata a execução
	 * @param	object	$error	instância de Exception
	 * @return	void
	 */
	private function loadError($error)
	{
		Error::render($error->getCode(), $error->getMessage(), $error->getFile(), $error->getLine(), $error->getTraceAsString(), method_exists($error, 'getDetails') ? $error->getDetails() : '');
	}
	
	/**
	 * Verifica se o usuário pode acessar a página de acordo com sua autenticação e a anotação do controller. Se não tiver permissão
	 * é redirecionado para a página de login defina nas configurações
	 * @return	void
	 */
	private function auth()
	{
		$annotation = Annotation::get(self::$controller);
		$roles = null;
		
		if(method_exists(self::$controller, '__construct'))
		{
			$method = new ReflectionMethod(self::$controller, '__construct');
			if($method->isPublic())
			{
				$construct = $annotation->getMethod('__construct');
				if(isset($construct->Auth))
					$roles = $construct->Auth;
			}
		}
		
		$method = $annotation->getMethod(self::$action);
		$auth_action = isset($method->Auth) ? $method->Auth : null;
		
		if($auth_action)
			$roles = $auth_action;
		
		if($auth_action == '*' || (is_array($auth_action) && in_array('*', $auth_action)))
			$roles = null;
		
		if($roles && !is_array($roles))
			$roles = array($roles);
		if($roles)
			call_user_func_array('Auth::allow', $roles);
	}
}
