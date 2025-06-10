<?php
session_start();

include('../../db_connection.php');


if (!isset($_SESSION['user_id'])) {
    session_unset(); 
    session_destroy(); 
} else {
    $user_id = $_SESSION['user_id'];
    $user_name = isset($_SESSION['username']) ? $_SESSION['username'] : '';
}




?>