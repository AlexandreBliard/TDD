<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class DonationFeeTest extends TestCase
{

    public function testGetCommissionAmount() {
        //cette fonction doit vérifier le montant de la comission de 10%
        //donc si actual = montant / commission de 10%
        $donation = 200;
        $commissionPercentage = 10;
        $this->assertSame(20, $donation/$commissionPercentage,
            '%site');
        return $donation/$commissionPercentage;
    }

    /**
     * @depends testGetCommissionAmount
     * @param $sitePercentage
     *
     */
    public function testGetAmountCollected($sitePercentage) {
        /*cette fonction doit soustraire la donation au
        résultat de testGetCommissionAmount()
        actual = donation - testGetCommissionAmount()
        */
        $donations = 200;
        $this->assertSame(20, $sitePercentage, 'sitePercentage fail');
        $this->assertSame(180,
            $donations - $sitePercentage,
            'argent projet fail');
    }


}
