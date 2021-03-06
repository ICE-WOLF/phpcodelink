<?php

	function codelink_pass($program,$dataname,$data){
		// $result = 'no executable found';

	

		// return json_decode($result);//return $result
		$result = '';
		
		//get current working directory
		$loc=getcwd();//shell_exec("echo \$PWD");

		//$PWD returns extra space at end, this removes it
		//$loca = substr($loc, 0, -1);

		//adds relative location of jsons to create absolute path
		$loc = $loc."/jsons/";

		//get current microsecond of each second and converts it to integer
		$micro = microtime()*1000000;

		//gets time in seconds and append micro seconds for higher precision
		$time = time(). "" .$micro;

		//create variables for file names
		$inFileName = $time."-".$dataname."-input.json";
		$outFileName = $time."-".$dataname."-output.json";

		//open file, write data, close file
		$myfile = fopen($loc.$inFileName, "w");
		fwrite($myfile,json_encode($data));
		fclose($myfile);
		$myfile = fopen($loc.$outFileName, "w");
		fwrite($myfile," ");
		fclose($myfile);
		

		shell_exec($program.' '.$inFileName.' '.$outFileName);
		$result = file_get_contents($loc.$outFileName);

		unlink("./jsons/".$outFileName);
		#var_dump(json_decode($result,true));

		return $result;
		
	}

	//echo 'compiled<br>';

	//codelink_pass("ls",array(1,2,3,4));

?>