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
	private $_childstyle;

	public $defaultStyle = 'margin: 3px; overflow: auto;';
	public $defaultBorder = 'border: 1px dotted gray;';
	public $defaultPadding = 'padding: 3px;';
	


	public function __construct(){	
		parent::__construct('div', '');
		$this->_childstyle = '';
		$this->setHtmlOption('class','jam-panel');
		$this->setHtmlOption('style',$this->defaultStyle);
		$this->addHtmlOption('style',$this->defaultBorder);
		$this->addHtmlOption('style',$this->defaultPadding);
	}

	public function add($obj){
		$this->getList();
		if(is_string($obj)){
			$obj = new JamElement("div",$obj);	
			$obj->setHtmlOption('class','jam-element');
		}
		if($this->_childstyle != '')
			$obj->addHtmlOption('style',$this->_childstyle);
		$this->_list[] = $obj;
	}

	public function addChildStyle($style){
		$this->_childstyle = rtrim($this->_childstyle,';')
			.';'.ltrim($style,';');
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
		$this->content = "";
		$is_first_panel = true;
		foreach($this->getList() as $panel){
			if(is_string($panel)){
				$this->content .= $panel;
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
				$forChilds = $this->getSpecialStyleForChilds();
				if($forChilds != '')
					$panel->setHtmlOption('style',
						ltrim($panel->getHtmlOption('style')
							.';'.$forChilds,';'));

				$this->content .= $panel->render(false);
				$is_first_panel = false;
			}
		}
		return parent::render($boolWriteContent);
	}
}
