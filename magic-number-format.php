<?php
function magic_number_format($number) {
	$pos = strpos($number, '.');
	$pos = ( ! $pos ) ? strpos($number, ',') : $pos;

	if( $pos ) {
		$count = strlen($number) - $pos - 1;
		$last = substr($number, -$count);
		$split = str_split($last);
		$split = array_reverse($split);

		$break = false;

		foreach( $split as $char ) {
			if( $char == 0 && $break == false ) {
				$count--;
			}

			if( $char != 0 ) {
				$break = true;
			}
		}

		$first = number_format( substr($number, 0, $pos ), 0, '', '.' );
		$last = substr($number, $pos + 1, $count);
		$result = $first . ',' . $last;

		$result = ( ! is_numeric( substr($result, -1) ) ) ? substr($result, 0, -1) : $result;
		
		return $result . "\n";
	}
	return number_format( $number, 0, '', '.' ) . "\n";
}

echo magic_number_format('25');
echo magic_number_format('123.32');
echo magic_number_format('12312.3233');
echo magic_number_format('12.0100000');
echo magic_number_format('1231,00');
echo magic_number_format('1231,10');
echo magic_number_format('1,1');