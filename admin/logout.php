<?php
include '../lib/Session.php';
Session::checkSession();

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  Session::destroy();
  header('Location:login.php');
}
