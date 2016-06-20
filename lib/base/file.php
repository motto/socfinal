<?php
namespace lib\base;

class File{

	static public function  readCSV($filepath,$sep=','){
		$fileT=[];
		$file = fopen($filepath, 'r');
		while (($line = fgetcsv($file)) !== FALSE) {
			$fileT[]=$line;
		}
		fclose($file);
		return $fileT;
	}

	
/**
ha a mezőtomb üres az elsősorból veszi a mezőneveket
 */
	static public function  readCSV_assocT($filepath,$sep=',',$mezoT=[]){
		$file = fopen($filepath, 'r');$fileT=[];$T=[];
		if(empty($mezoT)){$mezoT=fgetcsv($file);}	
		//print_r($mezoT);
		while (($line = fgetcsv($file)) !== FALSE) {
			foreach ($mezoT as $key=>$mezo){
				$value='';
				if(isset($line[$key])){$value=$line[$key];}
				$T[$mezo]=$value;
			}
			
		$fileT[]=$T;
		}
		fclose($file);
		return $fileT;
	}
	
	
static public function  lista($dir,$nodir=true){
		$fileT=[];
		if ($handle = opendir($dir)) {
		while (false !== ($entry = readdir($handle))) {
	
				if ($entry != "." && $entry != "..") {
					if(is_dir($dir.'/'.$entry)){if(!$nodir){$fileT[]=$entry;}}
					else{$fileT[]=$entry;}
				}
			}
			closedir($handle);
		}
		return $fileT;
	}	

static public function  allowlista($dir,$allowT=[]){
		$fileT=[];
		if ($handle = opendir($dir)) {
			while (false !== ($entry = readdir($handle))) {
	
				if ($entry != "." && $entry != "..") {
					$ext = pathinfo($entry,PATHINFO_EXTENSION);
					$ext = strtolower($ext);
					if(in_array($ext, $allowT)){$fileT[]=$entry;}	
				}
			}
			closedir($handle);
		}
		return $fileT;
}


static public function  kep_cim($dir,$allowT,$refT=[]){
	
		$fileT=File::allowlista($dir,$allowT);
		$resT=[];
		foreach ($fileT as $file){
	//nagy kezdőbetű css: h6{text-transform: lowercase;} h6:first-letter {text-transform: uppercase;}
					$src=$dir.'/'.$file ;
					$nev = pathinfo($file,PATHINFO_FILENAME);
				
					if(isset($refT[$file]['cim'])){$cim=$refT[$file]['cim'];}else{$cim=$nev;}
					if(isset($refT[$file]['text'])){$text=$refT[$file]['text'];}else{$text='';}
					$resT[$nev]=['src'=>$src,'cim'=>$cim,'text'=>$text];
					//echo "";
				}
		return $resT;
		}
		
}