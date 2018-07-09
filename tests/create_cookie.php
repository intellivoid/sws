<?php
    include('/usr/local/bin/sws/sws.php');
    $sws = new sws\sws();

    try
    {
        $Cookie = $sws->CookieManager()->newCookie('Test', 500, False);
        print(var_dump($Cookie) . "\n");
    }
    catch(\asas\Exceptions\DatabaseException $DatabaseException)
    {
        print($DatabaseException->getError());
    }

    print("Test completed\n");