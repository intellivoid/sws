<?php

    namespace sws\Classes;

    use asas\Exceptions\DatabaseException;
    use asas\Exceptions\InvalidCookieException;
    use asas\Exceptions\InvalidIPException;
    use asas\Exceptions\IPAutoDetectException;
    use msqg\QueryBuilder;
    use mysqli;
    use sws\Abstracts\DefaultValues;
    use sws\Objects\Cookie;
    use sws\sws;
    use ZiProto\ZiProto;

    /**
     * Class CookieManager
     * @package sws\Classes
     */
    class CookieManager
    {

        /**
         * @var mysqli
         */
        private $Database;

        /**
         * CookieManager constructor.
         * @param sws $sws
         */
        public function __construct(sws $sws)
        {
            $this->Database = $sws->Database();
        }

        /**
         * @param string $Name The name of the cookie
         * @param int $Expires When the cookie should expire (Unix Timestamp)
         * @param bool $IPTied If the cookie should be IP Locked
         * @param string $ClientIP If IPTied is set to true, you must specify the client's IP Address
         * @return Cookie
         */
        public function newCookie(string $Name, int $Expires, bool $IPTied = True, string $ClientIP = DefaultValues::AutoDetect): Cookie
        {
            $CookieObject = new Cookie();

            // Assign the properties to the object
            $CookieObject->Name = $Name;
            $CookieObject->Expires = time() + $Expires;
            $CookieObject->IPTied = $IPTied;
            $CookieObject->Token = Crypto::generateToken($Name, time());

            // If the IP is tied to the cookie, validate the information regarding the IP Address
            if($IPTied == False)
            {
                $CookieObject->IP = DefaultValues::NoValue;
            }
            else
            {
                if($ClientIP == DefaultValues::AutoDetect)
                {
                    $CookieObject->IP = Utilities::detectClientIp();
                }
                else
                {
                    // Validate the given IP
                    if(filter_var($ClientIP, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
                    {
                        $CookieObject->IP = $ClientIP;
                    }
                    elseif(filter_var($ClientIP, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
                    {
                        $CookieObject->IP = $ClientIP;
                    }
                    else
                    {
                        throw new InvalidIPException();
                    }
                }
            }

            // Strip any dangerous characters to make the query safe to execute
            $DateCreation = time();
            $Cookie_Disposed = (int)$CookieObject->Disposed;
            $Cookie_Name = $this->Database->real_escape_string($CookieObject->Name);
            $Cookie_Expires = (int)$CookieObject->Expires;
            $Cookie_IPTied = (int)$CookieObject->IPTied;
            $Cookie_IP = $this->Database->real_escape_string($CookieObject->IP);
            $Cookie_Token = $this->Database->real_escape_string($CookieObject->Token);
            $Cookie_Data = $this->Database->real_escape_string(ZiProto::encode($CookieObject->Data));

            // Build the query to save the cookie to the database
            $Query = QueryBuilder::insert_into(
                'cookies',
                array(
                    'date_creation' => $DateCreation,
                    'disposed' => $Cookie_Disposed,
                    'name' => $Cookie_Name,
                    'token' => $Cookie_Token,
                    'expires' => $Cookie_Expires,
                    'ip_tied' => $Cookie_IPTied,
                    'client_ip' => $Cookie_IP,
                    'data' => $Cookie_Data
                )
            );

            $QueryResults = $this->Database->query($Query);
            if($QueryResults)
            {
                return($CookieObject);
            }
            else
            {
                throw new DatabaseException($this->Database->error);
            }
        }

        /**
         * Retrieves a cookie from the database
         *
         * @param string $Name
         * @param string $Token
         * @return Cookie
         */
        public function getCookie(string $Name, string $Token): Cookie
        {
            $Name = $this->Database->real_escape_string($Name);
            $Token = $this->Database->real_escape_string($Token);

            $Query = "SELECT disposed, name, token, expires, ip_tied, client_ip, data FROM `cookies` WHERE name='$Name' AND token='$Token'";

            $QueryResults = $this->Database->query($Query);

            if($QueryResults)
            {
                $Row = $QueryResults->fetch_array(MYSQLI_ASSOC);

                if ($Row == False)
                {
                    throw new InvalidCookieException();
                }
                else
                {
                    return(ObjectLoader::loadCookie($Row));
                }
            }
            else
            {
                throw new DatabaseException($this->Database->error);
            }
        }


        /**
         * Updates an existing cookie in the database
         *
         * @param Cookie $Cookie
         * @return bool
         */
        public function updateCookie(Cookie $Cookie): bool
        {
            if($this->cookieExists($Cookie->Name, $Cookie->Token) == False)
            {
                throw new InvalidCookieException();
            }

            $Cookie_Name = $this->Database->real_escape_string($Cookie->Name);
            $Cookie_Token = $this->Database->real_escape_string($Cookie->Token);
            $Cookie_Disposed = (int)$Cookie->Disposed;
            $Cookie_Expires = (int)$Cookie->Expires;
            $Cookie_IPTied = (int)$Cookie->IPTied;
            $Cookie_IP = $this->Database->real_escape_string($Cookie->IP);
            $Cookie_Data = $this->Database->real_escape_string(ZiProto::encode($Cookie->Data));

            $Query = "UPDATE `cookies` SET disposed=$Cookie_Disposed, expires=$Cookie_Expires, ip_tied=$Cookie_IPTied, client_ip='$Cookie_IP', data='$Cookie_Data' WHERE name='$Cookie_Name' AND token='$Cookie_Token'";
            $QueryResults = $this->Database->query($Query);

            if($QueryResults)
            {
                return(True);
            }
            else
            {
                throw new DatabaseException($this->Database->error);
            }
        }

        /**
         * Determines if the cookie exists
         *
         * @param string $Name
         * @param string $Token
         * @return bool Returns true if the cookie exists, returns false if it doesn't exist
         */
        public function cookieExists(string $Name, string $Token): bool
        {
            try
            {
                $this->getCookie($Name, $Token);
                return(True);
            }
            catch(InvalidCookieException $invalidCookieException)
            {
                return(False);
            }
        }

        /**
         * Determines if the cookie has expired or not
         *
         * @param Cookie $Cookie
         * @return bool Returns true if the cookie has expired,
         */
        public static function hasExpired(Cookie $Cookie): bool
        {
            $CurrentTime = time();

            if($CurrentTime > $Cookie->Expires)
            {
                return(True);
            }
            elseif($CurrentTime == $Cookie->Expires)
            {
                return(true);
            }
            else
            {
                return(False);
            }
        }
    }