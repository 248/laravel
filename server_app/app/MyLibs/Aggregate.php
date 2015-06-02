<?php namespace App\MyLibs;


class Aggregate
{
	private $data = array();
	public function get(){
		return $this->data;
	}

	private $header = array(
		"PCB_ID",
		"STORE_ID",
		"REGION_NAME",
		"PLACE_NAME",
		);

	private $status = array();

	private $csv = array();
	private $foming = array();
	private $fileName = "";
	private $dayCnt = 0;

	private $storeList = array();

	// function __construct($fileName)
	// {
	// 	if (file_exists($fileName)) {
	// 		$this->fileName = $fileName;
	// 		$this->csv = \Csv::read($fileName);
	// 	}
	// }
	
	public function setCsv($fileName)
	{
		if (file_exists($fileName)) {
			$this->fileName = $fileName;
			$this->csv = \Csv::read($fileName);
		}
		return $this;
	}

	public function foming()
	{
		if(empty($this->csv))
			return $this;

		$tmp = explode("_", $this->fileName);
		$year = substr($tmp[1], 0, 4);
		$month = substr($tmp[1], 4, 2);

		$header = $this->csv[0];
		$start = 4;
		$end = count($header) - 2;
		$this->dayCnt = $end - $start;

		$csv = $this->csv;

		unset($csv[0]);

		foreach ($csv as $key => $value) 
		{
			$count = array();
			for ($i=$start; $i < $end; $i++) { 
				$count[] = (int)$value[$i];
			}
			$this->status[$value[1]] = array(
				"pcb_id" => $value[0],
				"store_id" => $value[1],
				"region" => $value[2],
				"name" => $value[3],
				);
			$this->foming[$year][$month][$value[1]] = $count;

			if(in_array($value[1],$this->storeList))
				continue;

			$this->storeList[] = $value[1];
		}

		return $this;
	}

	public function create($start, $end)
	{
		$weekList = $this->createWeek($start, $end);
		$this->header = array_merge($this->header,$weekList);
		array_push($this->header, "AVG");
		array_push($this->header, "TOTAL");
		array_push($this->data,$this->header);

		$storeData = $this->createStoreData($start, $end);
		//dd($storeData);
		// 全店舗合計作る
		array_push($this->data,$this->createSumData(count($weekList), $storeData));
		foreach ($storeData as $storeId => $value) 
		{
			$sum = array_sum($value);
			$avg = round($sum/count($value), 2);
			array_push($value, $avg);
			array_push($value, $sum);
			$tmp = array_merge($this->status[$storeId],$value);
			array_push($this->data,$tmp);
		}
// dd($this->data);
		return $this;
	}

	private function createSumData($cnt, $storeData)
	{
		$data = array(
			"999999999999",
			"NARERUNDA",
			"日本",
			"全店舗合計",
			);

		$sumData = array();
		for ($i=0; $i < $cnt; $i++) 
		{ 
			$sum = 0;
			foreach ($storeData as $key => $value) 
			{
				$sum += $value[$i];
			}
			$sumData[] = $sum;
		}

		$sum = array_sum($sumData);
		$avg = round($sum/count($sumData), 2);
		array_push($sumData, $avg);
		array_push($sumData, $sum);
		$data = array_merge($data,$sumData);

		return $data;
	}

	private function createStoreData($start, $end)
	{
		$storeData = array();
		foreach ($this->foming as $year => $monthly) 
		{
			foreach ($monthly as $month => $store) 
			{
				list($min, $max) = $this->search($year.$month, $start, $end);

				foreach ($store as $storeId => $daily) {
					$dayCount = 0;
					foreach ($daily as $day => $cnt) 
					{
						// 配列と日付を合わせる
						$day++;
						if($min <= $day && $day <= $max)
						{
							$storeData[$storeId][] = $cnt;
							$dayCount++;
						}
					}
				}

				// 抜けてる店舗を穴埋め
				$storeDiff = array_diff($this->storeList, array_keys($store));
				foreach ($storeDiff as $storeId) {
					for ($i=0; $i < $dayCount; $i++) { 
						$storeData[$storeId][] = 0;
					}
				}
			}
		}

		return $storeData;
	}

	private function createWeek($start, $end)
	{
		$end = date("Y/m/d", strtotime($end." +1 day"  ));
		$period = new \DatePeriod(
			new \DateTime($start),
			new \DateInterval('P1D'),
			new \DateTime($end)
			);

		$list = array();
		$week_str_list = array( 'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT');
		foreach ($period as $day) {
			$list[] = $week_str_list[ $day->format('w') ]."-".$day->format('d');
			// array_push($this->data[0], $day);
		}

		return $list;
	}

	private function search($date, $start, $end)
	{
		// $tmp = explode("_", $this->fileName);
		// $tmp = explode(".", $tmp[1]);
		// $date = $tmp[0];
		// echo $date;

		$tmp = explode("-", $start);
		$startDate = $tmp[0].$tmp[1];
		$startDay = (integer)$tmp[2];

		$tmp = explode("-", $end);
		$endDate = $tmp[0].$tmp[1];
		$endDay = (integer)$tmp[2];

		if($date == $startDate && $date == $endDate)
		{
			$min = $startDay;
			$max = $endDay;
		}
		else if($startDate < $date && $date < $endDate)
		{
			$min = 1;
			$max = $this->dayCnt;
		}
		else if($date == $startDate)
		{
			$min = $startDay;
			$max = $this->dayCnt;
		}
		else if($date == $endDate)
		{
			$min = 1;
			$max = $endDay;
		}

		return array((int)$min, (int)$max);
	}

}