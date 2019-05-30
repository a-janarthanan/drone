**Server requirements:

    -There are connectors for PHP and Python.
    -Image preview and thumbnails creation requires:
          -PHP: mogrify utility or GD/Imagick module
          -Python: PIL library

All the demos included use PHP but most can be quickly changed to work with Python.



**PHP

Extract files to PHP server.

If you place it in the root directory of localhost so that readme.txt is located at http://localhost/rte-fileupload/readme.txt it should work right out of the box. If you extract it to a different directory you will have to edit connectors/php/connector.php so that “root” and “URL” point correctly in relation to where you located it.

At this point you are ready to start looking at the demos. Start with demos/index.html



**Python

Setup is the same as with PHP except that you will be using connectors/python/connectors.py instead of the PHP connector.

To get the demos working you will have to replace each link to the PHP connector (connectors/php/connector.php) with the Python connector (connectors/python/connectors.py).

The demos that you can easily get working in Python all end in .html The ones that rely heavily on PHP end in .php



**Demos

All demos are located in the sub-folder demos/

The standard demo is of a text area with rich edit and image upload. It is called: rte.html

If you have a text field in which you want the URL of an uploaded image (or other file) look at this demo: text_field.html

If you want both the text area and text field on the same page (or in the same form) look at this demo: rte-text_field.html

If you need multiple of either this demo has two of each: 2rte-2text_field.html

Also included is a PHP based GUI for setting some of the common setting for the rich text editor and getting an immediate look at that implementation. It gives you three views, the graphic look, the JS and CSS includes and scripts needed to implement your chosen setting, and the full code of a demo page using those settings. It is called: rte-gui.php

Finally there is some demo PHP code that calls a function to fill out the head and insert the form. The functions were built for a specific use-case so you will probably have to write your own for your project but it may give you some ideas. This is called: rte-text_field.php and calls app/functions.php for the functions.



**Basic Documentation
To get this rich text editor working on your project include this code in the head of your html document along with your other js or css files.

		<!-- jQuery and jQuery UI -->
		<script src="js/jquery-1.4.4.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery-ui-1.8.7.custom.min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.7.custom.css" type="text/css" media="screen" charset="utf-8">

		<!-- elRTE -->
		<script src="js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="css/elrte.min.css" type="text/css" media="screen" charset="utf-8">

		<!-- elFinder -->
		<link rel="stylesheet" href="css/elfinder.css" type="text/css" media="screen" charset="utf-8" />
		<script src="js/elfinder.full.js" type="text/javascript" charset="utf-8"></script>

		<!-- elRTE and elFinder translation messages -->
		<!--<script src="js/i18n/elrte.ru.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/i18n/elfinder.ru.js" type="text/javascript" charset="utf-8"></script>-->

		<!--JavaScript specific to this implamentation-->
		<script src="js/elrte-elfinder.js" type="text/javascript" charset="utf-8"></script>

Open js/elrte-elfinder.js and change connectors/php/connector.php to connectors/python/connector.py if using Python.

Also change ‘#editor’ to the id of the text area you want rich edit on.

Adjust any other settings to suit your needs.

Also configure connectors/php/connector.php (or connectors/python/connector.py) if needed. 



**More Documentation

The complete documentation for both the rich text editor and the file manager/explorer/uploader are available on their respective websites
http://elrte.org/
http://elrte.org/elfinder/
