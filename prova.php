<?php
$arr = array();

$arr[0] = 56;
$arr[1] = 57;
$arr[2] = 58;
$arr[3] = 59;
$arr[4] = 60;
$arr[5] = 61;
 
    // This is the same as $arr[13] = 56;
                // at this point of the script

//$arr["x"] = 42; // This adds a new element to
                // the array with key "x"
                
unset($arr[5]); // This removes the element from the array
echo maxPr($arr);
//var_dump($arr);
function maxPr($array)
{
	$i=1;
	$max=$array[0];
	$index=0;
	while($i < count($array)){
		if($array[$i] > $max){
				$max=$array[$i];
				$index=$i;
			}
		$i=$i+1;
	}
	return $index;
}
//unset($arr);    // This deletes the whole array
?>