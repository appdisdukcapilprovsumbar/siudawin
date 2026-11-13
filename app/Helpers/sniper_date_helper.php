<?php 

	/* 
  	| function get_timestamp()
  	|---------------------------------------------START----------------------------------------------------
  	*/
	if(!function_exists('get_timestamp')) {
		function get_timestamp() {
			date_default_timezone_set('Asia/Jakarta');
			$date = gmdate("Y-m-d H:i:s", time()+60*60*7);
			return $date;
		}
	}
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/


	/* 
  	| function indenesia_date()
  	|---------------------------------------------START----------------------------------------------------
  	*/
	function indonesia_date($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {
	    if (trim ($timestamp) == '') {
	        $timestamp = time ();
	    } elseif (!ctype_digit ($timestamp)) {
	        $timestamp = strtotime ($timestamp);
	    }
	    # remove S (st,nd,rd,th) there are no such things in indonesia :p
	    $date_format = preg_replace ("/S/", "", $date_format);
	    $pattern = array (
	        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
	        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
	        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
	        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
	        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
	        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
	        '/April/','/June/','/July/','/August/','/September/','/October/',
	        '/November/','/December/',
	    );
	    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
	        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
	        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
	        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
	        'Oktober','November','Desember',
	    );
	    $date = date ($date_format, $timestamp);
	    $date = preg_replace ($pattern, $replace, $date);
	    $date = "{$date} {$suffix}";
	    return $date;
	}

	function indonesia_date_($timestamp = '', $date_format = 'Y-m-j  H:i', $suffix = '') {
	    if (trim ($timestamp) == '') {
	        $timestamp = time ();
	    } elseif (!ctype_digit ($timestamp)) {
	        $timestamp = strtotime ($timestamp);
	    }
	    # remove S (st,nd,rd,th) there are no such things in indonesia :p
	    $date_format = preg_replace ("/S/", "", $date_format);
	    $pattern = array (
	        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
	        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
	        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
	        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
	        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
	        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
	        '/April/','/June/','/July/','/August/','/September/','/October/',
	        '/November/','/December/',
	    );
	    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
	        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
	        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
	        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
	        'Oktober','November','Desember',
	    );
	    $date = date ($date_format, $timestamp);
	    $date = preg_replace ($pattern, $replace, $date);
	    $date = "{$date} {$suffix}";
	    return $date;
	}
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/


	/* 
  	| function indenesia_date_only()
  	|---------------------------------------------START----------------------------------------------------
  	*/
	function indonesia_date_only($timestamp = '', $date_format = 'l, j F Y') {
	    if (trim ($timestamp) == '') {
	        $timestamp = time ();
	    } elseif (!ctype_digit ($timestamp)) {
	        $timestamp = strtotime ($timestamp);
	    }
	    # remove S (st,nd,rd,th) there are no such things in indonesia :p
	    $date_format = preg_replace ("/S/", "", $date_format);
	    $pattern = array (
	        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
	        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
	        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
	        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
	        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
	        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
	        '/April/','/June/','/July/','/August/','/September/','/October/',
	        '/November/','/December/',
	    );
	    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
	        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
	        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
	        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
	        'Oktober','November','Desember',
	    );
	    $date = date ($date_format, $timestamp);
	    $date = preg_replace ($pattern, $replace, $date);
	    $date = "{$date}";
	    return $date;
	} 
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/


	/* 
  	| function indenesia_date_v1()
  	|---------------------------------------------START----------------------------------------------------
  	*/
	function indonesia_date_v1($timestamp = '', $date_format = 'j F Y') {
	    if (trim ($timestamp) == '') {
	        $timestamp = time ();
	    } elseif (!ctype_digit ($timestamp)) {
	        $timestamp = strtotime ($timestamp);
	    }
	    # remove S (st,nd,rd,th) there are no such things in indonesia :p
	    $date_format = preg_replace ("/S/", "", $date_format);
	    $pattern = array (
	        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
	        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
	        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
	        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
	        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
	        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
	        '/April/','/June/','/July/','/August/','/September/','/October/',
	        '/November/','/December/',
	    );
	    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
	        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
	        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
	        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
	        'Oktober','November','Desember',
	    );
	    $date = date ($date_format, $timestamp);
	    $date = preg_replace ($pattern, $replace, $date);
	    $date = "{$date}";
	    return $date;
	} 
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/


	/* 
  	| function indenesia_date_v2()
  	|---------------------------------------------START----------------------------------------------------
  	*/
	function indonesia_date_v2($timestamp = '', $date_format = 'j F') {
	    if (trim ($timestamp) == '') {
	        $timestamp = time ();
	    } elseif (!ctype_digit ($timestamp)) {
	        $timestamp = strtotime ($timestamp);
	    }
	    # remove S (st,nd,rd,th) there are no such things in indonesia :p
	    $date_format = preg_replace ("/S/", "", $date_format);
	    $pattern = array (
	        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
	        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
	        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
	        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
	        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
	        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
	        '/April/','/June/','/July/','/August/','/September/','/October/',
	        '/November/','/December/',
	    );
	    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
	        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
	        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
	        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
	        'Oktober','November','Desember',
	    );
	    $date = date ($date_format, $timestamp);
	    $date = preg_replace ($pattern, $replace, $date);
	    $date = "{$date}";
	    return $date;
	} 
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/


	/* 
  	| function indenesia_date_v3()
  	|---------------------------------------------START----------------------------------------------------
  	*/
	function indonesia_date_v3($timestamp = '', $date_format = 'Y') {
	    if (trim ($timestamp) == '') {
	        $timestamp = time ();
	    } elseif (!ctype_digit ($timestamp)) {
	        $timestamp = strtotime ($timestamp);
	    }
	    # remove S (st,nd,rd,th) there are no such things in indonesia :p
	    $date_format = preg_replace ("/S/", "", $date_format);
	    $pattern = array (
	        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
	        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
	        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
	        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
	        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
	        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
	        '/April/','/June/','/July/','/August/','/September/','/October/',
	        '/November/','/December/',
	    );
	    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
	        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
	        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
	        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
	        'Oktober','November','Desember',
	    );
	    $date = date ($date_format, $timestamp);
	    $date = preg_replace ($pattern, $replace, $date);
	    $date = "{$date}";
	    return $date;
	} 
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/


	/* 
  	| function indenesia_date_day()
  	|---------------------------------------------START----------------------------------------------------
  	*/
	function indonesia_date_day($timestamp = '', $date_format = 'l') {
	    if (trim ($timestamp) == '') {
	        $timestamp = time ();
	    } elseif (!ctype_digit ($timestamp)) {
	        $timestamp = strtotime ($timestamp);
	    }
	    # remove S (st,nd,rd,th) there are no such things in indonesia :p
	    $date_format = preg_replace ("/S/", "", $date_format);
	    $pattern = array (
	        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
	        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
	        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
	        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
	        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
	        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
	        '/April/','/June/','/July/','/August/','/September/','/October/',
	        '/November/','/December/',
	    );
	    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
	        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
	        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
	        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
	        'Oktober','November','Desember',
	    );
	    $date = date ($date_format, $timestamp);
	    $date = preg_replace ($pattern, $replace, $date);
	    $date = "{$date}";
	    return $date;
	} 
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/



	/* 
  	| function time_format()
  	|---------------------------------------------START----------------------------------------------------
  	*/
	function time_format($format, $timestamp) {
		$date = date_create($timestamp);
	    if ($format == 1) {
	    	return date_format($date, 'Y-m-d H:i:s');
	    } elseif ($format == 2) {
	    	return date_format($date, 'd/m/Y H:i:s');
	    } elseif ($format == 3) {
	    	return date_format($date, 'd-m-Y');
	    } elseif ($format == 4) {
	    	return date_format($date, 'd-m-y');
	    } elseif ($format == 5) {
	    	return date_format($date, 'g:i A');
	    } elseif ($format == 6) {
	    	return date_format($date, 'G:ia');
	    } elseif ($format == 7) {
	    	return date_format($date, 'g:ia \o\n l jS F Y');
	    } elseif ($format == 8) {
	    	return date_format($date, 'Y-m-d');
	    }
	} 
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/



	/* 
  	| function time_ago()
  	|---------------------------------------------START----------------------------------------------------
  	*/
	function time_ago($time) {
		$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths = array("60","60","24","7","4.35","12","10");
		$now = time();
       $difference    =  $now - strtotime($time);
       $tense         = "ago";
		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}
		$difference = round($difference);
		if($difference != 1) {
			$periods[$j].= "s";
		}
		return "$difference $periods[$j] ";
	}
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/

	/* 
  	| function get_mount()
  	|---------------------------------------------START----------------------------------------------------
  	*/
    if (!function_exists('get_mouth')) {
	    function get_mouth() {
	        $value = date('m');
	        if ($value === '01') {
	           return 'Januari';
	        } elseif ($value === '02') {
	           return 'Februari';
	        } elseif ($value === '03') {
	           return 'Maret';
	        } elseif ($value === '04') {
	           return 'April';
	        } elseif ($value === '05') {
	           return 'Mei';
	        } elseif ($value === '06') {
	           return 'Juni';
	        } elseif ($value === '07') {
	           return 'Juli';
	        } elseif ($value === '08') {
	           return 'Agustus';
	        } elseif ($value === '09') {
	           return 'September';
	        } elseif ($value === '10') {
	           return 'Oktober';
	        } elseif ($value === '11') {
	           return 'November';
	        } else {
	           return 'Desember';
	        }
	    }
	}

	if (!function_exists('get_mouth_olny')) {
	    function get_mouth_olny($mount) {
	        $value = $mount;
	        if ($value === '01') {
	           return 'Januari';
	        } elseif ($value === '02') {
	           return 'Februari';
	        } elseif ($value === '03') {
	           return 'Maret';
	        } elseif ($value === '04') {
	           return 'April';
	        } elseif ($value === '05') {
	           return 'Mei';
	        } elseif ($value === '06') {
	           return 'Juni';
	        } elseif ($value === '07') {
	           return 'Juli';
	        } elseif ($value === '08') {
	           return 'Agustus';
	        } elseif ($value === '09') {
	           return 'September';
	        } elseif ($value === '10') {
	           return 'Oktober';
	        } elseif ($value === '11') {
	           return 'November';
	        } else {
	           return 'Desember';
	        }
	    }
	}
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/


	/* 
  	| function get_mouth_v1()
  	|---------------------------------------------START----------------------------------------------------
  	*/
    if (!function_exists('get_mouth_v1')) {
	    function get_mouth_v1($value) {
	        $year = date('Y');
	        if ($value == '1') {
	           return 'Januari '. $year;
	        } elseif ($value == '2') {
	           return 'Februari '. $year;
	        } elseif ($value == '3') {
	           return 'Maret '. $year;
	        } elseif ($value == '4') {
	           return 'April '. $year;
	        } elseif ($value == '5') {
	           return 'Mei '. $year;
	        } elseif ($value == '6') {
	           return 'Juni '. $year;
	        } elseif ($value == '7') {
	           return 'Juli '. $year;
	        } elseif ($value == '8') {
	           return 'Agustus '. $year;
	        } elseif ($value == '9') {
	           return 'September '. $year;
	        } elseif ($value == '10') {
	           return 'Oktober '. $year;
	        } elseif ($value == '11') {
	           return 'November '. $year;
	        } elseif ($value == '12') {
	           return 'Desember '. $year;
	        }
	    }
	}
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/


	/* 
  	| function get_mouth_v2()
  	|---------------------------------------------START----------------------------------------------------
  	*/
    if (!function_exists('get_mouth_v2')) {
	    function get_mouth_v2($value) {
	        if ($value == '1') {
	           return 'january';
	        } elseif ($value == '2') {
	           return 'february';
	        } elseif ($value == '3') {
	           return 'march';
	        } elseif ($value == '4') {
	           return 'april';
	        } elseif ($value == '5') {
	           return 'may';
	        } elseif ($value == '6') {
	           return 'june';
	        } elseif ($value == '7') {
	           return 'july';
	        } elseif ($value == '8') {
	           return 'august';
	        } elseif ($value == '9') {
	           return 'september';
	        } elseif ($value == '10') {
	           return 'October';
	        } elseif ($value == '11') {
	           return 'November';
	        } elseif ($value == '12') {
	           return 'december';
	        }
	    }
	}
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/
	

	/* 
  	| function get_mouth_v3()
  	|---------------------------------------------START----------------------------------------------------
  	*/
    if (!function_exists('get_mouth_v3')) {
	    function get_mouth_v3($value) {
	        if ($value == 'january') {
	           return '1';
	        } elseif ($value == 'february') {
	           return '2';
	        } elseif ($value == 'march') {
	           return '3';
	        } elseif ($value == 'april') {
	           return '4';
	        } elseif ($value == 'may') {
	           return '5';
	        } elseif ($value == 'june') {
	           return '6';
	        } elseif ($value == 'july') {
	           return '7';
	        } elseif ($value == 'august') {
	           return '8';
	        } elseif ($value == 'september') {
	           return '9';
	        } elseif ($value == 'october') {
	           return '10';
	        } elseif ($value == 'november') {
	           return '11';
	        } elseif ($value == 'desember') {
	           return '12';
	        }
	    }
	}

	if (!function_exists('get_mouth_v4')) {
	    function get_mouth_v4($value) {
	        if ($value == '01') {
	           return 'Januari';
	        } elseif ($value == '02') {
	           return 'Feruari';
	        } elseif ($value == '03') {
	           return 'Maret';
	        } elseif ($value == '04') {
	           return 'April';
	        } elseif ($value == '05') {
	           return 'Mei';
	        } elseif ($value == '06') {
	           return 'Juni';
	        } elseif ($value == '07') {
	           return 'Juli';
	        } elseif ($value == '08') {
	           return 'Agustus';
	        } elseif ($value == '09') {
	           return 'September';
	        } elseif ($value == '10') {
	           return 'Oktober';
	        } elseif ($value == '11') {
	           return 'November';
	        } elseif ($value == '12') {
	           return 'Desember';
	        }
	    }
	}

	if (!function_exists('get_wilayah')) {
		function get_wilayah($table,$where,$output){
		    $db = \Config\Database::connect();
		    if (empty($table)) {
		        die('Table not selected');
		    }else{
		        return $db->table($table)->where($where)->get()->getRow($output);
		    }
		}
	}
	/* 
	|----------------------------------------------END------------------------------------------------------ 
	*/
