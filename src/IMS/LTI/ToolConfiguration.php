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
	
	public function getDescription() {
		return $this->getParameter('description');
	}
	
	public function getLaunchUrl() {
		return $this->getParameter('launch_url');
	}
	
	public function getSecureLaunchUrl() {
		return $this->getParameter('secure_launch_url');
	}
	
	public function getIcon() {
		return $this->getParameter('icon');
	}
	
	public function getSecureIcon() {
		return $this->getParameter('secure_icon');
	}
	
	public function getCartridgeBundle() {
		return $this->getParameter('cartridge_bundle');
	}
	
	public function getCartridgeIcon() {
		return $this->getParameter('cartridge_icon');
	}
	
	public function getVendorCode() {
		return $this->getParameter('vendor_code');
	}
	
	public function getVendorName() {
		return $this->getParameter('vendor_name');
	}
	
	public function getVendorDescription() {
		return $this->getParameter('vendor_description');
	}
	
	public function getVendorUrl() {
		return $this->getParameter('vendor_url');
	}
	
	public function getVendorContactEmail() {
		return $this->getParameter('vendor_contact_email');
	}
	
	public function getVendorContactName() {
		return $this->getParameter('vendor_contact_name');
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
		
		if($root = $this->getFirstNodeOrNull($doc, '//xmlns:cartridge_basiclti_link')) {
			$this->parameters['title'] = $this->getFirstMatchOrNull($root, '//blti:title');
			$this->parameters['description'] = $this->getFirstMatchOrNull($root, '//blti:description');
			$this->parameters['launch_url'] = $this->getFirstMatchOrNull($root, '//blti:launch_url');
			$this->parameters['secure_launch_url'] = $this->getFirstMatchOrNull($root, '//blti:secure_launch_url');
			$this->parameters['icon'] = $this->getFirstMatchOrNull($root, '//blti:icon');
			$this->parameters['secure_icon'] = $this->getFirstMatchOrNull($root, '//blti:secure_icon');
			$this->parameters['cartridge_bundle'] = $this->getAttributeOrNull($root, '//xmlns:cartridge_bundle', 'identifierref');
			$this->parameters['cartridge_icon'] = $this->getAttributeOrNull($root, '//xmlns:cartridge_icon', 'identifierref');
			
			if($vendor = $this->getFirstNodeOrNull($root, '//blti:vendor')) {
				$this->parameters['vendor_code'] = $this->getFirstMatchOrNull($vendor, '//lticp:code');
				$this->parameters['vendor_description'] = $this->getFirstMatchOrNull($vendor, '//lticp:description');
				$this->parameters['vendor_name'] = $this->getFirstMatchOrNull($vendor, '//lticp:name');
				$this->parameters['vendor_url'] = $this->getFirstMatchOrNull($vendor, '//lticp:url');
				$this->parameters['vendor_contact_email'] = $this->getFirstMatchOrNull($vendor, '//lticp:contact/lticp:email');
				$this->parameters['vendor_contact_name'] = $this->getFirstMatchOrNull($vendor, '//lticp:contact/lticp:name');
			}
						
			//@TODO: Custom Parameters
			
			//@TODO: Extensions
		}
	}
	
	//@TODO: toXml (config to xml) 
	
	// Private methods
	
	private function registerNamespaces(\SimpleXMLElement $node) {
		foreach($this->xmlNamespaces as $prefix => $ns) {
			$node->registerXPathNamespace($prefix, $ns);
		}
	}
	
	private function getFirstNodeOrNull($node, $xpath) {
		$this->registerNamespaces($node);
		
		$results = $node->xpath($xpath);
		if(count($results)) {
			return $results[0];
		}
		return null;
	}
	
	private function getFirstMatchOrNull($node, $xpath) {
		$node = $this->getFirstNodeOrNull($node, $xpath);
		
		return isset($node) ? (string) $node : null;
	}
	
	private function getAttributeOrNull($node, $xpath, $attribute) {
		$match = $this->getFirstNodeOrNull($node, $xpath);
		
		return $match ? $match[$attribute] : null; 
	}
	
}