<?php 
/**
 * JamPanel
 *
 *	this is the base class for JamHorzPanel and JamVertPanel, to check an
 *	example, please look at this sub classes.
 *
 * 
 * @package Jamboree
 * @author Christian Salazar H. <christiansalazarh@gmail.com>
 * @license http://opensource.org/licenses/bsd-license.php
 */
abstract class JamPanel extends JamElement {
	private $_list;
	private $_childHtmlOptions;

	public $defaultStyle = 'overflow: auto;';
	public $defaultBorder = 'border: 1px dotted gray;';
	public $defaultPadding = 'padding: 3px;';

	public function __construct($tag='div'){	
		parent::__construct($tag, '');
		$this->_childHtmlOptions = array();
		$this->setHtmlOption('class','jam-panel');
		$this->setHtmlOption('style',$this->defaultStyle);
		$this->addHtmlOption('style',$this->defaultBorder);
		$this->addHtmlOption('style',$this->defaultPadding);
	}

	public function add($obj){
		$this->getList();
		if(!is_object($obj)){
			$obj = new JamElement("div",$obj);	
			$obj->setHtmlOption('class','jam-element');
		}
		foreach($this->_childHtmlOptions as $key=>$value)
			$obj->addHtmlOption($key,$value);
		$this->_list[] = $obj;
		return $obj;
	}

	public function addChildHtmlOptions($htmlOptions){
		$this->_childHtmlOptions = $htmlOptions;		
	}

	public function clearChildHtmlOptions(){
		$this->_childHtmlOptions = array();
	}

	private function getList(){
		if($this->_list == null){
			$this->_list = array();
		}
		return $this->_list;
	}

	protected function getSpecialStyleForChilds(){
		return "";
	}

	public function render($boolWriteContent=true){
		$this->setContent("");
		$is_first_panel = true;
		foreach($this->getList() as $panel){
			if(is_string($panel)){
				$this->addContent($panel);
			}else{
				if($is_first_panel){
					// mark this panel as the first
					$classes = $panel->getHtmlOption('class');
					$className = 'jam-first-panel';
					if(!strstr($classes,$className)){
						$classes .= ' '.$className;
						$classes = trim($classes);
					}
					$panel->setHtmlOption('class',$classes);
				}

				$this->addContent($panel);
				$is_first_panel = false;
			}
		}
		return parent::render($boolWriteContent);
	}
}
