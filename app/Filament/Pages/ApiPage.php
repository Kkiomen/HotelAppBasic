<?php

namespace App\Filament\Pages;

use App\Api\OpenAiApi;
use App\Enums\DataSource;
use App\Enums\OpenAiModel;
use App\Models\ProductDescription;
use App\Models\User;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ApiPage extends Page
{
    protected static ?string $navigationIcon = 'tabler-api';
    protected static ?string $navigationLabel = 'API';
    protected static ?string $slug = 'manage-api';

    protected static string $view = 'filament.pages.api-page';

    private OpenAiApi $openAiClient;
    protected $listeners = ['deleteToken'];

    public $tokens = [];

    public function mount(){
         $this->tokens = Auth::user()->tokens;
         $this->openAiClient = new OpenAiApi();
    }


    public function getTitle(): string
    {
        return Lang::get('basic.api_title');
    }

    protected function getActions(): array
    {
        return [
            Action::make('settings')
                ->label(Lang::get('basic.generate_api'))
                ->action('generateToken'),
            Action::make('webhook')
                ->label(Lang::get('product_description.webhook'))
                ->mountUsing(fn (ComponentContainer $form) => $form->fill([
                    'webhook' => Auth::user()->webhook
                ]))
            ->action(function (array $data){
                $user = Auth::user();
                $user->webhook = $data['webhook'];
                $user->save();
            })
            ->form(([
                TextInput::make('webhook')
                    ->label(Lang::get('product_description.webhook'))
                    ->required()
            ]))
        ];
    }

    public function generateToken(): void
    {
        Auth::user()->createToken($this->getRandomTokenValue());
        $this->mount();

        Notification::make()
            ->title(Lang::get('notifications.success_generate_token'))
            ->success()
            ->send();
    }

    public function deleteNotification($id){

            Notification::make()
                ->title(Lang::get('notifications.sure_delete'))
                ->warning()
                ->duration(5000)
                ->actions([
                    \Filament\Notifications\Actions\Action::make('deleteToken')
                        ->label(Lang::get('basic.click_to_delete'))
                        ->emit('deleteToken', [$id])
                        ->close(),
                ])
                ->send();

    }

    public function deleteToken($id){
        if(Auth::user()->tokens()->where('id', $id)->delete()){
            $this->mount();
            Notification::make()
                ->title(Lang::get('notifications.success_delete'))
                ->success()
                ->send();
        }else{
            Notification::make()
                ->title(Lang::get('notifications.danger_delete'))
                ->danger()
                ->send();
        }
    }


    /**
     * Generate random token value
     * @return string
     */
    private function getRandomTokenValue(): string
    {
        return time().Auth::user()->id;
    }

}
