<?php

namespace App\Support;


class DonationFee
{

    private $donation;
    private $commissionPercentage;
    const FIXEDFEE = 50;

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

    public function getFixedAndCommissionFeeAmount() {
        if ($this->getCommissionAmount() + self::FIXEDFEE > 500) {
            return 500;
        }else{
            return $this->getCommissionAmount() + self::FIXEDFEE;
        }
    }

    public function getSummary() {
        return
            $summary[] = [
                'donations' => $this->donation,
                'fixedFee' => self::FIXEDFEE,
                'commission' => $this->getCommissionAmount(),
                'fixedAndCommission' =>$this->getFixedAndCommissionFeeAmount(),
                'amountCollected' =>$this->getAmountCollected()
            ]
        ;
    }

}

/*public function testExceptionDonationIsNull()
    {
        $this->expectException('Exception');
        $donationFees = new \App\Support\DonationFee(0,10);
    }*/