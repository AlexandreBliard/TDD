<?php

namespace App\Support;


class DonationFee
{

    private $donation;
    private $commissionPercentage;

    public function __construct(int $donation, int $commissionPercentage)
    {
        $this->donation = $donation;
        $this->commissionPercentage = $commissionPercentage;
    }

    public function getCommissionAmount(int $donation, int $commissionPercentage)
    {
        return $donation/$commissionPercentage;
    }

    public function getAmountCollected(int $donation, int $commissionPercentage) {
        return $donation -
            $this->getCommissionAmount($donation, $commissionPercentage);
    }

    public function exceptionPercentageCommission() {

    }
}