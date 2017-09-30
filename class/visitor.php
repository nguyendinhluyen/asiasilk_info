<?php
class visitor 
{
   //timeout
   var $timeout = 300;//tính bằng giây
   var $online = 1;
   var $hits = 1;
   
	//thời gian xóa các dữ liệu cũ
   var $timesave = 86400;
   function visitor()
   {
	  //xóa những lượt truy cập hum wa
	  delete('usersonline',"timestamp<".(time() - $this->timesave));
	  //kiểm tra ip đã có trong database hay chưa
	  //nếu chưa có thì insert vào database
	  if(!checkExit('ip_address','usersonline',"ip_address='{$_SERVER['REMOTE_ADDR']}'"))
	  {
		$data =array(
		'timestamp' => time(),
		'ip_address' => "{$_SERVER['REMOTE_ADDR']}",
		'refurl'	=> isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
		'user_agent' =>"{$_SERVER['HTTP_USER_AGENT']}",
		'user_host'=> "{$_SERVER['REQUEST_URI']}");
		insert('usersonline',$data);
	  }
	  else
	  {
			$data = array(
			'timestamp'=>time(),
                        'refurl' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
			'user_agent' =>"{$_SERVER['HTTP_USER_AGENT']}",
			'user_host'=> "{$_SERVER['REQUEST_URI']}");
			update('usersonline',$data,"ip_address='{$_SERVER['REMOTE_ADDR']}'");
	  }
	  //insert dữ liệu vào bảng vistor
	  $num = GetNumRow('id','usersonline','1=1');
	  $today = getdate();
	  $where = "day='".$today['mday']."' and mon= '".$today['mon']."' and year ='".$today['year']."'";
	  if(!checkExit('id','visitor',$where))
	  {
		//insert
		$data = array(
						'day' =>$today['mday'],
						'mon' => $today['mon'],
						'year'	=>$today['year'],
						'visitor' => $num
					);
		insert('visitor',$data);
	  }
	  else
	  {
		//update
		$data = array('visitor' => $num);
		update('visitor',$data,$where);
	  }
	  //lấy số người đang online
	  $this->online = GetNumRow('id','usersonline',"timestamp>".(time()-$this->timeout));
	  //Lấy số lượt truy cập website
		$CountFile = "../class/Counter.log";
		$CF = fopen ($CountFile, "r");
		$Hits = (double)(fread ($CF, filesize ($CountFile) ));
		fclose ($CF);
		$Hits++;
		if(isset($_SESSION["visitor"]))
		{
			$visitor=session_id();
			$_SESSION["visitor"] = "";
			$CF = fopen ($CountFile, "w");
			fwrite ($CF, $Hits);
			fclose ($CF);
		}
		$this->hits = $Hits;
		$MaxOnline = GetConfig('MaxOnline');
		$nMax = GetNumRow('ip_address','usersonline','timestamp>'.(time()-300));
		if($MaxOnline<$nMax)
		{
			SetConfig('MaxOnline',$nMax);
			SetConfig('timeMaxOnline',time());
		}
   }
}
?>