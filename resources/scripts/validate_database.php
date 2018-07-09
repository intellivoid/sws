<?php

while(True)
{
    $Input = strtolower(getInput('Would you like to verify the connection to the MySQL Database?' . Color::set(' [Y/n] ', 'bold')));
    if($Input == 'y')
    {
        $ConfigurationFile = parse_ini_file(XTEMP_CONFIG_LOCATION);
        $SQLConnection = new mysqli(
            $ConfigurationFile['Host'],
            $ConfigurationFile['Username'],
            $ConfigurationFile['Password']
        );

        if ($SQLConnection->connect_errno)
        {
            printx(Color::set('Database Error: ', 'red+bold') . 'Could not connect to the database, ' . $SQLConnection->connect_error);
            terminateInstaller(True);
            break;
        }
        else
        {
            printx(Color::set('Success: ', 'green+bold') . 'Database connection was successful');
            break;
        }
    }
    elseif($Input == 'n')
    {
        printx('Skipping database connection verification');
        break;
    }
    else
    {
        printx(Color::set('Warning: ', 'yellow+bold'). 'Unknown choice.');
    }
}