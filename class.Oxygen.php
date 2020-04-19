<?php

	function Oxygen($o=NULL){
		return new Oxygen($o);
	}

	class Oxygen{

		private $o;

		public function __construct($o=NULL){

			if (!is_null($o)){
				if (is_string($o)){ // asumimos string con un json codificado
					$o = json_decode($o);
				}
				$this->o = $o;
			}else{
				$this->o = new stdClass();
			}
		}


		public function __get($param){

			if (!isset($this->o->$param)) $this->o->$param = new stdClass();
			return $this->o->$param;
		}

		public function __set($param,$v){
			$this->o->$param = $v;
		}


		public function addJSON($json,$file=false){
			if ($file){
				$json = file_get_contents($json);
			}

			$o = json_decode($json);
			$this->addO();
		}

		public function addO($o){

			foreach($o as $k=>$v){
				if (isset($this->o->$k)){ // si existe y además es array, añadimos las posiciones
					if (is_array($this->o->$k)){
						$this->o->$k = array_merge($this->o->$k,$o->$k);
					}
					if (is_object($this->o->$k)){

						$this->o->$k = (new Oxygen($this->o->$k))->addO($o->$k)->getO();
						//$this->o->$k = self::objMerge($this->o->$k);
					}

				}else { // si la propiedad no existe o no es un array, la pisamos.
					$this->o->$k = $v;
				}
			}

			return $this;
		}


		public function getO(){
			return $this->o;
		}

		public function getJSON($pretty = true, $assoc2Scalar = true){
			if ($pretty) $params = JSON_PRETTY_PRINT;

			$o = $this->o;
			if ($assoc2Scalar)  $o = $this::assoc2Scalar($o);

			return json_encode($o,$params);
		}


		
		private static function assoc2Scalar ($o){

			if (is_array($o)){
				foreach ($o as $k=>$v){
					$o[$k] = self::assoc2Scalar($v);
				}
				$o = array_values($o);
			}elseif (is_object($o)){
				foreach ($o as $k=>$v){
					$o->$k = self::assoc2Scalar($v);
				}
			}
			
			return $o;
		}

	}

?>