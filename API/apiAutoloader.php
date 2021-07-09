<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
require_once('../models/AdminModel.php');
require_once('../models/Shop.php');

$userModel = new UserModel();
$adminModel = new AdminModel();
$shopModel = new Shop();