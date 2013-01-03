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

	/**
	 * add
	 *	inserts a new radio button.
	 *
	 *		example:
	 *
	 *		$myradio = new JamHorzRadioButtons();
	 *		$myradio->add('Blue','B');
	 *		$myradio->add('Red','R');
	 * 
	 * @param mixed $labelText the radio label text
	 * @param string $value the radio value
	 * @param mixed $boolChecked true if this radio option must be checked
	 * @access public
	 * @return the full JamPanel created
	 */
	public function add($labelText, $value='X', $boolChecked=false) {
		
		$radio_id = $this->_name.'_'.$this->_count;
		$this->_count++;

		$label = new JamElement('label',$labelText);	
		$label->setHtmlOption('for',$radio_id);

		$input = new JamElement('input');
		$input->setId($radio_id);
		$input->setHtmlOption('name',$this->_name);
		$input->setHtmlOption('type','radio');
		$input->setHtmlOption('value',$value);
		if($boolChecked == true)
			$input->setHtmlOption('checked','checked');

		$hpanel = parent::add(new JamHorzPanel());
		$hpanel->setBorderNone();
		$hpanel->add($label);
		$hpanel->add($input);

		return $hpanel;
	}


}
