<?php 
// $config['id'] 		= 'phuongkimmy.02@gmail.com';
// $config['password'] =  'fb.com/hoainiem.0905180795';
$config['id'] 		= 's';
$config['password'] =  's';
class cURL {
	var $headers = array();
	var $user_agent;
	var $compression;
	var $cookie_file;
	var $proxy;
	function __construct($cookies=TRUE,$cookie='cook.txt',$compression='gzip',$proxy='') {
		$this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
		$this->headers[] = 'Connection: Keep-Alive';
		$this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
		$this->user_agent = 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36';
		$this->compression=$compression;
		$this->proxy=$proxy;
		$this->cookies=$cookies;
		if ($this->cookies == TRUE) $this->cookie($cookie);
	}
	function cookie($cookie_file) {
		if (file_exists($cookie_file)) {
			$this->cookie_file = $cookie_file;
		} else {
		fopen($cookie_file,'w') or $this->error('The cookie file could not be opened. Make sure this directory has the correct permissions');
		$this->cookie_file=$cookie_file;
		fclose($this->cookie_file);
		}
	}
	
	function getheader($url) {
		$process = curl_init($url);
		curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($process, CURLOPT_HEADER, 1);
		curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
		curl_setopt($process,CURLOPT_ENCODING , $this->compression);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($process,CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($process,CURLOPT_CAINFO, NULL);
		curl_setopt($process,CURLOPT_CAPATH, NULL);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}
	
	function getcontent($url) {
		$process = curl_init($url);	
		curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($process, CURLOPT_HEADER, 0);
		curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
		curl_setopt($process,CURLOPT_ENCODING , $this->compression);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($process,CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt($process,CURLOPT_CAINFO, NULL); 
		curl_setopt($process,CURLOPT_CAPATH, NULL);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}
	function postcontent($url,$data) {
		$process = curl_init($url);
		curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($process, CURLOPT_HEADER, 1);
		curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
		curl_setopt($process, CURLOPT_ENCODING , $this->compression);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		curl_setopt($process, CURLOPT_POSTFIELDS, $data);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($process, CURLOPT_POST, 1);
		curl_setopt($process,CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt($process,CURLOPT_CAINFO, NULL); 
		curl_setopt($process,CURLOPT_CAPATH, NULL); 
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}
	function error($error) {
		echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>";
		die;
	}
}
	function _login()
	{
		global $html, $curl, $config;
		
		preg_match('#<input type="hidden" value="(.*?)" name="fs_csrf" />#',$html,$fs_csrf);
		
		$data = 'fs_csrf=' . $fs_csrf[1] . '&LoginForm%5Bemail%5D=' . urlencode($config['id']). '&LoginForm%5Bpassword%5D=' . urlencode($config['password']) . '&LoginForm%5BrememberMe%5D=0&LoginForm%5BrememberMe%5D=1&yt0=%C4%90%C4%83ng+nh%E1%BA%ADp';
		$curl->postcontent('https://www.fshare.vn/login',$data);
	}
	function get_link_fshare($url)
	{
		$curl = new cURL();
		$html = $curl->getcontent($url);
		echo $html;
		// exit();
		// die();
		if(!preg_match('#<a style="cursor: pointer;color: \#999999;" title="(.*?)"#', $html, $acc))
			_login();/*chua dang nhap*/
		else
		{
			preg_match('#<input type="hidden" value="(.*?)" name="fs_csrf" />#',$html,$fs_csrf);
			preg_match('#id="DownloadForm_linkcode" type="hidden" value="(.*?)" />#',$html,$linkcode);
			$data = 'fs_csrf=' . $fs_csrf[1] . '&DownloadForm%5Blinkcode%5D='.$linkcode[1].'&DownloadForm%5Bpwd%5D=&ajax=download-form&undefined=undefined';
			
			$link_in = $curl->postcontent('https://www.fshare.vn/download/get',$data);
			// print_r($link_in);
			preg_match('#{"url":"(.*?)","wait_time":"1"}#',$link_in,$link);
			// print_r($link);
			$link_max_speed = str_replace('\\/', '/', $link[1]);
			return $link_max_speed;
		}		
	}

	$url = 'https://www.fshare.vn/file/7UFBZQHWT4SFHUI';
	echo get_link_fshare($url);

	// require_once 'construct.php';

	// $linkMaxSpeed = get_link_fshare($_GET['url']);


	// $title = "Download";
	// $url = $linkMaxSpeed;
	// $buttonDownload = $bot->createButtonToURL($title, $url);

	// $text = "link của {$gender} đã được chuẩn bị xong:";
	// $bot->sendTextCard($text, $buttonDownload);
?>