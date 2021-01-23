<?php

namespace App\Services;

use App\Constants\UniverzalnaPretraga\IzdavanjeIliProdajaVrednost;
use App\Constants\UniverzalnaPretraga\UniverzalnaPretragaPolje;
use App\DomainModels\UniverzalnaPretraga;
use Illuminate\Support\ServiceProvider;

class UniverzalnaPretragaService
{
    /** @var UniverzalnaPretraga */
    private $_univerzalnaPretraga;

    public function __construct(UniverzalnaPretraga $univerzalnaPretraga){
        $this->_univerzalnaPretraga = $univerzalnaPretraga;
    }

    public function getHaloOglasiUrl(){

        if ($this->_univerzalnaPretraga[UniverzalnaPretragaPolje::IZDAVANJE_ILI_PRETRAGA]
            == IzdavanjeIliProdajaVrednost::IZDAVANJE)
            return "https://www.halooglasi.com/nekretnine/izdavanje";
        else
            return "https://www.halooglasi.com/nekretnine/prodaja";
    }
}
