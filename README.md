Jamboree Panels
===============

I'm very glad to introduce this concept when building html for Yii Framework
based applications, inspired in GWT (Google Web Toolkit), a nice designer for 
Java Applications based on not writing pure html, instead write it using 
classes.

I will come to the point:

Please considere the required HTML layout:

Without using Jamboree you must create HTML and CSS well formed to be
consistent for current navigators (ie, opera, chrome, firefox etc),

Now using Jamboree (JamHorzPanel, JamVertPanel and JamElement) you can
build it easily, in this way, using PHP classes:

<?php

$mainpanel = new JamVertPanel();
$mainpanel->addHtmlOption('style','width: 500px;');

$title  = new JamElement("h1","My Title");
$panel1 = new JamHorzPanel();
$panel2 = new JamHorzPanel();

$mainpanel->add($title);
$mainpanel->add($panel1);
$mainpanel->add($panel2);

$lpanel = new JamVertPanel();
$panel1->add($lpanel);
$panel1->add('large text here');

$lpanel->add(new JamImage('images/sample1.png'));
$lpanel->add(CHtml::textArea('text at left built using CHtml','demo text'));

$panel2->addChildStyle('border: 3px solid gray; width: 150px; height: 100px;');
$panel2->addChildStyle('text-align: center; margin: 3px;');
$panel2->add(new JamElement("b","bold text"));
$panel2->add(CHtml::image('images/sample2.png'));
$panel2->add("simple raw text");

$mainpanel->render();
?>

it will output:

example.png


#Install Jamboree

Very simple. Please copy the entire package into your protected/extensions
directory,  as an example: 
	/home/yours/app1/protected/extensions/jamboree

now in your config/main.php file, put the extension visible for your Yii:

	'import'=>array(
   		'application.models.*',
   		'application.models.view.*',
   		'application.components.*',
   		'application.extensions.jamboree.*',
   	),
