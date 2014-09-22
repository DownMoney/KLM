<?php
//error_reporting(0);
$__key_word = urldecode($_GET['key_word']);
$__domain = strtolower($_GET['domain']);
$__mode = strtolower($_GET['mode']);

$agents = array('Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8) Gecko/20051111 Firefox/1.5',
						  'Mozilla/5.0 (X11; U; FreeBSD i386; en-US; rv:1.2a) Gecko/20021021',
						  'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
						  'Linux-Lynx ('.$_SERVER['HTTP_HOST'].')',
						  'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
						  'Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8.1.4) Gecko/20070515 Firefox/2.0.0.4',
						  'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
						  'Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.9)
Gecko/2008052906 Firefox/3.0',
					     'Mozilla/5.0 (X11; U; Linux i686; pl-PL; rv:1.8.1.2) Gecko/20061023 SUSE/2.0.0.2-1.1 Firefox/2.0.0.2',
						  'Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)',
						  'Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.9.0.4) Gecko/2008102920 Firefox/3.0.4',
						  'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0; .NET CLR 1.1.4322)',
						  'Wget/1.10.2 (Red Hat modified)',
						  'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0; S.N.O.W.2; InfoPath.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)',
						  'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; Neostrada TP 6.1; .NET CLR 1.1.4322)',
						  'Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8.1.18) Gecko/20081029 Firefox/2.0.0.18',
						  'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)',
						  'Opera/9.52 (Windows NT 5.1; U; pl)',
						  'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)',
						  'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)');		
						


if ($__domain =='' || $_GET['seoserverquery'] != '1') {
	die();
}
if ($__mode=='anchors') {
	if( $__key_word == '') {
		die();
	}
	
	if(substr($__key_word,0,5) == 'site:') {
	$site_query = true;
	}
	
	if($site_query === true) {
	$url = 'http://www.google.pl/search?hl=pl&client=firefox-a&rls=org.mozilla%3Apl%3Aofficial&q='.urlencode($__key_word).'&btnG=Szukaj';
	} else {
	$url = 'http://www.google.pl/search?num=100&hl=pl&client=firefox-a&rls=org.mozilla%3Apl%3Aofficial&q='.urlencode($__key_word).'&btnG=Szukaj';
	}
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, $agents[array_rand($agents)]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);
		curl_close($ch);
	
  if(strpos($content,'302 Moved') == false) {	
	if($site_query === true) {
	eregi("<b>([0-9,]*)</b> z domeny",$content,$regs);
	$res = ereg_replace("[^0-9]",'',$regs[1]);		
	} else {
	eregi("<b>([0-9,]*)</b> dla zapytani",$content,$regs);
	$res = ereg_replace("[^0-9]",'',$regs[1]);
		
		
	$content = substr( $content, strpos( $content, '<div id=res' ) );	
	preg_match_all('/(<li class=g>)(.*?)(<\/div>)/',$content,$results);	
		$items = $results[0];
		
		unset($results,$content);
		$pos = 0;
		$skip = 0;
		if(is_array($items)) {
			foreach( $items as $n => $i ) {
				if( $i == '' ) { continue; }
				$pos++;
				if($n == count($items)-1) {
					$pos = 0;
					break;
				}
				if( strpos(strtolower($i),'<a href="/imgres?') !== false && $pos > 1) {
					$pos--;
				}
				if( strpos(strtolower($i),'<table ') !== false && $pos > 1) {
					$pos--;
				}
				
				if( strpos(strtolower(strip_tags($i,'<a>')),$__domain) ) {
					break;
				}
				
			}
			unset($items);
		}
	}	//if($site_query === true) {
		$data = array('pos' => (int)$pos,
					     'res' => (int)$res);
	} else {
	  $data['google_banned'] = true;
	}
}

if ($__mode=='page') {
	function to_int_32 (&$x) {
		$z = hexdec(80000000);
		$y = (int) $x;
		if($y ==- $z && $x <- $z){
			$y = (int) ((-1) * $x);
			$y = (-1) * $y;
		}
		$x = $y;
	}

	/**
	     * Fills in zeros on a number
	     * (Required for pagerank hash)
	     */
	function zero_fill ($a, $b) {
		$z = hexdec(80000000);
		if ($z & $a) {
			$a = ($a >> 1);
			$a &= (~$z);
			$a |= 0x40000000;
			$a = ($a >> ($b - 1));
		} else {
			$a = ($a >> $b);
		}
		return $a;
	}

	/**
	     * Pagerank hash prerequisites
	     */
	function mix($a, $b, $c) {
		$a -= $b; $a -= $c; to_int_32($a); $a = (int)($a ^ (zero_fill($c,13)));
		$b -= $c; $b -= $a; to_int_32($b); $b = (int)($b ^ ($a<<8));
		$c -= $a; $c -= $b; to_int_32($c); $c = (int)($c ^ (zero_fill($b,13)));
		$a -= $b; $a -= $c; to_int_32($a); $a = (int)($a ^ (zero_fill($c,12)));
		$b -= $c; $b -= $a; to_int_32($b); $b = (int)($b ^ ($a<<16));
		$c -= $a; $c -= $b; to_int_32($c); $c = (int)($c ^ (zero_fill($b,5)));
		$a -= $b; $a -= $c; to_int_32($a); $a = (int)($a ^ (zero_fill($c,3)));
		$b -= $c; $b -= $a; to_int_32($b); $b = (int)($b ^ ($a<<10));
		$c -= $a; $c -= $b; to_int_32($c); $c = (int)($c ^ (zero_fill($b,15)));
		return array($a,$b,$c);
	}

	/**
	     * Pagerank checksum hash emulator
	     */
	function checksum ($url, $length = null, $init = 0xE6359A60) {
		if (is_null($length)) {
			$length = sizeof($url);
		}
		$a = $b = 0x9E3779B9;
		$c = $init;
		$k = 0;
		$len = $length;
		while($len >= 12) {
			$a += ($url[$k+0] + ($url[$k+1] << 8) + ($url[$k+2] << 16) + ($url[$k+3] << 24));
			$b += ($url[$k+4] + ($url[$k+5] << 8) + ($url[$k+6] << 16) + ($url[$k+7] << 24));
			$c += ($url[$k+8] + ($url[$k+9] << 8) + ($url[$k+10] << 16) + ($url[$k+11] << 24));
			$mix = mix($a,$b,$c);
			$a = $mix[0]; $b = $mix[1]; $c = $mix[2];
			$k += 12;
			$len -= 12;
		}
		$c += $length;
		switch($len) {
			case 11: $c += ($url[$k + 10] << 24);
			case 10: $c += ($url[$k + 9] << 16);
			case 9: $c += ($url[$k + 8] << 8);
			case 8: $b += ($url[$k + 7] << 24);
			case 7: $b += ($url[$k + 6] << 16);
			case 6: $b += ($url[$k + 5] << 8);
			case 5: $b += ($url[$k + 4]);
			case 4: $a += ($url[$k + 3] << 24);
			case 3: $a += ($url[$k + 2] << 16);
			case 2: $a += ($url[$k + 1] << 8);
			case 1: $a += ($url[$k + 0]);
		}
		$mix = mix($a, $b, $c);
		return $mix[2];
	}

	/**
	     * ASCII conversion of a string
	     */
	function strord($string) {
		for($i = 0; $i < strlen($string); $i++) {
			$result[$i] = ord($string{$i});
		}
		return $result;
	}

	/**
	     * Number formatting for use with pagerank hash
	     */
	function format_number ($number='', $divchar = ',', $divat = 3) {
		$decimals = '';
		$formatted = '';
		if (strstr($number, '.')) {
			$pieces = explode('.', $number);
			$number = $pieces[0];
			$decimals = '.' . $pieces[1];
		} else {
			$number = (string) $number;
		}
		if (strlen($number) <= $divat)
		return $number;
		$j = 0;
		for ($i = strlen($number) - 1; $i >= 0; $i--) {
			if ($j == $divat) {
				$formatted = $divchar . $formatted;
				$j = 0;
			}
			$formatted = $number[$i] . $formatted;
			$j++;
		}
		return $formatted . $decimals;
	}

	// podstrony
	$urls = array("http://www.google.pl/search?hl=pl&q=site%3A".urlencode($__domain)."&btnG=Szukaj+w+Google&lr=",
					 "http://www.google.pl/search?hl=pl&q=site%3A".urlencode($__domain)."",
					 "http://google.pl/search?hl=pl&q=site%3A".urlencode($__domain)."",
					 "http://www.google.pl/search?num=100&hl=pl&client=firefox-a&rls=org.mozilla%3Apl%3Aofficial&q=site%3A".urlencode($__domain)."&btnG=Szukaj",
					 "http://www.google.pl/search?hl=pl&client=firefox-a&rls=org.mozilla%3Apl%3Aofficial&q=site%3A".urlencode($__domain)."&btnG=Szukaj",
					 "http://www.google.pl/search?num=20&hl=pl&client=firefox-a&rls=org.mozilla%3Apl%3Aofficial&q=site%3A".urlencode($__domain)."&btnG=Szukaj",
					 "http://www.google.pl/search?num=30&hl=pl&client=firefox-a&rls=org.mozilla%3Apl%3Aofficial&q=site%3A".urlencode($__domain)."&btnG=Szukaj",
					 "http://www.google.pl/search?num=50&hl=pl&client=firefox-a&rls=org.mozilla%3Apl%3Aofficial&q=site%3A".urlencode($__domain)."&btnG=Szukaj",
					 "http://google.pl/search?num=100&hl=pl&q=site%3A".urlencode($__domain)."&btnG=Szukaj",
					 "http://google.pl/search?num=50&hl=pl&q=site%3A".urlencode($__domain)."&btnG=Szukaj",
					 "http://google.pl/search?num=30&hl=pl&q=site%3A".urlencode($__domain)."&btnG=Szukaj",
					 "http://google.pl/search?num=20&hl=pl&q=site%3A".urlencode($__domain)."&btnG=Szukaj",
					 "http://google.pl/search?num=50&hl=pl&q=site%3A".urlencode($__domain)."&btnG=Szukaj",
					 "http://www.google.pl/search?hl=pl&num=20&&q=site%3A".urlencode($__domain)."&btnG=Szukaj+w+Google&lr=",
					 "http://www.google.pl/search?hl=pl&num=30&&q=site%3A".urlencode($__domain)."&btnG=Szukaj+w+Google&lr=",
					 "http://www.google.pl/search?hl=pl&num=50&&q=site%3A".urlencode($__domain)."&btnG=Szukaj+w+Google&lr=",
					 "http://www.google.pl/search?hl=pl&num=100&&q=site%3A".urlencode($__domain)."&btnG=Szukaj+w+Google&lr=");
	$url = $urls[array_rand($urls)];
  
  //	$url = ;
 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, $agents[array_rand($agents)]);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec($ch);
	
	if(strpos($content,'302 Moved') == false) {
		curl_close($ch);
		eregi("<b>([0-9,]*)</b> z domeny",$content,$regs);
		$res = ereg_replace("[^0-9]",'',$regs[1]);
		$data['indexed'] = $res;
	} else {
		$data['google_banned'] = true;
	}
	
		sleep(rand(1,10));
		// pagerank
		$info = 'info:' . urlencode($__domain);
		$checksum = checksum(strord($info));
		$url = "http://www.google.com/search?client=navclient-auto&ch=6".$checksum."&features=Rank&q=".$info;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, $agents[array_rand($agents)]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);
		if(strpos($content,'302 Moved') == false) {
			curl_close($ch);
			$regs = array();
			ereg("^Rank_[0-9]:[0-9]:(.*)",$content,$regs);
			if (isset($regs[1])) {
				$data['pagerank'] = trim($regs[1]);
			} else {
				$data['pagerank'] = -1;
			}
		} else {
			$data['google_banned'] = true;
		}
	
	// linki prowadzące do strony

	$url = "http://siteexplorer.search.yahoo.com/search?p=http%3A%2F%2F".urlencode($__domain)."&bwm=i&bwmo=d&bwmf=s";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'].' '.$_SERVER['HTTP_HOST']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec($ch);
	curl_close($ch);
	$regs = array();
	ereg("Inlinks \(([0-9,]*)\)",$content,$regs);
	if (isset($regs[1])) {
		$inlinks = ereg_replace(",",'',$regs[1]);
		$data['inlinks'] = $inlinks;
	};
}
echo serialize($data);
?>