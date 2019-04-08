<?php
    include(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'sws' . DIRECTORY_SEPARATOR . 'sws.php');
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