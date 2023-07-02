<?php

namespace App\Filament\Resources\ReservationResource\RelationManagers;

use App\Filament\Resources\ReservationResource;
use App\Models\Room;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Lang;

class RoomRelationManager extends RelationManager
{
    protected static string $relationship = 'room';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function getTitle(): string
    {
        return Lang::get('room.title_list');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number_place')
                    ->label(Lang::get('room.room_number_place')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                Action::make('room')->label(Lang::get('room.manage_room'))->url(fn($livewire) => ReservationResource::getUrl('room', ['record' => $livewire->ownerRecord->id]))
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

}
