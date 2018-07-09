<?php
    include('/usr/local/bin/sws/sws.php');
    $sws = new sws\sws();

    // If it's a POST Request
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(isset($_GET['action'])) // If the user is already logged in, and wants to update information
        {
            try
            {
                $AccountSessionCookie = $sws->WebManager()->getCookie('account_session');
            }
            catch(Exception $exception)
            {
                $sws->WebManager()->disposeCookie('account_session');
                header('Location: web.php');
                die();
            }
            $AccountSessionCookie->Data['fname'] = $_POST['fname'];
            $sws->CookieManager()->updateCookie($AccountSessionCookie);
            header('Location: web.php');
            die();
        }
        else // If the user is trying to login
        {
            $Cookie = $sws->CookieManager()->newCookie('account_session', 120, True);
            $Cookie->Data = array(
                'username' => $_POST['username'],
                'fname' => $_POST['fname']
            );
            $sws->CookieManager()->updateCookie($Cookie);
            $sws->WebManager()->setCookie($Cookie);
            header('Location: web.php');
            die();
        }
    }

    if(isset($_GET['action'])) // If the user wants to logout
    {
        $sws->WebManager()->disposeCookie('account_session');
        header('Location: web.php');
        die();
    }

    if($sws->WebManager()->isCookieValid('account_session')) // If the user is logged in
    {
        try
        {
            $AccountSessionCookie = $sws->WebManager()->getCookie('account_session');
        }
        catch(Exception $exception)
        {
            $sws->WebManager()->disposeCookie('account_session');
            header('Location: web.php');
            die();
        }

        $Username = $AccountSessionCookie->Data['username'];
        $FirstName = $AccountSessionCookie->Data['fname'];
        ?>
            <h1>Welcome, <?PHP print($Username); ?></h1>
            <p>We know that your first name is <?PHP print($FirstName); ?></p>
            <form method="POST" action="web.php?action=update">
                First Name: <input type="text" name="fname" id="fname" value="<?PHP print($FirstName); ?>"><br>
                <input type="submit" value="Update">
            </form>
            <a href="web.php?action=logout">Logout</a><br><br>
            <pre><?PHP var_dump($AccountSessionCookie); ?></pre>
        <?php
        die();
    }
    else // If the user isn't logged in, ask for the information
    {
        ?>
            <h1>Welcome, Please login</h1>
            <form method="POST" action="web.php">
                Username: <input type="text" name="username" id="username"><br>
                First Name: <input type="text" name="fname" id="fname"><br>
                <input type="submit" value="Login">
            </form>
        <?php
        die();
    }