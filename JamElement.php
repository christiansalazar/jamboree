<?php
/**
 * JamElement
 *
 *	This is the base class for all Jamboree class hierarchy.
 *	An example usage for this class is as follows:
 *	
 *		$element = new JamElement("p","this is my paragraph",array(
 *				'style'=>'border: 1px solid white;',
 *				'class'=>'myparagraph',
 *				'alt'=>'any thing',
 *			));
 *
 *	A JamElement constructs a well formed html TAG, and is recognized by
 *	the JamPanels (JamVertPanel and JamHorzPanel).
 *
 *	When working togheter with JamPanel sub classes please insert the
 *	assets in your page in this way:
 *		
 *		JamElement::publishAssets();
 *
 * @package jamboree
 * @author Christian Salazar H. <christiansalazarh@gmail.com>
 * @license http://opensource.org/licenses/bsd-license.php
 */
class JamElement extends CComponent {
	public $tag;
	public $content;

	private $_htmlOptions;

	public function __construct($tag, $content='', $htmlOpts = array()){
		$this->tag = $tag;
		$this->content = $content;
		$this->_htmlOptions = $htmlOpts;
	}

	public function render($boolWriteContent=true) {
		$tag = $this->getCleanTag();
		// tags used in this form: <tag></tag>
		$beginEndTags = array(
			'h1','h2','h3','h4','h5','h6',
			'a','b','p','u','i',
			'div','span','pre',
			'select','option','textarea','label','ul','l','li'
		);
		if(in_array($tag, $beginEndTags)){
			if($boolWriteContent == true){
				echo $this->_renderBeginEndTag($tag);
			}else
			return $this->_renderBeginEndTag($tag);
		}
		else{
			if($boolWriteContent == true){
    			echo $this->_renderSingleTag($tag);
    		}else
    		return $this->_renderSingleTag($tag);
		}
	}

	private function _renderBeginEndTag($tag){
		$htopts = $this->getOpts();
		if($htopts != '')
			$htopts = ' '.$htopts;
		return "<{$tag}{$htopts}>".$this->content."</{$tag}>";
	}

	private function _renderSingleTag($tag){
		$htopts = $this->getOpts();
		if($htopts != '')
			$htopts = ' '.$htopts;
		return "<{$tag}{$htopts}/>";
	}



	public function getHtmlOptions(){
		if($this->_htmlOptions == null){
			$this->_htmlOptions = array();
		}
		return $this->_htmlOptions;
	}

	public function setHtmlOption($name, $value){
		$this->getHtmlOptions();
		$this->_htmlOptions[$name] = $value;
	}
	public function addHtmlOption($name, $value){
		$this->setHtmlOption($name,
			rtrim($this->getHtmlOption($name),';').';'.ltrim($value,';'));
	}

	public function getHtmlOption($name){
		$items = $this->getHtmlOptions();
		if(array_key_exists($name, $items))
			return $items[$name];
		return "";
	}

	private function getCleanTag(){
		return trim(strtolower($this->tag));
	}
	private function getOpts(){
		$htopts = "";
		foreach($this->htmlOptions as $key=>$value)
			$htopts .= " {$key}='{$value}'";
		return trim($htopts);
	}

	public static function publishAssets()
	{
		$js = array();
		$css = array('jamboree.css');
		$assets = dirname(__FILE__).'/assets';
		$baseUrl = Yii::app()->assetManager->publish($assets);
		if(is_dir($assets)){
			Yii::app()->clientScript->registerCoreScript('jquery');
			foreach($js as $jsfile)
			Yii::app()->clientScript->registerScriptFile(
				$baseUrl.'/'.$jsfile, CClientScript::POS_HEAD);
			foreach($css as $cssfile)
			Yii::app()->clientScript->registerCssFile(
				$baseUrl.'/'.$cssfile, CClientScript::POS_HEAD);
		} 
		else {
			throw new 
			Exception('JamElement::publishAssets - error in assets directory.');
		}
	}
}
