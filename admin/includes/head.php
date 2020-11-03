<?php
	require_once '../config/dbconfig.php';
	include '../classes/auth.php';
 ?>
<!DOCTYPE html>
<html lang="en">

<!-- index-0.html  Tue, 07 Jan 2020 03:35:33 GMT -->
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>EGCOM <?php if(isset($_SESSION['user_email'])) { echo "| "; if($dbConfig->checkUserIsAdmin()){ echo "Admin"; } else { echo "Staff"; } }?></title>

<!-- General CSS Files -->
<link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="fontawesome/css/all.min.css">

<!-- CSS Libraries -->
<link rel="stylesheet" href="assets/modules/jqvmap/dist/jqvmap.min.css">
<link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons.min.css">
<link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons-wind.min.css">
<link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">

<!-- DataTables -->
<link rel="stylesheet" href="assets/modules/datatables/datatables.min.css">
<link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

<!-- DataTimePicker -->
<link rel="stylesheet" href="assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="assets/modules/bootstrap-daterangepicker/daterangepicker.css">

<!-- AuthRegister -->
<link rel="stylesheet" href="assets/modules/jquery-selectric/selectric.css">

<!-- Template CSS -->
<link rel="stylesheet" href="assets/css/style.min.css">
<link rel="stylesheet" href="assets/css/components.min.css">
</head>

<body class="layout-4">
<!-- Page Loader -->
<!-- <div class="page-loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
 -->