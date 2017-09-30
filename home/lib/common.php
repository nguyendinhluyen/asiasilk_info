<?php 
class common{
	public function limitContent($string,$num){
		$string = strip_tags($string);
		if (strlen($string) > $num) {
			// truncate string
			$stringCut = substr($string, 0, $num);
			// make sure it ends in a word so assassinate doesn't become ass...
			$string = substr($stringCut, 0, strrpos($stringCut, ' '));
		}
		return $string;
	}
	
	public function convertIntToFormatMoney($str){
		$strm =  number_format($str);
		$arrC = array(',');
		$arrB = array('.');
		$strm = str_replace($arrC, $arrB, $strm);
		return $strm;
	}
	
	public function convertFormatMoneyToInt($str){
		$arrC = array('.');
		$arrB = array('');
		$strm = str_replace($arrC, $arrB, $str);
		return $strm;
	}
	
	public function showDate(){
		$VN['Mon'] = 'Thứ hai';
		$VN['Tue'] = 'Thứ ba';
		$VN['Wed'] = 'Thứ tư';
		$VN['Thu'] = 'Thứ năm';
		$VN['Fri'] = 'Thứ sáu';
		$VN['Sat'] = 'Thứ bảy';
		$VN['Sun'] = 'Chủ nhật';
		$VN[1] = 'Tháng 1';
		$VN[2] = 'Tháng 2';
		$VN[3] = 'Tháng 3';
		$VN[4] = 'Tháng 4';
		$VN[5] = 'Tháng 5';
		$VN[6] = 'Tháng 6';
		$VN[7] = 'Tháng 7';
		$VN[8] = 'Tháng 8';
		$VN[9] = 'Tháng 9';
		$VN[10] = 'Tháng 10';
		$VN[11] = 'Tháng 11';
		$VN[12] = 'Tháng 12';
		return $VN[date('D')].', '.date('d').' '.$VN[date('n')].' '.date('Y');
	}
}
?>