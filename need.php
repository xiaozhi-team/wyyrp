<?php
class need{
	public static $info = [];
	/*
	* curl
	*/
	public static function teacher_curl($url, $paras = array()) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		if (@$paras['Header']) {
			$Header = $paras['Header'];
		} else {
			$Header[] = "Accept:*/*";
			$Header[] = "Accept-Encoding:gzip,deflate,sdch";
			$Header[] = "Accept-Language:zh-CN,zh;q=0.8";
			$Header[] = "Connection:close";
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, $Header);
		if (@$paras['ctime']) { // 连接超时
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $paras['ctime']);
		} else {
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		}
		if (@$paras['rtime']) { // 读取超时
			curl_setopt($ch, CURLOPT_TIMEOUT, $paras['rtime']);
		}
		if (@$paras['post']) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $paras['post']);
		}else{
			curl_setopt($ch, CURLOPT_HTTPGET, 1);
		}
		if (@$paras['header']) {
			curl_setopt($ch, CURLOPT_HEADER, true);
		}
		if (@$paras['cookie']) {
			if(@$paras['Cookie']) {
				foreach(explode('; ', $paras['cookie']) as $v)
				{
					curl_setopt($ch, CURLOPT_COOKIE, $v);
				}
			} else {
				curl_setopt($ch, CURLOPT_COOKIE, $paras['cookie']);
			}
		}
		if (@$paras['refer']) {
			if ($paras['refer'] == 1) {
				curl_setopt($ch, CURLOPT_REFERER, 'http://m.qzone.com/infocenter?g_f=');
			} else {
				curl_setopt($ch, CURLOPT_REFERER, $paras['refer']);
			}
		}
		if (@$paras['ua']) {
			curl_setopt($ch, CURLOPT_USERAGENT, $paras['ua']);
		} else {
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36");
		}
		if (@$paras['nobody']) {
			curl_setopt($ch, CURLOPT_NOBODY, 1);
		}
		if(@$paras['resolve']) {
			curl_setopt($ch, CURLOPT_IPRESOLVE, 1);
		}
		if(@$paras['jump']) {
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		}
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		/*
		curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
		curl_setopt($ch, CURLOPT_PROXY, "114.114.114.114"); //代理服务器地址
		//curl_setopt($ch, CURLOPT_PROXYPORT, 12635); //代理服务器端口
		curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		*/
		if (@$paras['GetCookie']) {
			curl_setopt($ch, CURLOPT_HEADER, 1);
			$result = curl_exec($ch);
			preg_match_all("/Set-Cookie: (.*?);/m", $result, $matches);
			$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
			$header = substr($result, 0, $headerSize); //状态码
			$body = substr($result, $headerSize);
			$ret = [
				"Cookie" => $matches, "body" => $body, "header" => $header, 'code' => curl_getinfo($ch, CURLINFO_HTTP_CODE)
			];
			curl_close($ch);
			return $ret;
		}
		$ret = curl_exec($ch);
		if(curl_errno($ch))
		{
			curl_close($ch);
			return false;
		}
		if (@$paras['loadurl']) {
			$Headers = curl_getinfo($ch);
			$ret = $Headers['redirect_url'];
		}
		self::$info = curl_getinfo($ch);
		curl_close($ch);
		return $ret;
	}
    	/*
	* 输出
	*/
	public static function send($Msg, $Type = 'jsonp') {
		header('Content-Type:application/json; charset=utf-8;');
		if($Type == 'text') {
			echo $Msg;
			exit();
		}else if($Type == 'location') {
			header('location:'.$Msg);
			exit();
		}else if($Type == 'image') {
			header('Content-type:image/png;image/jpeg;image/gif;');
			//header('Content-type:image/jpeg');
			$curl = New need;
			echo $curl->teacher_curl($Msg);
			exit();
		}else if($Type == 'url') {
			echo $Msg;
			exit();
		}else if($Type == 'tion') {
			echo $Msg;
			exit();
		}else if($Type == 'jsonp') {
			echo stripslashes(json_encode($Msg,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
			exit();
		}else{
			echo json_encode($Msg,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
			exit();
		}
	}
}