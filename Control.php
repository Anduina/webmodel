<?php

class Control{
	private $nameProject='webmodel';
	private $name;
	private $gap;
	private $path;

	private $language;
	private $filter;

	public function Control($path){
		$this->path = $path;
		$this->defineGap($path);
		$param = explode("/", $path);
 		$this->name = $param[count($param)-2];
	}

	private function defineGap($path){
		$arrayGap = explode("/", $path);
		$amountGap = count($arrayGap) - 3;
		$this->gap='';
		for ($i=0; $i < $amountGap; $i++) { 
			$this->gap = $this->gap.'../';
		}
	}
	/*-----------------------------------------------css------------------------------------------*/
	public function css(){
		if($this->nameProject == $this->name){
			$css = '<link rel="stylesheet" type="text/css" href="index/css/index.css">';
		}else{
			$css = '<link rel="stylesheet" type="text/css" href="css/'.$this->name.'.css">';
		}
		echo $css;
	}
	public function cssBootstrap(){
		$css = '<link rel="stylesheet" type="text/css" href="'.$this->gap.'bootstrap/css/bootstrap.min.css'.'">';
		echo $css;
	}

	public function cssPublic($name){
		$css = '<link rel="stylesheet" type="text/css" href="'.$this->gap.'public/css/'.$name.'.css'.'">';
		echo $css;
	}

	/*--------------------------------------------------------------------------------------------*/

	/*-----------------------------------------------js------------------------------------------*/
	public function js(){
		$jsDir = '<script src="'.$this->gap.'../'.$this->nameProject.'_private/public/js/js_config.js"></script>';

		if($this->nameProject == $this->name){		
			$js = '<script src="'.$this->gap.'../'.$this->nameProject.'_private/index/js/index.js"></script>';
		}else{
			$size = strlen($this->nameProject)+2;
			$dir = substr($this->path, $size, -9);
			$js = '<script src="'.$this->gap.'../'.$this->nameProject.'_private/'.$dir.'js/'.$this->name.'.js"></script>';
		}
		
		echo $jsDir;
		echo $js;
	}

	public function jsLibrary($name){
		if($this->nameProject == $this->name){		
			$js = '<script src="'.$this->gap.'../'.$this->nameProject.'_private/index/js/library/'.$name.'.js"></script>';
		}else{
			$size = strlen($this->nameProject)+2;
			$dir = substr($this->path, $size, -9);
			$js = '<script src="'.$this->gap.'../'.$this->nameProject.'_private/'.$dir.'js/library/'.$name.'.js"></script>';
		}
		echo $js;
	}

	public function jsBootstrap(){
		$js = '<script src="'.$this->gap.'../'.$this->nameProject.'_private/bootstrap/js/bootstrap.min.js"></script>';
		echo $js;
	}

	public function jsPublic($name){
		$js = '<script src="'.$this->gap.'../'.$this->nameProject.'_private/public/js/'.$name.'.js"></script>';
		echo $js;
	}

	public function jsPublicLibrary($name){
		$js = '<script src="'.$this->gap.'../'.$this->nameProject.'_private/public/js/library/'.$name.'.js"></script>';
		echo $js;
	}

	/*--------------------------------------------------------------------------------------------*/

	/*-----------------------------------------others methods-----------------------------------*/
	public function getInclude($name){
		$dirInc="";
		if($this->nameProject == $this->name){		
			$dirInc = $this->gap.'../'.$this->nameProject.'_private/index/php/includes/'.$name.'.php';
		}else{
			$size = strlen($this->nameProject)+2;
			$dir = substr($this->path, $size, -9);
			$dirInc = $this->gap.'../'.$this->nameProject.'_private/'.$dir.'php/includes/'.$name.'.php';
		}
		
		include_once $dirInc;
	}

	public function getIncludePublic($name){
		$dirInc = $this->gap.'../'.$this->nameProject.'_private/public/php/includes/'.$name.'.php';
		include_once $dirInc;
	}

	public function getClassPublic($name){
		$dirInc = $this->gap.'../'.$this->nameProject.'_private/public/php/class/'.$name.'.php';
		
		include_once $dirInc;
		$object = new ReflectionClass($name);
		return $object->newInstance();
	}

	public function getLanguage(){	
		if (empty($this->language)) {
			include_once $this->gap.'../'.$this->nameProject.'_private/language/language_php/Language.php';
			$this->language = new Language($_SERVER['PHP_SELF'], $this->nameProject);
		}
		
		return $this->language;
	}
	
	public function getNameProject(){
		return $this->nameProject;
	}
	/*--------------------------------------------------------------------------------------------*/	
	
}
