<?php
/**
 * JamImage
 *
 *	Is a helper class for image tag creation based on a JamElement and
 *	easily consumible by JamPanel sub classes.
 *
 *	Example usage:
 *
 *	Suppouse you have a panel:
 *
 *		$p = new JamVertPanel();
 *		$p->add(new JamImage('images/hello.jpg'));
 *		$p->add(new JamImage('images/again.jpg'));
 *		$p->render();
 *		// will output two images organizated in vertical position as
 *		// child images for the panel.
 *
 *	You can do the same thing using a pure JamElement:
 *		$img = new JamElement('img','',array('src'=>'images/hello.jpg'));
 *	but using JamImage is shortly...
 * 
 * @uses JamElement
 * @package Jamboree
 * @author Christian Salazar H. <christiansalazarh@gmail.com>
 * @license http://opensource.org/licenses/bsd-license.php
 */
class JamImage extends JamElement {
	public function __construct($src, $alt='',$htmlOptions=array()){
		parent::__construct('img','',$htmlOptions);
		$this->setHtmlOption('src',$src);
		$this->setHtmlOption('alt',$alt);
	}
}
