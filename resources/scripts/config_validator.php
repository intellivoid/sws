<?php
function validateConfiguration(string $fileName, $existing = False)
{
    $ConfigurationFile = parse_ini_file($fileName);

    if(!isset($ConfigurationFile['Host']))
    {
        printx(Color::set('Configuration Error: ', 'red+bold') . 'missing \'Host\'');
        if($existing == False)
        {
            printx('Check configuration.ini to resolve this issue');
        }
        else
        {
            printx('Check configuration.ini with your current installation before upgrading');
        }
        terminateInstaller(True);
    }

    if(!isset($ConfigurationFile['Username']))
    {
        printx(Color::set('Configuration Error: ', 'red+bold') . 'missing \'Username\'');
        if($existing == False)
        {
            printx('Check configuration.ini to resolve this issue');
        }
        else
        {
            printx('Check configuration.ini with your current installation before upgrading');
        }
        terminateInstaller(True);
    }

    if(!isset($ConfigurationFile['Password']))
    {
        printx(Color::set('Configuration Error: ', 'red+bold') . 'missing \'Password\'');
        if($existing == False)
        {
            printx('Check configuration.ini to resolve this issue');
        }
        else
        {
            printx('Check configuration.ini with your current installation before upgrading');
        }
        terminateInstaller(True);
    }

    if(!isset($ConfigurationFile['Database']))
    {
        printx(Color::set('Configuration Error: ', 'red+bold') . 'missing \'Database\'');
        if($existing == False)
        {
            printx('Check configuration.ini to resolve this issue');
        }
        else
        {
            printx('Check configuration.ini with your current installation before upgrading');
        }
        terminateInstaller(True);
    }

    if(!isset($ConfigurationFile['ZiProto']))
    {
        printx(Color::set('Configuration Error: ', 'red+bold') . 'missing \'ZiProto\'');
        if($existing == False)
        {
            printx('Check configuration.ini to resolve this issue');
        }
        else
        {
            printx('Check configuration.ini with your current installation before upgrading');
        }
        terminateInstaller(True);
    }

}

function readContents(string $Filename)
{
    return(file_get_contents($Filename));
}