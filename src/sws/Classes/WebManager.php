<?php

    namespace sws\Classes;
    use asas\Exceptions\InvalidCookieException;
    use Exception;
    use sws\Abstracts\DefaultValues;
    use sws\Objects\Cookie;
    use sws\sws;

    /**
     * Class WebManager
     * @package sws\Classes
     */
    class WebManager
    {

        /**
         * @var CookieManager
         */
        private $CookieManager;

        /**
         * WebManager constructor.
         * @param sws $sws
         */
        public function __construct(sws $sws)
        {
            $this->CookieManager = $sws->CookieManager();
        }

        /**
         * Sets a cookie
         *
         * @param Cookie $Cookie
         * @param bool $secure
         * @param bool $httponly
         * @return bool
         */
        public function setCookie(Cookie $Cookie, bool $secure = False, bool $httponly = False): bool
        {
            if(CookieManager::hasExpired($Cookie) == True)
            {
                return(False); // The cookie has expired, therefore it cannot be set
            }

            // Set the cookie, return the results
            return(setCookie($Cookie->Name, $Cookie->Token, $Cookie->Expires, '/', $secure, $httponly));
        }


        /**
         * Returns the cookie data
         *
         * @param string $Name
         * @return Cookie
         */
        public function getCookie(string $Name): Cookie
        {
            if($this->isCookieValid($Name) == False)
            {
                throw new InvalidCookieException();
            }

            return($this->CookieManager->getCookie($Name, $_COOKIE[$Name]));
        }

        /**
         * Disposes of a cookie
         *
         * @param string $Name
         * @return bool
         */
        public function disposeCookie(string $Name): bool
        {
            if($this->isCookieValid($Name) == False)
            {
                return(False);
            }

            $CookieObject = $this->CookieManager->getCookie($Name, $_COOKIE[$Name]);
            $CookieObject->Disposed = True;
            $this->CookieManager->updateCookie($CookieObject);

            unset($_COOKIE[$Name]);
            setcookie($Name, null, -1, '/');

            return(True);
        }

        /**
         * @param string $Name
         * @param string $ClientIP
         * @return bool
         */
        public function isCookieValid(string $Name, string $ClientIP = DefaultValues::AutoDetect): bool
        {
            if(isset($_COOKIE[$Name]))
            {
                try
                {
                    $CookieObject = $this->CookieManager->getCookie($Name, $_COOKIE[$Name]);
                }
                catch(Exception $exception)
                {
                    return(False);
                }

                if(CookieManager::hasExpired($CookieObject))
                {
                    return(False);
                }

                if($CookieObject->Disposed == True)
                {
                    return(False);
                }

                if($CookieObject->IPTied == True)
                {
                    if($ClientIP == DefaultValues::AutoDetect)
                    {
                        if($CookieObject->IP !== Utilities::detectClientIp())
                        {
                            return(False);
                        }
                    }
                    else
                    {
                        // Validate the given IP
                        if(filter_var($ClientIP, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
                        {
                            if($CookieObject->IP !== $ClientIP)
                            {
                                return(False);
                            }
                        }
                        elseif(filter_var($ClientIP, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
                        {
                            if($CookieObject->IP !== $ClientIP)
                            {
                                return(False);
                            }
                        }
                        else
                        {
                            return(False);
                        }
                    }
                }


                return(True);
            }
            else
            {
                return(False);
            }
        }
    }