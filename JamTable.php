<?php 
/**
 * JamTable
 *
 *	You can create an HTML standard table using this class.
 *
 *
	$table = new JamTable();
	$table->setWidth('300px');
	$table->setSolidBorder('3px','#def');
	$table->head(
		array(
			array('text'=>'col 1',
				'htmlOptions'=>array('style'=>'background-color: #eee')),
			'any col',
			array('text'=>'price',
				'htmlOptions'=>array('style'=>'text-align: right')),
		)
		,array('style'=>'border: none;')
	);
	for($i=0;$i<3;$i++)
		$table->row(array(
			array('text'=>'abc'.$i,
		'htmlOptions'=>array('style'=>'background-color: #eee;border: none;')),
			'some text',
			array('text'=>'123.00',
				'htmlOptions'=>array('style'=>'text-align: right')),
		));
	$table->render();
 *
 * @uses JamVertPanel
 * @package jamboree 
 * @author Christian Salazar H. <christiansalazarh@gmail.com>
 * @license http://opensource.org/licenses/bsd-license.php
 */
class JamTable extends JamVertPanel {

	public $headStyle ='padding: 2px; background-color: #eee;font-weight: bold';
	public $tdStyle ='padding: 2px; border-bottom: 1px dashed #aaa';

	public function __construct(){
		parent::__construct('table');
		$this->setHtmlOption('class','');
		$this->addHtmlOption('style','width: auto;');
	}
	
	/**
	 * head
	 *	identical to row method, the difference is the global headStyle, wich
	 *	will be applied to each TD in this TR.
	 * 
	 * @param mixed $def 	see also row method
	 * @param array $tdhtmlOptions see also row method
	 * @access public
	 * @return the new JamElement created (the TR row)
	 */
	public function head($def, $tdhtmlOptions = array()){
		$tmp = $this->tdStyle;
		$this->tdStyle = $this->headStyle;
		$obj = $this->row($def, $tdhtmlOptions);
		$this->tdStyle = $tmp;
		return $obj;
	}	
	
	/**
	 * row
	 *	create a table TR and TD elements
	 *
	 *	this example will add a single ROW (TR) containing two TD elements.
	 *
	 *		table->row(
	 *			'single value',
	 *			array('text'=>'td content', 'htmlOptions'=>array(...))
	 *		);
	 *
	 *	htmlOptions is an array of valid html options, as an example:
	 *		array('style'=>'color: red', 'alt'=>'abc', 'id'=>'mycell')
	 *
	 *
	 * @param mixed $def definition for each TD
	 * @param array $commonHtmlOptions  common htmlOptions for each TD
	 * @return the new JamElement created (the TR row)
	 */
	public function row($def, $commonHtmlOptions = array())
	{
		$row = new JamHorzPanel('tr');
		$row->setHtmlOption('class','');
		foreach($def as $item){
			if(is_array($item)){
				$col = $row->add(new JamElement('td',$item['text']), false);
				// default options
				$col->setHtmlOption('style',$this->tdStyle);
				// common options
				if($commonHtmlOptions != null)
					foreach($commonHtmlOptions as $opt=>$val)
						$col->addHtmlOption($opt, $val);
				// specific options
				if(isset($item['htmlOptions']))
					if(is_array($item['htmlOptions']))
						foreach($item['htmlOptions'] as $opt=>$value)
							$col->addHtmlOption($opt, $value);
			}else{
				$col = $row->add(new JamElement('td',$item),false);
				// default option
				$col->setHtmlOption('style',$this->tdStyle);
				// common options
				if($commonHtmlOptions != null)
					foreach($commonHtmlOptions as $opt=>$val)
						$col->addHtmlOption($opt, $val);
			}
		}
		return $this->add($row, false);
	}
}
