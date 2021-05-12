<?php
abstract class MethodDefination{
	abstract public function calculateITAmount($grossAmount);
}

trait Logic{
	function calculateITAMountLogic($grossAmount)
	{
		if($grossAmount<=400000)
			return 0;
		$getTaxCharge = array(
	                    array(
	                        'amount_range_from' => 0,
	                        'amount_range_to' => 150000,
	                        'tax_percentage' => 0,
	                         ),
	                    array(
	                        'amount_range_from' => 150001,
	                        'amount_range_to' => 300000,
	                        'tax_percentage' => 2.5,
	                         ),
	                    array(
	                        'amount_range_from' => 300001,
	                        'amount_range_to' => 800000,
	                        'tax_percentage' =>10,
	                         ),
	                    array(
	                        'amount_range_from' => 800001,
	                        'amount_range_to' => 10000000,
	                        'tax_percentage' =>25,
	                         ),
	                    array(
	                        'amount_range_from' => 10000001,
	                        'amount_range_to' => 100000000000,
	                        'tax_percentage' =>30,
	                         )

	                );
		$calculateTaxOnAmount = $grossAmount;
	    $remainingAmount      = $calculateTaxOnAmount;
	    $amount               = $calculateTaxOnAmount;
	    $arrayAmount          = array();
	    foreach ($getTaxCharge as $key => $value) {
	        $resultArray = array();
	        if ($calculateTaxOnAmount > $value['amount_range_to']) {
	            $sum                       = $value['amount_range_to'] - $value['amount_range_from'];
	            $resultArray['amount']     = $sum;
	            $resultArray['percentage'] = $value['tax_percentage'];
	            array_push($arrayAmount, $resultArray);
	            $remainingAmount = $remainingAmount - $sum;
	        } else {
	            $resultArray['amount']     = $remainingAmount;
	            $resultArray['percentage'] = $value['tax_percentage'];
	            array_push($arrayAmount, $resultArray);
	            break;
	        }
	    }
	    $resultantTaxAmount = 0;
	    foreach ($arrayAmount as $key => $value) {
	        $cal                = (($value['amount'] * $value['percentage']) / 100);
	        $resultantTaxAmount = $resultantTaxAmount + $cal;
	    }
	    return floor($resultantTaxAmount);
	}
}
class ITCalculator extends MethodDefination{
	use Logic;
	function calculateITAmount($grossAmount)
	{
		return $this->calculateITAMountLogic($grossAmount);
	}
}
?>