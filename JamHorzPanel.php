<?php
/**
 * JamHorzPanel 
 *
 *	Represent an Horizontal panel containing childs. (JamElements, String,
 *	or another JamPanel sub classes).
 *
 *	All childs are organized in an horizontal fashion, left floated.
 *
 *	example:
 *	
 *		$p = new JamHorzPanel();
 *		$p->add("hello");
 *		$p->add(new JamElement("a","my link",array('href'=>'#')));
 *		// $p->add(..and another panel too..);
 *		// because JamHorzPanel is a subclass of JamElement you can:
 *		$p->addHtmlOption('style','border: 1px solid red;'); // and so on..
 *		$p->setHtmlOption('id','mypanelid');
 *		// finally build output:
 *		$p->render(); // will echo
 *		$myvar = $p->render(false); // returns output
 *
 * @uses JamPanel
 * @package Jamboree
 * @author Christian Salazar H. <christiansalazarh@gmail.com>
 * @license http://opensource.org/licenses/bsd-license.php
 */
class JamHorzPanel extends JamPanel {
	
	public function __construct($tag='div'){
		parent::__construct($tag);
		$curClassName = $this->getHtmlOption('class');
		$this->setHtmlOption('class',$curClassName.' jam-horz-panel');
	}

	public function add($obj, $boolApplyDefaultStyles=true){
		$obj = parent::add($obj);
		if($boolApplyDefaultStyles == true)
			$obj->addHtmlOption('style','float: left;');
		return $obj;
	}
}
