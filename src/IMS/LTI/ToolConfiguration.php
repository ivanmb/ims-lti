<?php

namespace IMS\LTI;

/**
 * Class used to represent an LTI configuration
 * It can create and read the Common Cartridge XML representation of LTI links
 * as described here: http://www.imsglobal.org/LTI/v1p1pd/ltiIMGv1p1pd.html#_Toc309649689
 *
 */
class ToolConfiguration {
	// Parameters
	
	private $options = array(
		'title',
		'description',
		'launch_url',
		'secure_launch_url',
		'icon',
		'secure_icon',
		'cartridge_bundle',
		'cartridge_icon',
		'vendor_code',
		'vendor_name',
		'vendor_description',
		'vendor_url',
		'vendor_contact_email',
		'vendor_contact_name',
	);
	
	private $xmlNamespaces = array(
		"xmlns" => 'http://www.imsglobal.org/xsd/imslticc_v1p0',
		"blti" => 'http://www.imsglobal.org/xsd/imsbasiclti_v1p0',
		"lticm" => 'http://www.imsglobal.org/xsd/imslticm_v1p0',
		"lticp" => 'http://www.imsglobal.org/xsd/imslticp_v1p0',
	);
	
	protected $parameters;
	
	protected function getParameter($name) {
		if(array_key_exists($name, $this->parameters)) {
			return $this->parameters[$name];
		}
	}
	
	// Getters for parametrs
	
	public function getTitle() {
		return $this->getParameter('title');
	}
	
	// Public methods
	
	public function __construct($params = array()) {
		if($diff = array_diff(array_keys($params), $this->options)) {
			throw new \InvalidArgumentException(sprintf("Found invalid parameters %s", join(',', $diff)));
		}
		
		$this->parameters = $params;
	}
	
	public static function createFromXml($xml) {
		$config = new ToolConfiguration();
		$config->processXml($xml);
		
		return $config;
	}
	
	public function processXml($xml) {
		$doc = new \SimpleXMLElement($xml);
		foreach($this->xmlNamespaces as $prefix => $ns) {
			$doc->registerXPathNamespace($prefix, $ns);
		}
		
		if($root = $this->getFirstMatchOrNull($doc, '//xmlns:cartridge_basiclti_link')) {
			$this->parameters['title'] = $this->getFirstMatchOrNull($root, '//blti:title');
		}
	}
	
	// Private methods
	
	private function getFirstMatchOrNull(&$node, $xpath) {
		$results = $node->xpath($xpath);
		if(count($results)) {
			return $results[0];
		}
		return null;
	}
	
}