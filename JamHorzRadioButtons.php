<?php
/**
 * JamHorzRadioButtons 
 *	creates an Horizontal radio button set (labeled).
 *
 *	example usage:
 *
 *		$myradio = new JamHorzRadioButtons('flavors');
 *		$myradio->add('Orange','flavor_orange',true);
 *		$myradio->add('Lime');
 *		
 *		now you can insert $myradio into any Jamboree panel.
 *
 * @uses JamHorzPanel
 * @package
 * @author Christian Salazar H. <christiansalazarh@gmail.com>
 * @license http://opensource.org/licenses/bsd-license.php
 */
class JamHorzRadioButtons extends JamHorzPanel {
	
	private $_name;	
	private $_count;

	public function __construct($name){
		$this->_name = $name;
		$this->_count = 1;
		parent::__construct();
		$this->setBorderNone();
	}

	public function add($labelText, $radioId=null, $boolChecked=false) {
		
		if($radioId == null){
			$radio_id = $this->_name.'_'.$this->_count;
		}else{
			$radio_id = $radioId;
		}

		$label = new JamElement('label',$labelText);	
		$label->setHtmlOption('for',$radio_id);

		$input = new JamElement('input');
		$input->setId($radio_id);
		$input->setHtmlOption('name',$this->_name);
		$input->setHtmlOption('type','radio');
		if($boolChecked == true)
			$input->setHtmlOption('checked','checked');

		$hpanel = parent::add(new JamHorzPanel());
		$hpanel->setBorderNone();
		$hpanel->add($label);
		$hpanel->add($input);

		return $hpanel;
	}


}
