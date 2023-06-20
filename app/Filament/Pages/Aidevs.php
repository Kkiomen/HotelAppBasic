<?php

namespace App\Filament\Pages;

use App\Api\OpenAiApi;
use App\Enums\RolesType;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Aidevs extends Page  implements HasForms
{
    use InteractsWithForms;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.aidevs';

    public function mount(): void
    {
        $this->form->fill();
    }

    const API_KEY = '6982ce64-7d13-4d2e-a23a-ba07ba2c8f45';
    public $task;
    public $taskName = '';
    public $answer;
    public $requestUrl = '';
    public $responseToken = [];
    public $answerResponse = [];
    public $responseTotal = [];


    protected function getFormSchema(): array
    {
        return [
            TextInput::make('task')->required(),
            MarkdownEditor::make('answer'),
        ];
    }
    //e0b0b7fdda855fec793b5aac1698fe492a960b36
    private function getTaskToken(): ?string
    {
        $payload = [
            'apikey' => self::API_KEY,
        ];
        $this->requestUrl = "https://zadania.aidevs.pl/token/".$this->task;
        $response = Http::post($this->requestUrl, $payload)->json();
        $this->responseToken = $response;
        return $response['token'] ?? null;
    }

    public function getTask(){
        $taskToken = $this->getTaskToken();
        if(!is_null($taskToken)){
            $response = Http::get("https://zadania.aidevs.pl/task/".$taskToken)->json();
            $this->taskName = $response['msg'];
            $this->answerResponse = $response;
        }
    }

    public function submit(): void
    {

        $payload = [
            'answer' => [
                'Pierwotnie pizza była chlebem płaskim, której korzenie sięgają starożytnych cywilizacji Mezopotamii i Egiptu. Jednak dopiero Włosi wprowadzili pizzę do dzisiejszej formy, którą znamy i kochamy. Pierwsze wzmianki o pizzy w dzisiejszym wydaniu pojawiły się w Neapolu, gdzie została przygotowana w latach 1700. Z czasem pizzerie zaczęły powstawać w całych Włoszech, a w 1889 roku królowa Margherita dała początek słynnej pizzy Margherita, nazwanej na jej cześć.',
                'Przygotowanie pizzy w domu wymaga kilku podstawowych składników, w tym mąki, drożdży, wody, soli, sosu pomidorowego i sera mozzarella. Jednak z czasem pizzę można modyfikować, dodając różne składniki, takie jak warzywa, owoce morza, mięso, oliwki i inne.
',
                'Początkujący w przygotowywaniu pizzy muszą nauczyć się kilku podstawowych kroków. Przede wszystkim należy przygotować ciasto, które wymaga mąki, wody, soli i drożdży. Ciasto należy wyrabiać przez kilka minut, a następnie pozostawić do wyrośnięcia.

Gdy ciasto wyrośnie, należy je rozwałkować na okrągłą formę, a następnie posmarować sosem pomidorowym. Na to należy położyć ulubione składniki, takie jak mięso, warzywa, owoce morza, ser i inne.',
                'Gdy pizzę przygotuje się na blasze, należy ją wstawić do nagrzanego piekarnika, ustawiając temperaturę na około 230-250 stopni Celsjusza. Pizzę należy piec przez około 10-15 minut, aż ciasto się zarumieni, a ser się roztopi.'

            ],
        ];
        $this->requestUrl = "https://zadania.aidevs.pl/answer/".$this->responseToken['token'];
        $this->responseTotal = Http::post($this->requestUrl, $payload)->json();
    }

    // ==============
    public function taskModeration(){
        $client = new OpenAiApi();
        $l = $client->moderation('dfgdfgdfg');
        dd($l);
        /*
        $resultTask = $this->answerResponse;
        $input = $resultTask['input'];
        $result = '[';
        foreach ($input as $text){
            $flag = ($client->moderation($text)) ? 1 : 0;
            $result .= $flag.',';
        }
        $result = substr($result, 0, strlen($result) - 1);
        $result .= ']';
        return $result;*/
    }

}
