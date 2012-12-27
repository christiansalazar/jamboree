<?php
/**
 * JamVertPanel 
 *
 *	Represent a Vertical panel containing childs. (JamElements, String,
 *	or another JamPanel sub classes).
 *
 *	All childs are organized in a Vertical fashion.
 *
 *	example:
 *	
 *		$p = new JamVertPanel();
 *		$p->add("hello");
 *		$p->add(new JamElement("a","my link",array('href'=>'#')));
 *		// $p->add(..and another panel too..);
 *		// because JamVertPanel is a subclass of JamElement you can:
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
class JamVertPanel extends JamPanel {
	public function __construct($tag='div'){
		parent::__construct($tag);
		$curClassName = $this->getHtmlOption('class');
		$this->setHtmlOption('class',$curClassName.' jam-vert-panel');
	}
	public function add($obj, $boolApplyDefaultFloatStyle=true){
		$obj = parent::add($obj);
		if($boolApplyDefaultFloatStyle)
			$obj->addHtmlOption('style','display: block;');
		return $obj;
	}
}
