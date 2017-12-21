<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$maths = new dlPrepare;
$maths->param['usragent']= 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.8.1.1) Gecko/20161204 Firefox/42.1';
$maths->param['link'] = 'http://wiki.example.com';
$maths->param['cookie'] = "cookie.txt";
echo $maths->html;
echo 'Its works!';
//echo $maths->param['link'];