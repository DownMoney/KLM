<?php
//error_reporting(0);
$url = base64_decode($_GET['proxyrequest']);

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
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, $agents[array_rand($agents)]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);
		curl_close($ch);
		echo $content;
		die();
?>
