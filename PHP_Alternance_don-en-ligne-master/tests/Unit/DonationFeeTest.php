<?php

namespace Tests\Unit;

use App\Support\DonationFee;
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
        /*ce test doit soustraire la donation au
        résultat de testGetCommissionAmount()
        actual = donation - testGetCommissionAmount()
        */
        $DonationFee = new DonationFee(200, 10);
        $this->assertSame(180,
            $DonationFee->getAmountCollected());
    }

    public function testExceptionDonationIsUnder100() {
        /*ce test vérifie si l'exception est levé ou non,
        dans ce cas on vérifie que le montant
        n'est pas inférieur à 99 */
        $this->expectException('Exception');
        $this->expectExceptionMessage('donations fail');
        $donationFees = new \App\Support\DonationFee(99,10);
    }

    public function testExceptionCommissionIsMoreThan30() {
        $this->expectException('Exception');
        $this->expectExceptionMessage('commission fail');
        $donationFees = new \App\Support\DonationFee(200,31);
    }

    public function testGetFixedAndCommissionFeeAmount() {
        /*on contrôle le fais que les 0,50€ obligatoires se rajoutent
        sur les frais de commissions du site*/
        $DonationFee = new DonationFee(200, 10);
        $fraisFixe = 50;
        $expected = (200 / 10) + $fraisFixe;
        $this->assertSame($expected,
            $DonationFee->getFixedAndCommissionFeeAmount());
    }

    public function testGetFixedAndCommissionFeeAmountLimit() {
        /*on test si le résultat est supérieur à 501 dans le calcul de
        la fonction, si c'est le cas il doit retourner obligatoirement
        juste 500 car ce chiffre est le maximum attendu*/
        $DonationFee = new DonationFee(500000, 10);
        $this->assertSame(500,
        $DonationFee->getFixedAndCommissionFeeAmount());
    }

    public function testGetSummary() {
        /*on créer un tableau associatif dans
        lequel on pousse toutes les donnes
        on vérifie que ces données sont remplis
        car les résultats on été vérifiés avant*/
        $DonationFee = new DonationFee(200, 10);
        $summary = $DonationFee->getSummary();
        //test si c'est un tableau
        $this->assertIsArray($summary);
        //test si les clés sont là
        $this->assertArrayHasKey('donations',
            $summary);
        $this->assertArrayHasKey('fixedFee',
            $summary);
        $this->assertArrayHasKey('commission',
            $summary);
        $this->assertArrayHasKey('fixedAndCommission',
            $summary);
        $this->assertArrayHasKey('amountCollected',
            $summary);

    }
}
