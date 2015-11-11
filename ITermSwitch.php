<?php
//switch term from id to string or string to id
//For AD HOC
// Fall:	SEP-DEC;	Winter: JAN;	Spring:	FEB-MAY;	Summer: JUN-AUG

	function termSwitch($term){
		switch($term){
			//from term id to string
			case '1158':
				return 'Fall 2015';
			case '1161':
				return 'Winter 2016';
			case '1164':
				return 'Spring 2016';
			case '1166':
				return 'Summer 2016';
			case '1168':
				return 'Fall 2016';

			//from term string to id
			case 'Fall 2015':
				return '1158';
			case 'Winter 2016':
				return '1161';
			case 'Spring 2016':
				return '1164';
			case 'Summer 2016':
				return '1166';
			case 'Fall 2016':
				return '1168';
				
			//from month to term
			case '1':
				return 'Winter';
			case '2':
			case '3':
			case '4':
			case '5':
				return 'Spring';
			case '6':
			case '7':
			case '8':
				return 'Summer';
			case '9':
			case '10':
			case '11':
			case '12':
				return 'Fall';
			
			//if not found, no such term return false
			default:
				return false;
		}
	}
?>