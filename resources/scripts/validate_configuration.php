<?php
printx('Validating configuration file ...');
define('XTEMP_CONFIG_LOCATION', getResourcesDir() . DIRECTORY_SEPARATOR . 'configuration.ini', False);
if(!file_exists(XTEMP_CONFIG_LOCATION))
{
    printx(Color::set('Fatal Error: ', 'red+bold') . 'Could not locate the configuration file in resources.');
    terminateInstaller(True);
}
else
{
    validateConfiguration(XTEMP_CONFIG_LOCATION);
}
printx(Color::set('Success: ', 'green+bold') . 'Configuration setup is valid');