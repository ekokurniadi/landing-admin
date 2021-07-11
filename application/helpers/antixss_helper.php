<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('antixss'))
{
function scriptToHtml($str){
    echo htmlentities($str, ENT_QUOTES, 'UTF-8');
   }
}