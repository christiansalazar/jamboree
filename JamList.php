<?php
/**
 * JamList 
 *
 *	Represents an UL tag.
 *
 *	example:
 *	
 *		$p = new JamList(); // defaults to 'UL'
 *		$p->add("item 1");
 *		$p->add("item ");
 *		$p->render(); // will echo "<UL><li>text</li></ul>"
 *
 * @uses JamPanel
 * @package Jamboree
 * @author Christian Salazar H. <christiansalazarh@gmail.com>
 * @license http://opensource.org/licenses/bsd-license.php
 */
class JamList extends JamPanel {
	public function __construct($tag='UL'){
		parent::__construct($tag);
		$this->setHtmlOption('style','');
		$this->setHtmlOption('class','');
	}
	public function add($obj){
		return parent::add(new JamElement("LI",$obj));
	}
}
