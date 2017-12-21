<?php

class Curl {

    public $param;

    function __construct() {
        $this->param['header'] = 1;
        $this->param['follow'] = 1;
        $this->param['usragent'] = 0;
        $this->param['proxy'] = false;
        $this->param['timeout'] = 10;
        $this->param['verbose'] = 0;
        $this->param['headers'] = FALSE;
    }

    function exec() {

        $this->ch = curl_init($this->param['link']);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        if ($this->param['header'])
            curl_setopt($this->ch, CURLOPT_HEADER, 1);
        else
            curl_setopt($this->ch, CURLOPT_HEADER, 0);
        if ($this->param['follow'])
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        else
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 0);
        if ($this->param['usragent'])
            curl_setopt($this->ch, CURLOPT_USERAGENT, $this->param['usragent']);
        //else
        //    curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1');
        if ($this->param['refer'])
            curl_setopt($this->ch, CURLOPT_REFERER, $this->param['refer']);
        if ($this->param['postfields']) {
            curl_setopt($this->ch, CURLOPT_POST, 1);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->param['postfields']);
        }
        if ($this->param['cookie']) {
            curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->param['cookie']);
            curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->param['cookie']);
        }
        if ($this->param['proxy']) {
            curl_setopt($this->ch, CURLOPT_PROXY, $this->param['proxy']);
        }
        if ($this->param['timeout']) {
            curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->param['timeout']);
        }
        if ($this->param['verbose']) {
            curl_setopt($this->ch, CURLOPT_VERBOSE, $this->param['verbose']);
        }
        if ($this->param['headers']) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->param['headers']);
        } //добавляем заголовков к нашему запросу. Чтоб смахивало на настоящих

        $this->param['page'] = curl_exec($this->ch);
        curl_close($this->ch);

        if (empty($this->param['page'])) {
            return "Could not connect to host: " . $this->param['link'];
        } else {
            return $this->param['page'];
        }
    }

    function status() {

        $this->ch = curl_init($this->param['link']);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        if ($this->param['header'])
            curl_setopt($this->ch, CURLOPT_HEADER, 1);
        else
            curl_setopt($this->ch, CURLOPT_HEADER, 0);
        if ($this->param['follow'])
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        else
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 0);
        if ($this->param['usragent'])
            curl_setopt($this->ch, CURLOPT_USERAGENT, $this->param['usragent']);
        //else
        //    curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1');
        if ($this->param['refer'])
            curl_setopt($this->ch, CURLOPT_REFERER, $this->param['refer']);
        if ($this->param['postfields']) {
            curl_setopt($this->ch, CURLOPT_POST, 1);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->param['postfields']);
        }
        if ($this->param['cookie']) {
            curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->param['cookie']);
            curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->param['cookie']);
        }
        if ($this->param['proxy']) {
            curl_setopt($this->ch, CURLOPT_PROXY, $this->param['proxy']);
        }
        if ($this->param['timeout']) {
            curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->param['timeout']);
        }
        if ($this->param['verbose']) {
            curl_setopt($this->ch, CURLOPT_VERBOSE, $this->param['verbose']);
        }
        if ($this->param['headers']) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->param['headers']);
        } //добавляем заголовков к нашему запросу. Чтоб смахивало на настоящих

        $this->param['page'] = curl_exec($this->ch);
        return curl_getinfo($this->ch);
        curl_close($this->ch);
    }

}

class dlPrepare {

    public $param;
    public $html;

    function __construct() {
        // $this->param['usragent'] = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.8.1.1) Gecko/20161204 Firefox/42.1';
        //$this->param['link'] = 'http://wiki.example.com';
        //$this->param['cookie'] = "cookie.txt";
        //echo $this->param['link'];

        $maths = new Curl;
        $maths->param['usragent'] = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.8.1.1) Gecko/20161204 Firefox/42.1';
        $maths->param['link'] = $this->param['link'];
        $maths->param['cookie'] = $this->param['cookie'];
        $this->html = $maths->exec();
        echo ' Method Construct works properly';
        print_r($this->param);
        print_r($this->html);
    }

}
