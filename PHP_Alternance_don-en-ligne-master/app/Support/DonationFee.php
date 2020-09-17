<?php

namespace App\Support;


class DonationFee
{

    private $donation;
    private $commissionPercentage;
    private const FIXEDFEE = 50;

    public function __construct(int $donation, int $commissionPercentage)
    {
        $this->donation = $donation;
        $this->commissionPercentage = $commissionPercentage;
    }

    public function getCommissionAmount(int $donation, int $commissionPercentage)
    {
        return $donation/$commissionPercentage + self::FIXEDFEE;
    }

    public function getAmountCollected(int $donation, int $commissionPercentage) {
        return $donation -
            $this->getCommissionAmount($donation, $commissionPercentage);
    }

    public function exceptionPercentageCommission($donation) {
        if($donation >= 0 && $donation <= 30) {
            throw new \Exception("commission fail");
        }
    }

    public function exceptionIntegarDonations($donations) {
        $limit = 100;
        if ($limit < $donations) {
            throw new \Exception("donations fail");
        }
    }

}