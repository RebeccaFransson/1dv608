<?php
namespace view;
class DateTimeView {

	public function show() {
		//hämta från modell skriv ut här
		date_default_timezone_set('Europe/Stockholm');

		$day= date("l");
		$dayNr = date("j");
		$dayNr .= date("S");
		$month = date("F");
		$year = date("Y");
		$time = date("H:i:s");

		$timeString = "$day, the $dayNr of $month $year, The time is $time";

		return '<p>' . $timeString . '</p>';
	}
}
