<?php

class Auth
{
    
    public static function attempt($user, $password)
    {
        // $log = new Log();
        var_dump(is_object($user));
        if(is_object($user) && password_verify($password, $user->password))
            { 
                return True;
            } else {
                return False; 
            }
    }

    // Sets session variables
    
    public static function setSessionVariables($user)
    {
        $_SESSION['user_id']= $user->id;
        $_SESSION['email']= $user->email;
        $_SESSION['firstName']= $user->firstName;
        $_SESSION['lastName']= $user->lastName;
    }
    /**
     * returns a boolean whether or not the user is logged in
     * 
     * @return bool true if logged in, false otherwise
     */    
    public static function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * returns the username of the logged in user
     * 
     * @return string username
     */
    public static function getUsername()
    {
        return $_SESSION['email'];
    }

    /**
     * copypasta from php manual
     * ends the current session
     */
    public static function logout()
    {
       // $log = new Log();
        //$log->info(self::getUsername() . ' logged out');

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
