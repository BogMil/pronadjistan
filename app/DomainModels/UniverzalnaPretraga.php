<?php

namespace App\DomainModels;

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

public function __construct($dataArray){
    $this->brojSobaDo = $dataArray['brojSobaDo'] ?? "";
    $this->brojSobaOd = $dataArray['brojSobaOd'] ?? "";
    $this->cekiraneOpstineObj = $dataArray['cekiraneOpstineObj'] ?? "";
    $this->cenaDo = $dataArray['cenaDo'] ?? "";
    $this->cenaOd = $dataArray['cenaOd'] ?? "";
    $this->grad = $dataArray['grad'] ?? "";
    $this->izdavanjeIliProdaja = $dataArray['izdavanjeIliProdaja'] ?? "";
    $this->kvadraturaDo = $dataArray['kvadraturaDo'] ?? "";
    $this->kvadraturaOd = $dataArray['kvadraturaOd'] ?? "";
    $this->spratDo = $dataArray['spratDo'] ?? "";
    $this->spratOd = $dataArray['spratOd'] ?? "";
    $this->tipNekretnine = $dataArray['tipNekretnine'] ?? "";
}

// public function haloOglasi() {
//     $ulrEncodedComma = '%2C';
//     //'https://www.halooglasi.com/nekretnine/izdavanje-stanova?grad_id_l-lokacija_id_l-mikrolokacija_id_l=40783%2C52155&cena_d_from=20&cena_d_unit=4'
//     $baseUrl = 'https://www.halooglasi.com';
//     $tipUsluge = $this->izdavanjeIliProdaja ==TipUsluge::$Izdavanje ? 'izdavanje-stanova': 'prodaja-stanova';
//     // $idLokacija = $this->grad+$ulrEncodedComma;
//     $gradObj =array_filter(GradController::$GRADOVI, function($grad){
//         return $grad['id'] == $this->grad;
//     }, ARRAY_FILTER_USE_BOTH );

//     dd($gradObj['opstine']);
// }
}
