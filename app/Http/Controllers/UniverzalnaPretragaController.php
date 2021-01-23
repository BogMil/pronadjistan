<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class UniverzalnaPretragaController extends Controller
{
    public function getCreateForm()
    {
        return Inertia::render('Pretraga/Create');
    }

    public function create(Request $request)
    {
        return response(200);
        $univerzalnaPretraga = new UniverzalnaPretraga($request->all());
        //save
        dd($univerzalnaPretraga->haloOglasi());
    }
}

class TipUsluge{
    public static  $Izdavanje = 'izdavanje';
    public static  $Prodaja = 'prodaja';
}

class UniverzalnaPretraga{

    public $brojSobaDo;
    public $brojSobaOd;
    public $cekiraneOpstineObj;
    public $cenaDo;
    public $cenaOd;
    public $grad;
    public $izdavanjeIliProdaja;
    public $kvadraturaDo;
    public $kvadraturaOd;
    public $spratDo;
    public $spratOd;
    public $tipNekretnine;

    public function __construct($requestData){
        $this->brojSobaDo = $requestData['brojSobaDo'];
        $this->brojSobaOd = $requestData['brojSobaOd'];
        $this->cekiraneOpstineObj = $requestData['cekiraneOpstineObj'];
        $this->cenaDo = $requestData['cenaDo'];
        $this->cenaOd = $requestData['cenaOd'];
        $this->grad = $requestData['grad'];
        $this->izdavanjeIliProdaja = $requestData['izdavanjeIliProdaja'];
        $this->kvadraturaDo = $requestData['kvadraturaDo'];
        $this->kvadraturaOd = $requestData['kvadraturaOd'];
        $this->spratDo = $requestData['spratDo'];
        $this->spratOd = $requestData['spratOd'];
        $this->tipNekretnine = $requestData['tipNekretnine'];
    }

    public function haloOglasi() {
        $ulrEncodedComma = '%2C';
        //'https://www.halooglasi.com/nekretnine/izdavanje-stanova?grad_id_l-lokacija_id_l-mikrolokacija_id_l=40783%2C52155&cena_d_from=20&cena_d_unit=4'
        $baseUrl = 'https://www.halooglasi.com';
        $tipUsluge = $this->izdavanjeIliProdaja ==TipUsluge::$Izdavanje ? 'izdavanje-stanova': 'prodaja-stanova';
        // $idLokacija = $this->grad+$ulrEncodedComma;
        $gradObj =array_filter(GradController::$GRADOVI, function($grad){
            return $grad['id'] == $this->grad;
        }, ARRAY_FILTER_USE_BOTH );

        dd($gradObj['opstine']);
    }
}
