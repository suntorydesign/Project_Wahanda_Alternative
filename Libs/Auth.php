<?php
/**
 * 
 */
class Auth
{
    
    public static function handleSpaCMSLogin()
    {
        @session_start();
        $isSpaCMS = $_SESSION['spaCMS'];
        if ($isSpaCMS == false) {
            session_destroy();
            header('location:' . URL . 'spaCMS');
            exit;
        }
    }
    
    public static function handleClientLogin()
    {
        @session_start();
        $isClientLogin = $_SESSION['client_id'];
        if ($isClientLogin == false) {
            session_destroy();
            header('location:' . URL);
            exit;
        }
    }
	
	public static function handleAdminLogin()
    {
        @session_start();
        $isAdminLogin = $_SESSION['admincp'];
        if ($isAdminLogin == false) {
            session_destroy();
            header('location:' . URL . 'admincp');
            exit;
        }
    }
    
}