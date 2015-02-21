Inner Sphere Atlas
===============
The [Inner Sphere Atlas](http://isatlas.teamspam.net/) has been a resource for the BattleTech community for over 15 years. It was originally developed in the PHP 3/4 era (late 90s). This repository documents the conversion of the legacy PHP code into a PHP application that PDO, template engines and HTML5/Bootstrap.


Goal:
-------
Update the code to make the Inner Sphere Atlas a more modern website.

To Do:
---------
 - Use [Bootstrap](http://getbootstrap.com/).
  - Make the web site more mobile friendly.
 - Work on Search Engine Optimization.
  - Make the titles more descriptive and less repetitive.

Completed:
----------
 - Use [PDO](http://php.net/manual/en/book.pdo.php)
  - This should help to minimize SQL Injection attacks.
  - Use of the Original MySQL API has been replaced with the PDO driver.
 - Use [Twig](http://twig.sensiolabs.org/) template engine.
  - This should help to reduce the business/database code from the presentation code.
  - Twig will help to ensure that the templates will only contain presentation logic.
 - Use [Bootstrap](http://getbootstrap.com/).
  - Make use of modern web design patterns.

> Written with [StackEdit](https://stackedit.io/).
