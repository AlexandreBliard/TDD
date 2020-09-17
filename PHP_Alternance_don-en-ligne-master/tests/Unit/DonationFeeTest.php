<?php

namespace Tests\Unit;

use phpDocumentor\Reflection\Types\Boolean;
use PHPUnit\Framework\TestCase;

class DonationFeeTest extends TestCase
{
    /**
     * @dataProvider getCommissionProvider
     *
     * @param int $donations
     * @param int $commissionPercentage
     * @param int $commissionAmount
     */

    public function testGetCommissionAmount (int $donations, int $commissionPercentage,
                                             int $commissionAmount) {
        $this->assertGreaterThanOrEqual(100, $donations);
        $this->assertEquals($commissionAmount, $donations/$commissionPercentage);
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

    public function testPercentageCommissionSite() {
        /*doit vérifier que pourcentage commission
        est compris entre 0 et 30*/
        $percentageCommission = mt_rand(0, 30);
        //$percentageCommission = 45;
        $this->assertGreaterThanOrEqual(0,
            $percentageCommission, 'GT fail');
        $this->assertLessThanOrEqual(30,
        $percentageCommission, 'LT fail');
    }

    public function testIntegarDonations() {
        /*ce test doit vérifier que la
        donations est supérieur ou égale à 100*/
        $donations = 400;
        $limite = 100;
        $this->assertGreaterThanOrEqual($limite,
        $donations, '+GT fail');
    }

    public function getCommissionProvider() {
        /*doit retourner des valeurs de tests
        $donations - $commissionPercentage - $commissionAmount
        - $projectAmount - expected - */
        return array(
            array(200, 10, 20),
            array(99, 10, 20),//$donations <100
            array(200, -5, 20),//$commissionPercentage <0
            array(200, 30, 20),//$commissionPercentage >30
            array(200, 10, 25),//$commissionAmount result false
            array(200, 10, 20)//
        );
    }

}
