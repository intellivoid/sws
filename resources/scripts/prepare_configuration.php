<?php
if(INST_INSTALL_METHOD == 'upgrade') // if the installer is upgrading, backup the configuration data.
{
    if(file_exists(INST_INSTALLATION_PATH . DIRECTORY_SEPARATOR .'configuration.ini'))
    {
        printx('Verifying the configuration file with your current install...');
        validateConfiguration(INST_INSTALLATION_PATH . DIRECTORY_SEPARATOR .'configuration.ini', True);
        printx('Backing up configuration file...');
        define('XTEMP_CONFIG_DATA', readContents(INST_INSTALLATION_PATH . DIRECTORY_SEPARATOR .'configuration.ini'), False);
    }
    else
    {
        printx(Color::set('Fatal Error: ', 'red+bold') . 'Your current installation is missing \'configuration.ini\'');
        terminateInstaller(True);
    }
}