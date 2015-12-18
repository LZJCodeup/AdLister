<?php

require 'Log.php';

class Auth
{
    public static $password = '$2y$10$SLjwBwdOVvnMgWxvTI4Gb.YVcmDlPTpQystHMO2Kfyi/DS8rgA0Fm';
    public static $username = 'guest';

    /**
     * Takes a username and password, if the username is 'guest' and the
     * password matches the hashed password, sets the LOGGED_IN_USER session
     * variable and logs an info message that the user logged in 
     * if the username and password do not match, logs an error
     * 
     * @param  string $username username
     * @param  string $password password
     */
    public static function attempt($username, $password)
    {
        $log = new Log();

        $passwordIsValid = password_verify($password, self::$password);
        $usernameIsValid = ($username == self::$username);

        if ($usernameIsValid && $passwordIsValid) {
            $_SESSION['LOGGED_IN_USER'] = $username;
            $log->info($username . ' logged in.');
        } elseif ($username != '') {
            $log->error($username . ' failed to login!');
        }
    }

    /**
     * returns a boolean whether or not the user is logged in
     * 
     * @return bool true if logged in, false otherwise
     */    
    public static function isLoggedIn()
    {
        return isset($_SESSION['LOGGED_IN_USER']);
    }

    /**
     * returns the username of the logged in user
     * 
     * @return string username
     */
    public static function getUsername()
    {
        return $_SESSION['LOGGED_IN_USER'];
    }

    /**
     * copypasta from php manual
     * ends the current session
     */
    public static function logout()
    {
        $log = new Log();
        $log->info(self::getUsername() . ' logged out');

        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();
    }

    /**
     * redirects to a given url and kills the script
     *    
     * @param  string $url the url to redirect to
     */
    public static function redirect($url)
    {
        header('Location: ' . $url);
        die();
    }
}
