<?php

namespace App\Filament\Resources;

use App\Enums\RolesType;
use App\Filament\Resources\HotelResource\Pages;
use App\Filament\Resources\HotelResource\RelationManagers;
use App\Models\Hotel;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static bool $shouldRegisterNavigation = true;

    public function mount(): void
    {
        if(!in_array(Auth::user()->roles, [RolesType::CLIENT, RolesType::ADMINISTRATOR])){
            Notification::make()->title(Lang::get('hotel.error_change_active_hotel'))->danger()->send();
            Redirect::route('filament.pages.dashboard');
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label(Lang::get('hotel.name_hotel'))->columnSpanFull(),
                Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('nip')
                            ->label('NIP')
                            ->numeric()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('regon')
                            ->label('REGON')
                            ->numeric()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('krs')
                            ->label('KRS')
                            ->numeric()
                            ->maxLength(10),
                        ]),
                Forms\Components\TextInput::make('address')
                ->label(Lang::get('form.address'))->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('postal_code')
                        ->label(Lang::get('form.postal_code')),
                        Forms\Components\TextInput::make('city')
                            ->label(Lang::get('form.city')),
                        ]),
                Forms\Components\TextInput::make('country')
                    ->label(Lang::get('form.country'))->columnSpanFull(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->label(Lang::get('form.phone'))->columnSpanFull(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label(Lang::get('form.email'))->columnSpanFull(),

//                Forms\Components\KeyValue::make('name')
//                    ->label('name')
//                    ->keyLabel('Language')->keyPlaceholder('pl')
//                    ->valueLabel('Translation')->valuePlaceholder()
//                    ->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(Lang::get('hotel.base')),
                Tables\Columns\TextColumn::make('address')->label(Lang::get('hotel.address')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('change_to_this_hotel')
                    ->label(Lang::get('hotel.change_to_this_hotel'))
                    ->action(function (Hotel $record){
                        if(!empty($record->id)){
                            Auth::user()->update([
                                'active_hotel' => $record->id
                            ]);
                            Notification::make()->title(Lang::get('hotel.success_change_active_hotel'))->success()->send();
                            Redirect::route('filament.pages.dashboard');
                        }else{
                            Notification::make()->title(Lang::get('hotel.error_change_active_hotel'))->danger()->send();
                        }
                    }),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationLabel(): string
    {
        return Lang::get('hotel.base');
    }

    public static function getBreadcrumb(): string
    {
        return Lang::get('hotel.base');
    }
}
