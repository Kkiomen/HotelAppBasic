<?php

namespace App\Http\Controllers;

use App\Api\OpenAiApi;
use App\Models\Hotel;
use App\Models\HotelUser;
use App\Models\ProductDescription;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(OpenAiApi $openAiApi){

        $prod = ProductDescription::where('id', 32)->first();

        $hotel = Hotel::where('id', 1)->first();

        dump(Hotel::inRandomOrder()->first());

        $system = 'Stwórz opis produktu do sklepu internetowego. Ma być on długi i zachęcający do kupna';
        $produkt = 'Stwórz atrakcyjny i przekonujący opis dla przedmiotu smartfon o nazwie Xiaomi XYZ z kategorii Elektronika, który w pełni oddaje wartość produktu i skupia się na jego korzyściach, aby zachęcić klientów do zakupu, a jednocześnie zoptymalizowany pod kątem SEO.  Ten produkt posiada następujące atrybuty: producent: Xiaomi, liczba_wątków: 8, rozmiar: 6.5 cali, kolor: czarny i jest idealny dla Mężczyzn Wyróżniające się cechy produktu to: smartfon, ekran, aparat Słowa kluczowe dla SEO: . Upewnij się, że te słowa kluczowe są umiejętnie wplecione w treść opisu, aby zwiększyć widoczność w wyszukiwarkach. Opis powinien być napisany w stylu i tonie: formalny, inspirujący, który będzie angażujący i budzący zaufanie. Weź pod uwagę ewentualne ograniczenia:  Nieodporny na wodę ale skup się na pozytywnych aspektach. Stworzony jest z materiału:  metal, szkło .Warto również podkreślić gwarancję: 2 lata .Warto również podkreślić unikalne cechy, które wyróżniają ten produkt na rynku: ładowanie bezprzewodowe, ultraszybki czytnik linii papilarnych .Jeśli istnieje już wstępny opis produktu, uwzględnij go w ostatecznym opisie: Nowoczesny smartfon Xiaomi XYZ z dużym ekranem, wydajnym procesorem i znakomitym aparatem.';
//        dd($openAiApi->completionChat($produkt, $system));

        return view('pages.index');
    }
}
