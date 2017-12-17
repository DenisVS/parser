<?php


//загрузка файлов
function curlDownload($link, $usragent = 0, $file, $proxy = false, $timeout = 40) {
    $ch = curl_init($link);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_FILE, $file);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $usragent);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    $page = curl_exec($ch);
    $status = (curl_getinfo($ch)); //запрашиваем статус cURL
    curl_close($ch);
    if (empty($page)) {
        return 'PROXY_ERROR';
    } else {
        if ($status [download_content_length] != $status[size_download] && $status [download_content_length] != '-1') {
            return 'PROXY_ERROR'; //если размеры отличаются (и при этом сервер отдаёт размер), возвращаем ошибку
        }
    }
}

///////////////////////////////////////////////////////////////////
function truncateText($text, $startEntry, $endEntry, $includeStart = FALSE, $includeEnd = FALSE) {
    $lenghtStartEntry = mb_strlen($startEntry);
    $lenghtEndEntry = mb_strlen($endEntry);

//    if ($includeStart == TRUE) {
//        $positionStart = mb_strpos($text, $startEntry);
//    } else {
//        $positionStart = mb_strpos($text, $startEntry) + $lenghtStartEntry;
//    }


    if ($startEntry == NULL) {
        $positionStart = 0;  //
    } else {
        $positionStart = mb_strpos($text, $startEntry) + $lenghtStartEntry;
    }

    if ($endEntry == NULL) {
        $result = trim(mb_substr($text, $positionStart));  //
    } else {
        $positionEnd = mb_strpos($text, $endEntry, $positionStart);
        //если же вхождение не найдено
        if ($positionEnd == NULL) {
            $result = trim(mb_substr($text, $positionStart));
        } else {
            $result = trim(mb_substr($text, $positionStart, $positionEnd - $positionStart));  //
        }
    }


    return $result;
}

function positionOfTruncate($text, $startEntry, $endEntry, $includeStart = FALSE, $includeEnd = FALSE) {
    $lenghtStartEntry = mb_strlen($startEntry);
    $lenghtEndEntry = mb_strlen($endEntry);

//    if ($includeStart == TRUE) {
//        $positionStart = mb_strpos($text, $startEntry);
//    } else {
//        $positionStart = mb_strpos($text, $startEntry) + $lenghtStartEntry;
//    }


    if ($startEntry == NULL) {
        $positionStart = 0;  //
    } else {
        $positionStart = mb_strpos($text, $startEntry) + $lenghtStartEntry;
    }

    if ($endEntry == NULL) {
        $result = trim(mb_substr($text, $positionStart));  //
        $positionEnd = NULL;
    } else {
        $positionEnd = mb_strpos($text, $endEntry, $positionStart);
        $result = trim(mb_substr($text, $positionStart, $positionEnd - $positionStart));  //
    }
    $startAnswer = $positionStart - $lenghtStartEntry;
    if ($startAnswer == 0) {
        $startAnswer = NULL;
    }
    $positions = array(
        "start" => $startAnswer,
        "end" => $positionEnd,
    );
    //return $result;
    return $positions;
}

function mb_str_replace($search, $replace, $subject, &$count = 0) {
    if (!is_array($subject)) {
// Normalize $search and $replace so they are both arrays of the same length
        $searches = is_array($search) ? array_values($search) : array($search);
        $replacements = is_array($replace) ? array_values($replace) : array($replace);
        $replacements = array_pad($replacements, count($searches), '');

        foreach ($searches as $key => $search) {
            $parts = mb_split(preg_quote($search), $subject);
            $count += count($parts) - 1;
            $subject = implode($replacements[$key], $parts);
        }
    } else {
// Call mb_str_replace for each subject in array, recursively
        foreach ($subject as $key => $value) {
            $subject[$key] = mb_str_replace($search, $replace, $value, $count);
        }
    }
    return $subject;
}


//Случайная строка из файла
function randUa($file) {
    $uaFile = fopen($file, "r");  //открываем файл на чтение
    if (!$uaFile) {  //если файл не открывается
        echo "\nОшибка открытия файла!\n";
        exit(); //выходим
    }
    $numLineInFile = 0; //номер строки
    while (!feof($uaFile)) { //пока не дошли до конца файла 
        $buffDurty = fgets($uaFile, 1000);  //в буфер содержимое строки по 1000 символ, либо до конца строки
        $uaAll[$numLineInFile] = trim($buffDurty); //заносим в массив, обрубив пробелы
        $numLineInFile = $numLineInFile + 1; //следующий элемент массива
    }
    fclose($uaFile); //закрываем
    shuffle($uaAll); //перемешиваем
    return $uaAll[1];
}

function translit($s) {
    $s = (string) $s; // преобразуем в строковое значение
    $s = strip_tags($s); // убираем HTML-теги
    $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
    $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
    $s = trim($s); // убираем пробелы в начале и конце строки
    $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
    $s = strtr($s, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => ''));
    $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
    $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
    return $s; // возвращаем результат
}

////////////////////////////////////////////////////////
function tbitLogin($url, $urlTo, $post, $cookie, $useragent) {

    $ch = curl_init();                              // Инициализация сеанса
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_URL, $url);            // Заходим на сайт
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // вернуть страницу в переменную
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);   // таймаут4
    $html = curl_exec($ch);                         // Забираем страницу

    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_URL, $urlTo);          // Куда шлем POST данные
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);   // Записываем cookie
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);  // Читаем cookies
    curl_setopt($ch, CURLOPT_POST, true);           // Указываем метод отправки
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);    // POST данные
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // следовать за редиректами
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);   // таймаут4
    $html = curl_exec($ch);                         // Забираем страницу
    curl_close($ch);                                // Завершаем сеанс
    
    is_present($html, '<a href="/reg">Регистрация</a>', false,1);
    if ($html == !false) $html = true;
    return $html;
}

//////////////////////////////////////////////////////
function is_present($lpage, $mystr, $strerror, $head = 0) {
	if (stristr($lpage, $mystr)) {
		if($head)
			die($strerror);
		else
			echo $strerror;
	}
}

//////////////////////////////////////////////////////
function tbitUpload($filelocation, $tbitcookie, $useragent) {
	$url = "http://turbobit.net/upload/old";
	$page = curl($url, '', $tbitcookie, '', $useragent);

	$page = truncateText($page, '<param name="FlashVars" value="', '" />', $includeStart = FALSE, $includeEnd = FALSE);
	$upload_url = truncateText($page, 'urlSite=', '&', $includeStart = FALSE, $includeEnd = FALSE);
	$user_id = truncateText($page, 'userId=', '&', $includeStart = FALSE, $includeEnd = FALSE);
	$apptype = truncateText($page, 'apptype=', '', $includeStart = FALSE, $includeEnd = FALSE);
	$apptype = truncateText($page, 'apptype=', '', $includeStart = FALSE, $includeEnd = FALSE);

	$agent = 'Shockwave Flash';
	$data['Filename'] = basename($filelocation);
	$data['stype'] = 'null';
	$data['apptype'] = $apptype;
	$data['user_id'] = $user_id;
	$data['id'] = 'null';
	$data['Filedata'] = "@" . $filelocation;

	$upfiles = curl($upload_url, $data, $tbitcookie, $url, 1, 1, $agent, 0, 360);
	preg_match('/"result":true,"id":"(.*?)","message":"Everything is ok"/', $upfiles, $link);
	if (!empty($link[1])) {
		$download_link = 'http://turbobit.net/' . $link[1] . '.html';
	} else {
		//die("Error - Unable to retrive the download link, please try again later.");
		$download_link = '';
	}

	return $download_link;
}

////////////////////////////////////////////////////////////
//получаем список файлов .dat в текущей директории
//$file_list = glob("./*.dat");
//получаем список файлов .dat в текущей и вложенных директориях
//$file_list = bfglob("./", "*.dat");
// $path - путь к директории
// $pattern - шаблон поиска
// $flags - константа для функции glob()
// $depth - глубина вложенности, просматриваемая функцией. -1 - без ограничений.
function bfglobbak($path, $pattern = '*', $flags = GLOB_NOSORT, $depth = -1)  {
	echo $path."\n";
  $matches = array();
  $folders = array(rtrim($path, DIRECTORY_SEPARATOR));

  while($folder = array_shift($folders))    {
    $matches = array_merge($matches, glob($folder.DIRECTORY_SEPARATOR.$pattern, $flags));
    if($depth != 0)      {
		$moreFolders = glob($folder.DIRECTORY_SEPARATOR.'*', GLOB_ONLYDIR);
		$depth   = ($depth < -1) ? -1: $depth + count($moreFolders) - 3;
		echo "depth ".$depth."\n";
		$folders = array_merge($folders, $moreFolders);
    }
  }
  return $matches;
}

function bfglob($path, $pattern = '*', $flags = 0, $depth = -1) {
        $matches = array();
        $folders = array(rtrim($path, DIRECTORY_SEPARATOR));
        while($folder = array_shift($folders)) {
            $matches = array_merge($matches, glob($folder.DIRECTORY_SEPARATOR.$pattern, $flags));
            if($depth != 0) {
                $moreFolders = glob($folder.DIRECTORY_SEPARATOR.'*', GLOB_ONLYDIR);
                $depth   = ($depth < -1) ? -1: $depth + count($moreFolders) - 2;
                $folders = array_merge($folders, $moreFolders);
            }
        }
        return $matches;
}
////////////////////////////////////////////////////  
function tb_linkchecker ($links_to_check)	{
	$url = "http://turbobit.net/linkchecker/csv"; // Адрес, на который отправляется запрос
	$ch = curl_init();	// Инициализируем cURL
	curl_setopt($ch, CURLOPT_URL,$url); // Устанавливаем адрес
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // Требуем возвращать запрошенную информацию
	curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Тайм-аут
	curl_setopt($ch, CURLOPT_POST, 1); // Метод POST
	curl_setopt($ch, CURLOPT_POSTFIELDS, "links_to_check=".urlencode($links_to_check)); // Добавляем поле с адресом файла
	$result = curl_exec($ch); // Выполняем запрос
	curl_close($ch);
	return $result;
}

////////////////////////////////////////////////////  
