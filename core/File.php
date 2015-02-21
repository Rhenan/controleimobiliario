<?php
class File {
	
	private $file_array;
	
	private $lastFileNameUploaded;
	
	const PDF = "application/pdf";
	const JPEG = "image/jpeg";
	
	private $upload_dir;
	
	public function __construct($file_arr,$extension=null)
	{
		if($extension!=null)
		{
			if($extension != $file_arr['type'])
			{
				$this->file_array = null;
				throw new Exception("Wrong file type");
				exit;
			}
		}
		
		$this->file_array = $file_arr;
		
		$this->upload_dir = (defined("UPLOAD_DIR")?UPLOAD_DIR:$_SERVER["DOCUMENT_ROOT"]."/files/");
	}
	
	public function getLastFileNameUploaded()
	{
		return $this->lastFileNameUploaded;
	}
	
	public function upload($return_only_name=null){
		
		$filename = date("YmdNGisu") . rand(0,1000) .$this->file_array['name'];
		$upload_file_full_path = $this->upload_dir . $filename;
	
		if($this->file_array==null)
		{
			throw new Exception("Wrong file type");
			exit;
		}
		
		if(move_uploaded_file($this->file_array['tmp_name'] , $upload_file_full_path))
		{
			if($return_only_name)
				return $filename;
			else
				return $upload_file_full_path;
		}
		else 
		{
			return null;
		}
	}
	
	public static function download($file)
	{
		$filepath = (defined("UPLOAD_DIR")?UPLOAD_DIR:$_SERVER["DOCUMENT_ROOT"]."/files/").$file;
		$fp = fopen($filepath,"r") ;
		$fsize = filesize($filepath);
		header('Accept-Ranges: bytes');
		header("Content-Length: $fsize");
		header("Content-Disposition: attachment; filename=\"$file\";");
		header('Content-Type: application/pdf');
		 
		$sent = 0;
		while ( !feof($fp) && $sent < $fsize && ($buf = fread($fp, 8192)) != '' ){
		  echo $buf;
		  $sent += strlen($buf);
		  flush();  ob_flush();
		}
		fclose($fp);
	}
	
	public static function remove_file($file)
	{
		$filepath = (defined("UPLOAD_DIR")?UPLOAD_DIR:$_SERVER["DOCUMENT_ROOT"]."/files/").$file;
		if(file_exists($filepath))
			unlink($filepath);
	}
}

?>
