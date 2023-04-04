<?php
function base_path($file){
    return BASE_PATH . $file;
}
function login($user){
    $_SESSION['user'] = $user;
}
?>