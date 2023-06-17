<?php

namespace App\Filament\Pages;

use App\Api\OpenAiApi;
use App\Enums\OpenAiModel;
use App\Helpers\TokenHelper;
use App\Models\ProductDescription;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;

class AcceptDescription extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.accept-description';

    public ?ProductDescription $description = null;

    public function mount()
    {
        $this->getNextDescription();
    }

    public function getNextDescription()
    {
        $this->description = ProductDescription::where('user_id', Auth::user()->id)
            ->where('accepted', 0)
//            ->where('result', '<>', null)
            ->first();
    }

    protected function getActions(): array
    {
        return [
            Action::make('edit-description')
                ->label(Lang::get('product_description.edit_description'))
                ->mountUsing(fn (ComponentContainer $form) => $form->fill([
                    'edit-description' => $this->description->result
                ]))
                ->action(function (array $data){
                    $this->description->result = $data['edit-description'];
                    $this->description->save();
                })
                ->form(([
                    RichEditor::make('edit-description')
                        ->label(Lang::get('product_description.edit_description'))
                        ->disableToolbarButtons([
                            'attachFiles',
                        ])
                        ->required()
                ]))
        ];
    }

    public function acceptDescription()
    {
        if ($this->description) {
            $this->description->update(['accepted' => 1]);
            $this->getNextDescription();
        }
    }

    public function acceptDescriptionAndSend()
    {
        if ($this->description) {
            //$this->description->update(['accepted' => 1]);
        }

        $data = [
            'product_id' => $this->description->product_id,
            'description' => $this->description->result
            ];

        try{
            $response = Http::get(Auth::user()->webhook, $data);

            Notification::make()
                ->title(Lang::get('notifications.success_export_data'))
                ->success()
                ->send();
        }catch (\Exception $exception){
            dd($exception);
            Notification::make()
                ->title(Lang::get('notifications.export_description_error'))
                ->danger()
                ->send();
        }


    }

    public function generateNewDescription()
    {
        $openAiClient = new OpenAiApi();
        $result = $openAiClient->generateResult($this->description->generated_prompt, OpenAiModel::CHAT_GPT_3);
        TokenHelper::saveInformationAboutDescription($this->description, $result['tokenUsage']);

        Notification::make()
            ->title(Lang::get('notifications.success_generated_description'))
            ->success()
            ->send();

        if ($this->description) {
            $this->description->result =  $result['response'];
            $this->description->update(['result' => $result['response']]);
        }
    }

    public function getTitle(): string
    {
        return Lang::get('basic.accept_description');
    }

    public static function getNavigationLabel(): string
    {
        return Lang::get('basic.accept_description');
    }
}
