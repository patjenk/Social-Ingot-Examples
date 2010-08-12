<?php
/**
 * Paul Capriolo <paul@socialgrowthtechnologies.com>
 * 08/12/2010
 */

// Place your Social Ingot API key and secret here. 
// Do not use the provided API key and secret for production.
$api_key = "9f2ac35d2b495336fccaaeba351aa7487f072a4a";
$secret  = "6d0db6688d3fb1a29bcdba2c8b6c85a5d4809e6d";

$success_url = "http://www.example.com/";
$cancel_url  = "http://www.example.com/";
$ip          = $_SERVER['REMOTE_ADDR'];

$vc        = isset($_GET['vc'])?$_GET['vc']:'item';
$vc_plural = isset($_GET['vc_plural'])?$_GET['vc_plural']:'items';
$uid       = isset($_GET['fb_sig_user'])?$_GET['fb_sig_user']:'none';
$xe        = isset($_GET['xe'])?$_GET['xe']:'0.10';
