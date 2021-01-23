<?php

namespace Tests\Unit\Services;

use App\Constants\UniverzalnaPretraga\IzdavanjeIliProdajaVrednost;
use App\Constants\UniverzalnaPretraga\UniverzalnaPretragaPolje ;
use App\DomainModels\UniverzalnaPretraga ;
use App\Services\UniverzalnaPretragaService;
use PHPUnit\Framework\TestCase;


class UniverzalnaPretragaServiceTest extends TestCase
{
    /** @test */
    public function primaUniverzalnuPretraguUKonstruktoru()
    {
        $univerzalnaPretragaService = $this->getUniverzalnaPretragaService();
        $this->assertInstanceOf(UniverzalnaPretragaService::class,$univerzalnaPretragaService);
    }

    /** @test */
    public function getHaloOglasiUrlVracaHaloOglasiUrl()
    {
        $univerzalnaPretragaService = $this->getUniverzalnaPretragaService();
        $haloOglasiUrl = $univerzalnaPretragaService->getHaloOglasiUrl();
        $this->assertTrue(strpos($haloOglasiUrl, 'https://www.halooglasi.com/nekretnine')>=0);
    }

    /** @test */
    public function akoJeOdabranoIzdavanjeHaloOglasiUrlImaToUUrlu()
    {
        $univerzalnaPretragaService = $this->getUniverzalnaPretragaServiceWithData([
            UniverzalnaPretragaPolje::IZDAVANJE_ILI_PRETRAGA => IzdavanjeIliProdajaVrednost::IZDAVANJE
        ]);
        $haloOglasiUrl = $univerzalnaPretragaService->getHaloOglasiUrl();
        $this->assertTrue(strpos($haloOglasiUrl, 'https://www.halooglasi.com/nekretnine/izdavanje')!== false);
    }

    /** @test */
    public function akoJeOdabranoProdajaHaloOglasiUrlImaToUUrlu()
    {
        $univerzalnaPretragaService = $this->getUniverzalnaPretragaServiceWithData([
            UniverzalnaPretragaPolje::IZDAVANJE_ILI_PRETRAGA => IzdavanjeIliProdajaVrednost::PRODAJA
        ]);
        $haloOglasiUrl = $univerzalnaPretragaService->getHaloOglasiUrl();
        $this->assertTrue(strpos($haloOglasiUrl, 'https://www.halooglasi.com/nekretnine/prodaja')!== false);
    }

    private function getUniverzalnaPretragaService(){
        $univerzalnaPretraga = new UniverzalnaPretraga([]);
        return new UniverzalnaPretragaService($univerzalnaPretraga);
    }

    private function getUniverzalnaPretragaServiceWithData($arrayData){
        $univerzalnaPretraga = new UniverzalnaPretraga(array_merge([],$arrayData));
        return new UniverzalnaPretragaService($univerzalnaPretraga);
    }
}
