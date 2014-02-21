MantisLib
=========

MantisLib is a PHP Class for Mantis Bugtracker API. It is supported by the PHP Framework CodeIgniter or as standalone Library.

Constructor requires array:

            $mantis = new mantis_lib(
                                    array(
                                          'url'       => 'http://mantis.soap/?wsdl',
                                          'username'  => 'username',
                                          'password'  => 'password'
                                    ));


You can find a list of functions and return types here:

[List of functions]

MantisLib uses a SOAP-Client to connect with the Mantis API.

Mantis Bugtracker: 

[Mantis GitHub]

      OR
      
[Mantis Website]

[Mantis GitHub]:https://github.com/mantisbt/mantisbt
[Mantis Website]:http://www.mantisbt.org/
[List of functions]:http://abload.de/img/diagrams9ss9.png
