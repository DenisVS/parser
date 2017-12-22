<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo $uaFile.' uaFile';
$maths = new Curl;
$maths->param['usragent']= randUa($uaFile);
$maths->param['link'] = 'http://wiki.example.com';
$maths->param['cookie'] = "cookie.txt";
echo $maths->exec();
//echo $maths->html;
//echo 'Its works!';
//echo $maths->param['link'];   //*/

/*
arse (url)
dom (param)
foreach (param) {
  parse (url)
  dom (param)
  foreach (param) {

  }
}

//*/