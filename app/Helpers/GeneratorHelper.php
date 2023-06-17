<?php

namespace App\Helpers;

use App\Enums\GeneratorStatus;
use App\Models\ProductDescription;

class GeneratorHelper
{
    public const HTML_PROMPT = '
        Do opisu dodaj formatowanie html takie jak pogrubienia, akapity, kursywy, nagłówki itd. Stwórz opis atrakcyjny wizualnie. Ma być to gotowy opis z formatowaniem html do wklejenia na strone.
        ###
        Prosze bardzo o pogrubienie wiele najważniejszych informacji.

        ###
        Opis:';

    public static function changeStatus(ProductDescription $productDescription, GeneratorStatus $generatorStatus){
        $productDescription->generated = $generatorStatus->value;
        $productDescription->save();
    }

}
