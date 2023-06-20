<?php

namespace App\Filament\Resources;

use App\Enums\AccomodationType;
use App\Enums\RoomTypePrice;
use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Scopes\RoomScope;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label(Lang::get('room.name_room'))->columnSpanFull(),
                Forms\Components\TextInput::make('number_place')
                    ->label(Lang::get('room.number_place'))
                    ->numeric()
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('max_person')
                            ->label(Lang::get('room.max_person'))
                            ->numeric(),
                        Forms\Components\TextInput::make('number_bed')
                            ->label(Lang::get('room.number_bed'))
                            ->numeric(),
                    ]),
                Grid::make(2)
                    ->schema([
                        Forms\Components\Select::make('accomodation_type')
                            ->label(Lang::get('room.accomodation_type'))
                            ->options(AccomodationType::toSelect())
                            ->disablePlaceholderSelection()
                            ->default(AccomodationType::ROOM->value),
                        Forms\Components\Select::make('accomodation_type_price')
                            ->label(Lang::get('room.accomodation_type_price'))
                            ->options(RoomTypePrice::toSelect())
                            ->disablePlaceholderSelection()
                            ->default(RoomTypePrice::PER_PERSON->value)
                    ]),
                Forms\Components\Textarea::make('description')
                    ->label(Lang::get('form.description'))
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('available_date_from')
                    ->label(Lang::get('form.available_from'))
                    ->displayFormat('Y-m-d')
                    ->columnSpanFull()
                    ->helperText(Lang::get('room.helper_text_date'))
                    ->hint(Lang::get('room.hint_text_date_from'))
                    ->nullable(),
                Forms\Components\DatePicker::make('available_date_to')
                    ->label(Lang::get('form.available_to'))
                    ->displayFormat('Y-m-d')
                    ->columnSpanFull()
                    ->hint(Lang::get('room.hint_text_date_to'))
                    ->helperText(Lang::get('room.helper_text_date'))
                    ->nullable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label(Lang::get('form.name')),
                Tables\Columns\TextColumn::make('number_place')
                ->label(Lang::get('form.number'))
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {

        return parent::getEloquentQuery()
            ->where('hotel_id', Auth::user()->active_hotel)
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
                RoomScope::class
            ]);
    }

    public static function getNavigationLabel(): string
    {
        return Lang::get('room.base');
    }

    public static function getBreadcrumb(): string
    {
        return Lang::get('room.base');
    }
}
