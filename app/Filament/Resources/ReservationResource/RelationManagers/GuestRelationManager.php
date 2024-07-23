<?php

namespace App\Filament\Resources\ReservationResource\RelationManagers;

use App\Models\ReservationUser;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Contracts\HasRelationshipTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Lang;

class GuestRelationManager extends RelationManager
{
    protected static string $relationship = 'guest';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->label(Lang::get('guest.name')),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->label(Lang::get('form.email')),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->columnSpanFull()
                    ->maxLength(255)
                    ->label(Lang::get('form.password')),
                Forms\Components\TextInput::make('phone')
                    ->label(Lang::get('form.phone'))
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('address')
                    ->label(Lang::get('form.address')),
                Forms\Components\TextInput::make('city')
                    ->label(Lang::get('form.city')),
                Forms\Components\TextInput::make('country')
                    ->label(Lang::get('form.country')),
                Forms\Components\TextInput::make('postal_code')
                    ->label(Lang::get('form.postal_code')),
                Forms\Components\TextInput::make('balance_wallet')
                    ->numeric()
                    ->maxValue(99999)
                    ->label(Lang::get('guest.balance_wallet'))
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('wallet_limit')
                    ->numeric()
                    ->maxValue(99999)
                    ->label(Lang::get('guest.wallet_limit'))
                    ->helperText(Lang::get('guest.wallet_limit_description'))
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('wallet_hard_limit')
                    ->numeric()
                    ->maxValue(99999)
                    ->label(Lang::get('guest.wallet_hard_limit'))
                    ->helperText(Lang::get('guest.wallet_hard_limit_description'))
                    ->columnSpanFull(),
            ]);
    }

    public static function getTitle(): string
    {
        return Lang::get('guest.guests');
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(Lang::get('guest.name'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('main_guest')
                    ->boolean()
                    ->label(Lang::get('guest.main_guest')),
                Tables\Columns\TextColumn::make('balance_wallet')
                    ->label(Lang::get('guest.balance_wallet')),
                Tables\Columns\TextColumn::make('phone')
                    ->label(Lang::get('form.phone'))
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->using(function (HasRelationshipTable $livewire, array $data): Model {
                    $data['password'] = bcrypt($data['password']);
                    $model = $livewire->getRelationship()->create($data);
                    $reservationUser = ReservationUser::where('reservation_id', $livewire->getOwnerRecord()->id)->where('user_id', $model->id)->first();

                    $reservationUser->update([
                        'main_guest' => ReservationUser::where('reservation_id', $livewire->getOwnerRecord()->id)->count() == 1,
                        'balance_wallet' => $data['balance_wallet'],
                        'wallet_limit' => $data['wallet_limit'],
                        'wallet_hard_limit' => $data['wallet_hard_limit']
                    ]);
                    return $model;
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make()->using(function (Model $record, array $data, $livewire): Model {
                    if (isset($data['password']) && $data['password'] != '') {
                        $data['password'] = bcrypt($data['password']);
                    } else {
                        unset($data['password']);
                    }
                    $record->update($data);
                    dump(ReservationUser::where('deleted+a')->where('reservation_id', $livewire->getOwnerRecord()->id)->count());
                    $reservationUser = ReservationUser::where('reservation_id', $livewire->getOwnerRecord()->id)->where('user_id', $record->id)->first();
                    $reservationUser->update([
                        'main_guest' => ReservationUser::where('reservation_id', $livewire->getOwnerRecord()->id)->count() == 1,
                        'balance_wallet' => $data['balance_wallet'],
                        'wallet_limit' => $data['wallet_limit'],
                        'wallet_hard_limit' => $data['wallet_hard_limit']
                    ]);

                    return $record;
                }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
