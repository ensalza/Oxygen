<?php

	function Oxygen($o=NULL){
		return new Oxygen($o);
	}

	class Oxygen implements Iterator{

		protected $o;
		private $auxKey = "k";

		public function __construct($o=NULL,$file=false){

			$this->o = new stdClass();
			if (!is_null($o)){
				if (is_string($o)){ // asumimos string con un json codificado
					$this->addJSON($i,$file);
				}else {
					$this->addO($o);
				}
			}
		}


		public function rewind() {
	        reset($this->o);
	    }

	    public function current() {
	        return current($this->o);
	    }

	    public function key() {
	       return key($this->o);
	   }

	    public function next() {
	        return next($this->o);
	    }

	    public function valid() {
			$clave = key($this->o);
        	$var = ($clave !== NULL && $clave !== FALSE);
			return $var;
	    }


		public function __get($param){

			if (!isset($this->o->$param)){
				$this->o->$param = new Oxygen();	
			} 
			return $this->o->$param;
		}

		public function __set($param,$v){
			$this->o->$param = $v;
		}

		public function addXML($xml,$file=false){
			if ($file){
				$xml = simplexml_load_file ( $file);
			}else{
				$xml = simplexml_load_string ( $xml );
			}

			$o = self::XML2O($xml);

			$this->addO($o);

			return $this;
		}


		private static function XML2O($xml){

			if (is_a($xml,"SimpleXMLElement")){
				$o = new Oxygen();
				foreach ((array)$xml as $k=>$v){
					$o->$k = self::XML2O($v);
				}
			}else {
				$o = $xml;
			}
			
			return $o;

		}

		public function addJSON($json,$file=false){
			if ($file){
				$json = file_get_contents($json);
			}

			$o = json_decode($json);
			$this->addO($o);

			return $this;
		}

		public function addO($o){

			foreach($o as $k=>$v){
				if (isset($this->o->$k)){ // si existe y además es array, añadimos las posiciones
					if (is_array($this->o->$k)){
						$this->o->$k = array_merge($this->o->$k,$o->$k);
					}elseif (is_object($this->o->$k)){
						$this->o->$k = (new Oxygen($this->o->$k))->addO($o->$k)->getO();
					}else {
						$this->o->$k = $v;
					}

				}else { // si la propiedad no existe o no es un array, la pisamos.
					$this->o->$k = $v;
				}
			}

			return $this;
		}


		public function getO(){
			return self::plain($this->o);
		}


		private static function plain ($o){

			// al pasar por esta función, los Oxygen retornan sus valores y dejan de ser oxygen para convertirse en stdClass
			if (is_array($o)){
				foreach ($o as $k=>$v){
					$o[$k] = self::plain($v);
				}
			}elseif (is_a($o,"Oxygen")){
				$o2 = new stdClass();
				foreach ($o as $k=>$v){
					$o2->$k = self::plain($v);
				}
				$o = $o2;
			}elseif (is_object($o)) {
				foreach ($o as $k=>$v){
					$o->$k = self::plain($v);
				}
			}

			return $o;
		}

		public function getJSON($pretty = true, $assoc2Scalar = true){
			if ($pretty) $params = JSON_PRETTY_PRINT;

			$o = $this->getO();
			if ($assoc2Scalar)  $o = $this::assoc2Scalar($o);

			return json_encode($o,$params);
		}


		public function writeJSON($pretty = true, $assoc2Scalar = true){
			header('Content-Type: application/json'); 
			echo $this->getJSON($pretty, $assoc2Scalar);
		}
		public function writeXML($rootKey="xml", $auxKey="x", $encoding="utf-8"){
			header ("Content-Type:text/xml");
			echo $this->getXML($rootKey, $auxKey, $encoding);
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


		public function getXML($rootKey="xml", $auxKey="x", $encoding="utf-8") {

			$xml = new XmlWriter();
			$xml->openMemory();
			$xml->startDocument('1.0',$encoding);
			$xml->setIndent(true);
			$this->auxKey = $auxKey;

			$xml->startElement($rootKey);
			$this->o2XML($xml, $this->getO());
			$xml->endElement();

			return $xml->outputMemory(true);
		}

		private function o2XML(XMLWriter $xml, $o){
			foreach($o as $key => $value) {
				if(is_object($value)){
					$xml->startElement($key);
					$this->o2XML($xml, $value);
					$xml->endElement();
				} elseif(is_array($value)){ // si es array asociativo, lo tratamos como la anterior
					if (is_string(array_values($value)[0])){
						$xml->startElement($key);
						$this->o2XML($xml, $value);
						$xml->endElement();						
					}else{
						// metemos el elemento actual tantas veces como posiciones tenga el array
						foreach ($value as $key2=>$value2){
							if (is_object($value2) || is_array($value2)){

								$xml->startElement($key);
								$this->o2XML($xml, $value2);
								$xml->endElement();						
							}else{
								self::writeElement($xml, $key, $value2);	
							}	
						}
					}
				} else {
					self::writeElement($xml, $key, $value);
				}
			}
		}


		private static function writeElement($xml, $key, $value){

			if (substr($key,0,9)=="__CDATA__"){
				$key = str_replace("__CDATA__","",$key);

				$xml->startElement($key);
				$xml->writeCData($value);
				$xml->endElement();						
		
			}else {
				$xml->writeElement($key, $value);
			}

			return $xml;					
		}
	}

?>