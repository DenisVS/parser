<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo $uaFile.' uaFile';
$curlMainpage = new Curl;
$curlMainpage->param['header'] = TRUE;
$curlMainpage->param['usragent']= randUa($uaFile);
//$curlMainpage->param['link'] = 'http://wiki.example.com';
$curlMainpage->param['link'] = 'http://orelmebel.ru/';
$curlMainpage->param['cookie'] = "cookie.txt";
$curlMainpage->param['encoding'] = 'windows-1251';
libxml_use_internal_errors(true);
$docMainpage = new DOMDocument();
$docMainpage->loadHTML($curlMainpage->exec());
echo $docMainpage->saveHTML();


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