<?php
const class_version = "1.0.1";

// Warna teks
const n = "\n";          // Baris baru
const d = "\033[0m";     // Reset
const m = "\033[1;31m";  // Merah
const h = "\033[1;32m";  // Hijau
const k = "\033[1;33m";  // Kuning
const b = "\033[1;34m";  // Biru
const u = "\033[1;35m";  // Ungu
const c = "\033[1;36m";  // Cyan
const p = "\033[1;37m";  // Putih
const o = "\033[38;5;214m"; // Warna mendekati orange
const o2 = "\033[01;38;5;208m"; // Warna mendekati orange

// Warna teks tambahan
const r = "\033[38;5;196m";   // Merah terang
const g = "\033[38;5;46m";    // Hijau terang
const y = "\033[38;5;226m";   // Kuning terang
const b1 = "\033[38;5;21m";   // Biru terang
const p1 = "\033[38;5;13m";   // Ungu terang
const c1 = "\033[38;5;51m";   // Cyan terang
const gr = "\033[38;5;240m";  // Abu-abu gelap

// Warna latar belakang
const mp = "\033[101m\033[1;37m";  // Latar belakang merah
const hp = "\033[102m\033[1;30m";  // Latar belakang hijau
const kp = "\033[103m\033[1;37m";  // Latar belakang kuning
const bp = "\033[104m\033[1;37m";  // Latar belakang biru
const up = "\033[105m\033[1;37m";  // Latar belakang ungu
const cp = "\033[106m\033[1;37m";  // Latar belakang cyan
const pm = "\033[107m\033[1;31m";  // Latar belakang putih (merah teks)
const ph = "\033[107m\033[1;32m";  // Latar belakang putih (hijau teks)
const pk = "\033[107m\033[1;33m";  // Latar belakang putih (kuning teks)
const pb = "\033[107m\033[1;34m";  // Latar belakang putih (biru teks)
const pu = "\033[107m\033[1;35m";  // Latar belakang putih (ungu teks)
const pc = "\033[107m\033[1;36m";  // Latar belakang putih (cyan teks)
const yh = d."\033[43;30m"; // Latar belakang kuning (black teks)

// Warna latar belakang tambahan
const bg_r = "\033[48;5;196m";   // Latar belakang merah terang
const bg_g = "\033[48;5;46m";    // Latar belakang hijau terang
const bg_y = "\033[48;5;226m";   // Latar belakang kuning terang
const bg_b1 = "\033[48;5;21m";   // Latar belakang biru terang
const bg_p1 = "\033[48;5;13m";   // Latar belakang ungu terang
const bg_c1 = "\033[48;5;51m";   // Latar belakang cyan terang
const bg_gr = "\033[48;5;240m";  // Latar belakang abu-abu gelap


class Requests {
  static function Curl($u, $h = 0, $p = 0,$mode = 0){
    while(true){
      $ch = curl_init();
		  curl_setopt($ch, CURLOPT_URL, $u);
	   	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	   	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	   	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	   	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	   	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		  curl_setopt($ch, CURLOPT_COOKIE,TRUE);
	   	curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
	    curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");
		  if($mode){
		    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$mode);
		  }
		  if($p) {
		    curl_setopt($ch, CURLOPT_POST, true);
			  curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
		  }
		  if($h) {
		    curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
		  }
		  curl_setopt($ch, CURLOPT_HEADER, true);
      $r = curl_exec($ch);
		  $c = curl_getinfo($ch);
		  if(!$c) return "Curl Error : ".curl_error($ch); else{
		    $hd = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
			  $bd = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
			  curl_close($ch);
			  return array($hd,$bd);
		  }
    }
  }
}
class Display {
  static function Clear(){
    if( PHP_OS_FAMILY == "Linux" ){
      system('clear');
    }else{
      pclose(popen('cls','w'));
    }
  } 
  static function menu($no,$conten){
    print(p.'['.m.$no.p.'] '.p. $conten.n);
  }
  static function Line($len = 44){
    print c.str_repeat('─',$len).n;
  }
  static function ban(){
    self::clear();
	  $Api = self::ipApi();
	  echo bp.'     '.$Api->country.' '.$Api->city.' '.$Api->query.'     '.d.n;
	  print r.'┏━┓┏┳┓━┓┏━┓┳━┓ '.k.'┳ ┳┏┳┓   '.r.'➤ '.p.'Script : '.y.name.n.r.'┣━┫┃ ┃ ┃┣━┫┃ ┃ '.k.'┗┳┛ ┃    '.r.'➤ '.p.'Version: '.g.version.n.r.'┻ ┻┻ ┻┗┛┻ ┻┻━┛ '.k.' ┻  ┻    '.r.'➤ '.p.'Status : '.g.'Online'.n;
	  print kp.'        ©copyright Amjadyt||2024            '.d.n;
	  self::line();
	}
	static function ipApi(){
	  $r = json_decode(file_get_contents("http://ip-api.com/json"));
	  if($r->status == "success")return $r;
	}
	static function Error($content){
	  print(m.'['.p.'!'.m.'] '.$content.n);
	}
	static function sukses($content){
	  print(p.'['.h.'√'.p.'] '.$content.n);
	}
	static function input($nama){
	  return(p.'['.m.'+'.p.'] Input '.$nama.': ');
	}
	static function Cetak ($nama,$msg){
	  print(p.'['.m.$nama.p.'] '.m.'──> '.p.$msg.n);
	}
}
class Functions {
  static $configFile = "data.json";
  static function Tmr($tmr){date_default_timezone_set("UTC");$sym = [' ─ ',' / ',' │ ',' \ ',];$timr = time()+$tmr;$a = 0;while(true){$a +=1;$res=$timr-time();if($res < 1) {break;}print $sym[$a % 4].p.date('H',$res).":".p.date('i',$res).":".p.date('s',$res)."\r";usleep(100000);}print "\r           \r";}
  static function setConfig($key){if(!file_exists(self::$configFile)){$config = [];}else{$config = json_decode(file_get_contents(self::$configFile),1);}if(isset($config[$key])){return $config[$key];}else{print Display::input($key);$data = readline();print n;$config[$key] = $data;file_put_contents(self::$configFile,json_encode($config,JSON_PRETTY_PRINT));return $data;}}
	static function removeConfig($key){$config = json_decode(file_get_contents(self::$configFile),1);unset($config[$key]);file_put_contents(self::$configFile,json_encode($config,JSON_PRETTY_PRINT));}
	static function getConfig($key){if(!file_exists(self::$configFile)){$config = [];}else{$config = json_decode(file_get_contents(self::$configFile),1);}return $config[$key];}
	static function view($youtube){$tanggal = date("dmy");$config = json_decode(file_get_contents(self::$configFile),1);$view = $config['view'];if($tanggal == $view){return 0;}else{$config['view'] = $tanggal;if( PHP_OS_FAMILY == "Linux" ){system("termux-open-url ".$youtube);}else{system("start ".$youtube);}file_put_contents(self::$configFile,json_encode($config,JSON_PRETTY_PRINT));}}
	static function msg($str, $j = 10){
	  $simbol = ['-', '/', '|', '\\'];
	  for($i = $j; $i > 0; $i--){
	    foreach($simbol as $n => $s){
	      print p."  [".k.$s.p."] ".h.$str." ".k.str_repeat("➤", $n)."\r";
	      usleep(100000);
	    }
	  }
	  print "                           "."\r";
	}
}
class HtmlScrap {
	function __construct(){
		$this->captcha = '/class=["\']([^"\']+)["\'][^>]*data-sitekey=["\']([^"\']+)["\'][^>]*>/i';
		$this->input = '/<input[^>]*name=["\'](.*?)["\'][^>]*value=["\'](.*?)["\'][^>]*>/i';
		$this->limit = '/(\d{1,})\/(\d{1,})/';
	}
	private function scrap($pattern, $html){preg_match_all($pattern, $html, $matches);return $matches;}
	private function getCaptcha($html){$scrap = $this->scrap($this->captcha, $html);for($i = 0; $i < count($scrap[1]); $i++){$data[$scrap[1][$i]] = $scrap[2][$i];}return $data;}
	private function getInput($html, $form = 1){$form = explode('<form', $html)[$form];$scrap = $this->scrap($this->input, $form);for($i = 0; $i < count($scrap[1]); $i++){$data[$scrap[1][$i]] = $scrap[2][$i];}return $data;}
	public function Result($html, $form = 1)
	{
		$data['title'] = explode('</title>',explode('<title>', $html)[1])[0];
		$data['cloudflare']=(preg_match('/Just a moment.../',$html))? true:false;
		$data['firewall'] =(preg_match('/Firewall/',$html))? true:false;
		$data['locked'] = (preg_match('/Locked/',$html))? true:false;
		$data["captcha"] = $this->getCaptcha($html);
		
		$input = $this->getInput($html, $form);
		$data["input"] = ($input)? $input:$this->getInput($html, 2);
		$data["faucet"] = $this->scrap($this->limit, $html);
		
		$sukses = explode("icon: 'success',",$html)[1];
		if($sukses){
			$data["response"]["success"] = strip_tags(explode("'",explode("html: '",$sukses)[1])[0]);
		}else{
			$warning = explode("'",explode("html: '",$html)[1])[0];
			$ban = explode('</div>',explode('<div class="alert text-center alert-danger"><i class="fas fa-exclamation-circle"></i> Your account',$html)[1])[0];
			$invalid = (preg_match('/invalid amount/',$html))? "You are sending an invalid amount":false;
			$shortlink = (preg_match('/Shortlink in order to claim from the faucet!/',$html))? $warning:false;
			$sufficient = (preg_match('/sufficient funds/',$html))? "Sufficient funds":false;
			$daily = (preg_match('/Daily claim limit/',$html))? "Daily claim limit":false;
			$data["response"]["unset"] = false;
			$data["response"]["exit"] = false;
			if($ban){
				$data["response"]["warning"] = $ban;
				$data["response"]["exit"] = true;
			}elseif($invalid){
				$data["response"]["warning"] = $invalid;
				$data["response"]["unset"] = true;
			}elseif($shortlink){
				$data["response"]["warning"] = $shortlink;
				$data["response"]["exit"] = true;
			}elseif($sufficient){
				$data["response"]["warning"] = $sufficient;
				$data["response"]["unset"] = true;
			}elseif($warning){
				$data["response"]["warning"] = $warning;
			}else{
				$data["response"]["warning"] = "Not Found";
			}
		}
		return $data;
	}
}
