<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductDescriptionResource\Pages;
use App\Filament\Resources\ProductDescriptionResource\RelationManagers;
use App\Models\ProductDescription;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Lang;

class ProductDescriptionResource extends Resource
{
    protected static ?string $model = ProductDescription::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('product_id')
                    ->label(Lang::get('product_description.product_id'))
                    ->helperText(Lang::get('product_description.product_id_helper')),
                Forms\Components\TextInput::make('imageUrl')->label(Lang::get('product_description.imageUrl'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('subject')->label(Lang::get('product_description.subject'))
                    ->maxLength(255)
                    ->columnSpan('full')
                    ->required(),
                Forms\Components\TextInput::make('product_name')->label(Lang::get('product_description.product_name'))
                    ->maxLength(255)
                    ->columnSpan('full')
                    ->required(),
                Forms\Components\TextInput::make('category')->label(Lang::get('product_description.category'))
                    ->maxLength(255)
                    ->columnSpan('full')
                    ->required(),
                Forms\Components\KeyValue::make('attributes')->label(Lang::get('product_description.attributes'))
                    ->keyLabel(Lang::get('product_description.attribute_key'))
                    ->valueLabel(Lang::get('product_description.value'))
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('target_audience')->label(Lang::get('product_description.target_audience')),
                Forms\Components\TagsInput::make('keywords')->label(Lang::get('product_description.keywords')),
                Forms\Components\TagsInput::make('keywords_seo')->label(Lang::get('product_description.keywords_seo')),
                Forms\Components\TagsInput::make('style_and_tone')->label(Lang::get('product_description.style_and_tone')),
                Forms\Components\TagsInput::make('limitations')->label(Lang::get('product_description.limitations')),
                Forms\Components\TagsInput::make('material')->label(Lang::get('product_description.material')),
                Forms\Components\TextInput::make('warranty')->label(Lang::get('product_description.warranty'))
                    ->maxLength(255),
                Forms\Components\TagsInput::make('unique_features')->label(Lang::get('product_description.unique_features')),
                Forms\Components\Textarea::make('description')->label(Lang::get('product_description.description'))
                    ->maxLength(65535)
                    ->columnSpan('full'),
                Forms\Components\Textarea::make('result')->label(Lang::get('product_description.result'))
                    ->maxLength(65535)
                    ->columnSpan('full'),
                Forms\Components\Toggle::make('accepted')
                    ->label(Lang::get('product_description.accepted'))
                    ->columnSpan('full'),
                Forms\Components\Toggle::make('use_html')->label(Lang::get('product_description.use_html'))
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_name')->label(Lang::get('product_description.product_name')),
                Tables\Columns\TextColumn::make('subject')->label(Lang::get('product_description.subject')),
                Tables\Columns\TextColumn::make('category')->label(Lang::get('product_description.category')),
                Tables\Columns\BadgeColumn::make('generated')
                    ->enum([
                        0 => Lang::get('product_description.to_generate'),
                        2 => Lang::get('product_description.generate'),
                        1 => Lang::get('product_description.generated_description'),
                    ])
                    ->color(static function ($state): string {
                        if ($state === 0) {
                            return 'primary';
                        } elseif ($state === 2) {
                            return 'secondary';
                        } elseif ($state === 1) {
                            return 'success';
                        }
                        return 'secondary';
                    })->label(Lang::get('product_description.generated')),
                Tables\Columns\TextColumn::make('created_at')->label(Lang::get('product_description.created_at'))
                    ->dateTime('d-m-y H:i'),
                Tables\Columns\TextColumn::make('updated_at')->label(Lang::get('product_description.updated_at'))
                    ->dateTime('d-m-y H:i'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProductDescriptions::route('/'),
            'create' => Pages\CreateProductDescription::route('/create'),
            'view' => Pages\ViewProductDescription::route('/{record}'),
            'edit' => Pages\EditProductDescription::route('/{record}/edit'),
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
        return Lang::get('product_description.navigation');
    }

    public static function getBreadcrumb(): string
    {
        return Lang::get('product_description.navigation');
    }

    public static function getNavigationGroup(): ?string
    {
        return Lang::get('basic.services');
    }
}
