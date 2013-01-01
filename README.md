Jamboree Panels
===============

**An Html Layout Builder for Yii Framework, based on GWT (Google Web Toolkit).**

I'm very glad to introduce this concept when building html for Yii Framework
based applications, inspired in GWT (Google Web Toolkit), a nice designer for 
Java Applications based on not writing pure html, instead write it using 
classes.

I will come to the point:

Please consider the required HTML layout:

![required layout for your app](https://bitbucket.org/christiansalazarh/jamboree/downloads/example-layout.png "required layout for your app")

Without using Jamboree you must create HTML and CSS well formed to be
consistent for current navigators (ie, opera, chrome, firefox etc),

Now using Jamboree (JamHorzPanel, JamVertPanel and JamElement) you can
build it easily, in this way, using PHP classes:

~~~
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

// styles applied to child elements when calling the 'add' method.
$panel2->addChildHtmlOptions(array(
	'style'=>'border: 3px solid gray; width: 150px; height: 100px; text-align: center; margin: 3px;',
));

$panel2->add(new JamElement("b","bold text"));
$panel2->add(CHtml::image('images/sample2.png'));
$panel2->add("simple raw text");

// calling 'render' without any argument will echo the result, 
// in order to return the output please use $mainpanel->render(false);
$mainpanel->render();
?>
~~~

it will output:
---------------

![layout designed using Jamboree](https://bitbucket.org/christiansalazarh/jamboree/downloads/example.png "Layout designed using Jamboree")


#Real Examples:

![real checkout example](wiki/checkout-example.png "real checkout")

please check more examples at wiki.


#Install Jamboree

Please copy the entire package into your protected/extensions directory: 

	/home/yours/app1/protected/extensions/jamboree

now in your config/main.php file, put the extension visible:

~~~
'import'=>array(
	'application.models.*',
	'application.models.view.*',
	'application.components.*',
	'application.extensions.jamboree.*',
),
~~~

Enjoy it, please feel free to colaborate in this repository.
