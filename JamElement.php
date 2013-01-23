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
	private $_content; // use getContent()

	private $_htmlOptions;

	public function __construct($tag, $content='', $htmlOpts = array()){
		$this->tag = $tag;
		$this->setContent($content);
		$this->_htmlOptions = $htmlOpts;
	}

	public function render($boolWriteContent=true) {
		$tag = $this->getCleanTag();
		// tags used in this form: <tag></tag>
		$beginEndTags = array(
			'h1','h2','h3','h4','h5','h6',
			'a','b','p','u','i',
			'div','span','pre',
			'select','option','textarea','label','ul','l','li','button',
			'table','tr','td',
			'form','iframe','fieldset'
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

	// public helpers

	public function setId($id){
		$this->setHtmlOption('id',$id);
	}

	public function setTextAlignmentCenter(){
		$this->addHtmlOption('style','text-align: center;');
	}

	public function setTextAlignmentLeft(){
		$this->addHtmlOption('style','text-align: left;');
	}

	public function setTextAlignmentRight(){
		$this->addHtmlOption('style','text-align: right;');
	}

	public function setWidth($strValue){
		$this->addHtmlOption('style','width: '.$strValue);
	}

	public function setMinWidth($strValue){
		$this->addHtmlOption('style','min-width: '.$strValue);
	}

	public function setHeight($strValue){
		$this->addHtmlOption('style','height: '.$strValue);
	}

	public function setMinHeight($strValue){
		$this->addHtmlOption('style','min-height: '.$strValue);
	}

	public function setSolidBorder($color='black',$size='1px'){
		$this->addHtmlOption('style','border: '.$size.' solid '.$color);
	}

	public function setiDashedBorder($color='black',$size='1px'){
		$this->addHtmlOption('style','border: '.$size.' dashed '.$color);
	}

	public function setDottedBorder($color='black',$size='1px'){
		$this->addHtmlOption('style','border: '.$size.' dotted '.$color);
	}
	
	public function setBorderNone(){
		$this->addHtmlOption('style', 'border: none;');
	}

	public function setAutoMargin(){
		$this->addHtmlOption('style','margin-left: auto; margin-right: auto;');
	}
	
	public function setOverflowAuto(){
		$this->addHtmlOption('style','overflow: auto;');	
	}
	public function setOverflowVisible(){
		$this->addHtmlOption('style','overflow: visible;');	
	}
	public function setOverflowScroll(){
		$this->addHtmlOption('style','overflow: scroll;');	
	}
	public function setOverflowHidden(){
		$this->addHtmlOption('style','overflow: hidden;');	
	}

	public function addClass($className){
		$this->addHtmlOption('class', $className);
	}

	public function setPadding($value){
		$this->addHtmlOption('style','padding: '.$value);
	}

	public function setColor($color){
		$this->addHtmlOption('style','color: '.$color);
	}

	public function setBgColor($color){
		$this->addHtmlOption('style','background-color: '.$color);
	}

	public function setDisplay($displayValue) {
		$this->addHtmlOption('style','display: '.$displayValue);
	}


	public function setPaddingLeft($value){
		$this->addHtmlOption('style','padding-left: '.$value);
	}
	public function setPaddingRight($value){
		$this->addHtmlOption('style','padding-right: '.$value);
	}
	public function setPaddingTop($value){
		$this->addHtmlOption('style','padding-top: '.$value);
	}
	public function setPaddingBottom($value){
		$this->addHtmlOption('style','padding-bottom: '.$value);
	}


	public function setMarginLeft($value){
		$this->addHtmlOption('style','margin-left: '.$value);
	}
	public function setMarginRight($value){
		$this->addHtmlOption('style','margin-right: '.$value);
	}
	public function setMarginTop($value){
		$this->addHtmlOption('style','margin-top: '.$value);
	}
	public function setMarginBottom($value){
		$this->addHtmlOption('style','margin-bottom: '.$value);
	}


	public function setFloatLeft(){
		$this->addHtmlOption('style','float: left;');
	}

	public function setFloatRight(){
		$this->addHtmlOption('style','float: right;');
	}

	public function setFloatNone(){
		$this->addHtmlOption('style','float: none;');
	}



	// public methods

	public function getHtmlOptions(){
		if($this->_htmlOptions == null){
			$this->_htmlOptions = array();
		}
		return $this->_htmlOptions;
	}

	public function setHtmlOption($name, $value){
		$this->getHtmlOptions();
		$this->_htmlOptions[$name] = trim(trim($value),';');
	}
	public function addHtmlOption($name, $value){
		$separator = ($name == 'style') ? ';' : ' ';
		$this->setHtmlOption($name,
			rtrim($this->getHtmlOption($name),$separator).$separator.
				ltrim($value,$separator));
	}
	public function setHtmlOptions($htmlOptions){
		foreach($htmlOptions as $opt=>$value)
			$this->setHtmlOption($opt,$value);
	}
	public function addHtmlOptions($htmlOptions){
		foreach($htmlOptions as $opt=>$value)
			$this->addHtmlOption($opt,$value);
	}


	public function getHtmlOption($name){
		$items = $this->getHtmlOptions();
		if(array_key_exists($name, $items))
			return $items[$name];
		return "";
	}

	/**
	 * getContent
	 *	returns the element content, because an element->content can be
	 *	raw text or another JamElement, so this method will return text
	 *	in both cases: raw text or text comming from render() result.
	 * 
	 * @access public
	 * @return string
	 */
	public function getContent(){
		if($this->_content == null)	
			return "";
		if(is_object($this->_content)){
			if(method_exists($this->_content,"render")){
				return $this->_content->render(false);
			}else{
				return "";
			}
		}else
			return $this->_content;
	}

	/**
	 * setContent
	 *  can be text or another JamElement
	 * 
	 * @param mixed $obj 
	 * @access public
	 * @return void
	 */
	public function setContent($obj){
		if(is_object($obj)){
			if(method_exists($obj,"render"))
				$this->_content = $obj->render(false);
		}else
		return $this->_content = $obj;
	}
	public function addContent($obj){
		if($this->_content == null)
			$this->_content = "";
		if(is_object($obj)){
			if(method_exists($obj,"render"))
				$this->_content .= $obj->render(false);
		}else
		return $this->_content .= $obj;
	}

	// private section

	private function _renderBeginEndTag($tag){
		$htopts = $this->getOpts();
		if($htopts != '')
			$htopts = ' '.$htopts;
		return "<{$tag}{$htopts}>".$this->getContent()."</{$tag}>";
	}

	private function _renderSingleTag($tag){
		$htopts = $this->getOpts();
		if($htopts != '')
			$htopts = ' '.$htopts;
		return "<{$tag}{$htopts}/>";
	}

	private function getCleanTag(){
		return trim(strtolower($this->tag));
	}
	private function getOpts(){
		$htopts = "";
		foreach($this->htmlOptions as $key=>$value){
			$v = trim($value);
			if($v != '')
				$htopts .= " {$key}='{$v}'";
		}
		return trim($htopts);
	}

	// static public

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
