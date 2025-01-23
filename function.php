<?php
//#### code By amjadyt #####
//##### 23-01-2025 #########
//##### Version 1.0.2 #########

const class_version = "1.0.2";
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

const p = "\033[1;97m",m = "\033[1;31m",h = "\033[1;32m",k = "\033[1;33m",c = "\033[1;36m",b = "\033[1;34m",mp = "\033[101m\033[1;37m",n = "\n",d = "\033[0m",t = "\t",r = " \r",bp="\033[104m\033[1;37m";

class Requests {
	static function Curl($url, $header=0, $post=0, $data_post=0, $cookie=0, $proxy=0, $skip=0){
	  while(true){
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	    curl_setopt($ch, CURLOPT_COOKIE,TRUE);if($cookie){
	      curl_setopt($ch, CURLOPT_COOKIEFILE,$cookie);
	      curl_setopt($ch, CURLOPT_COOKIEJAR,$cookie);
	    }
	    if($post) {
	      curl_setopt($ch, CURLOPT_POST, true);
	    }if($data_post) {
	      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
	    }if($header) {
	      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	    }if($proxy){
	      curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
	      curl_setopt($ch, CURLOPT_PROXY, $proxy);
	    }curl_setopt($ch, CURLOPT_HEADER, true);
	    $r = curl_exec($ch);
	    if($skip){
	      return;
	    }$c = curl_getinfo($ch);
	    if(!$c) return "Curl Error : ".curl_error($ch); else{
	      $head = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
	      $body = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
	      curl_close($ch);
	      if(!$body){
	        print "Check your Connection!";
	        sleep(2);print "\r                         \r";
	        continue;
	      }
	      return array($head,$body);
	    }
	  }
	}
}
