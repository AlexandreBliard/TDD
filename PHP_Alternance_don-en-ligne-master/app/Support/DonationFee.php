<?php

namespace App\Support;


class DonationFee
{

    private $donation;
    private $commissionPercentage;

    public function __construct(int $donation, int $commissionPercentage)
    {
        if ($commissionPercentage < 0 || $commissionPercentage > 30) {
            throw new \Exception("commission fail");
        }
        if ($donation < 100) {
            throw new \Exception("donations fail");
        }
        $this->commissionPercentage = $commissionPercentage;
        $this->donation = $donation;
    }

    public function getCommissionAmount()
    {
        return $this->donation/$this->commissionPercentage;
    }

    public function getAmountCollected() {
        return $this->donation - $this->getCommissionAmount();
    }

    public function exceptionPercentageCommission($commissionPercentage) {
        if($commissionPercentage >= 0 && $commissionPercentage <= 30) {
            throw new \Exception("commission fail");
        }
    }

    public function exceptionIntegarDonations($donations) {

    }
}

/*public function testExceptionDonationIsNull()
    {
        $this->expectException('Exception');
        $donationFees = new \App\Support\DonationFee(0,10);
    }*/