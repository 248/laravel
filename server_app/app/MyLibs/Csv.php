<?php namespace App\MyLibs;


class Csv
{
	private $typeName = array(
		1 => "sales",
		2 => "royalty",
		);

	// あまりここに置きたくないメソッドだけど…
	public function getFileList($type, $startdate, $enddate)
	{
		$startDateTmp = explode("-", $startdate);
		$endDateTmp = explode("-", $enddate);

		$fileList = array();
		for($year = intval($startDateTmp[0]); $year <= intval($endDateTmp[0]); $year++)
		{
			// 年をまたぐ
			// 1年マタギしか考えない
			if($startDateTmp[0] < $endDateTmp[0] && $year == intval($startDateTmp[0]))
			{
				$start = intval($startDateTmp[1]);
				$end = 12;
			}
			else if($startDateTmp[0] < $endDateTmp[0] && $year == intval($endDateTmp[0]))
			{
				$start = 1;
				$end = intval($endDateTmp[1]);
			}
			// 年をまたがない場合 
			else 
			{
				$start = intval($startDateTmp[1]);
				$end = intval($endDateTmp[1]);
			}

			$fileListTmp = $this->createFileName($type, $year, $start, $end);
			$fileList = array_merge($fileList,  $fileListTmp);
		}

		return $fileList;
	}

	private function createFileName($type, $year, $start, $end)
	{
		$list = array();
		for($month = $start; $month <=  $end; $month++)
		{
			$list[] = $this->typeName[$type]."_".$year.sprintf("%02d",$month).".csv";
		}
		return $list;
	}

	public function read($fileName)
	{
		if (($handle = fopen($fileName, "r")) !== false) {
			while (($line = fgetcsv($handle, 1000, ",")) !== false) {
				$records[] = $line; 
			} 
			fclose($handle); 
		}
		return $records;
	}


}