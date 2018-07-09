<?php
if(INST_INSTALL_METHOD == 'upgrade') // if the installer is upgrading, backup the configuration data.
{
    printx('Restoring Configuration...');
    file_put_contents(INST_INSTALLATION_PATH . DIRECTORY_SEPARATOR .'configuration.ini', XTEMP_CONFIG_DATA);
}
else
{
    printx('Installing Configuration...');
    copy(getResourcesDir() . DIRECTORY_SEPARATOR . 'configuration.ini', INST_INSTALLATION_PATH . DIRECTORY_SEPARATOR .'configuration.ini');
}