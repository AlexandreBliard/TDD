<?php

namespace Tests\Unit;

use App\Support\DonationFee;
use http\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DonationFeeTest extends TestCase
{

    public function testGetCommissionAmount() {
        //cette fonction doit vérifier le montant de la comission de 10%
        //donc si actual = montant / commission de 10%
        $DonationFee = new DonationFee(200, 10);
        $this->assertSame(20,
            $DonationFee->getCommissionAmount() );
    }

    public function testGetAmountCollected() {
        /*cette fonction doit soustraire la donation au
        résultat de testGetCommissionAmount()
        actual = donation - testGetCommissionAmount()
        */
        $DonationFee = new DonationFee(200, 10);
        $this->assertSame(180,
            $DonationFee->getAmountCollected());
    }

    public function testExceptionDonationIsNull() {
        $this->expectException('Exception');
        $this->expectExceptionMessage('donations fail');
        $donationFees = new \App\Support\DonationFee(0,10);
    }

    public function testExceptionCommissionIsMoreThan30() {
        $this->expectException('Exception');
        $this->expectExceptionMessage('commission fail');
        $donationFees = new \App\Support\DonationFee(200,31);
    }


}
