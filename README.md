# Secured Web Sessions
Secured Web Sessions (SWS) is a PHP Library that utilizes the built in
PHP Cookie Manager but stores all the corresponding data to a SQL
Database, while providing some security enchantments

### Installation
```bash
sudo php -f install
```

-----

### Include
```php
<?php
    include('/usr/local/bin/sws/sws.php');
    $sws = new sws\sws();
```

### Create Cookie
```php
<?php
    $Cookie = $sws->CookieManager()->newCookie('account_session', 120, True);
    $Cookie->Data = array(
         'username' => $_POST['username'],
         'password' => $_POST['password']
    );
    $sws->CookieManager()->updateCookie($Cookie);
    $sws->WebManager()->setCookie($Cookie);
```

### Get Cookie
```php
<?php
     try
        {
            $Cookie = $sws->WebManager()->getCookie('account_session');
        }
        catch(Exception $exception)
        {
            $sws->WebManager()->disposeCookie('account_session');
            die('Please login again');
        }
```

### Update Cookie
```php
<?php
     try
        {
            $Cookie = $sws->WebManager()->getCookie('account_session');
        }
        catch(Exception $exception)
        {
            $sws->WebManager()->disposeCookie('account_session');
            die('Please login again');
        }
        $Cookie->Data['username'] = $_POST['username'];
        $sws->CookieManager()->updateCookie($Cookie);
```

### Dispose Cookie
```php
<?php
     $sws->WebManager()->disposeCookie('account_session');
```