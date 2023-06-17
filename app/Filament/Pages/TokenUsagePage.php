<?php

namespace App\Filament\Pages;

use App\Models\TokenUsage;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Illuminate\Support\Facades\Lang;

class TokenUsagePage extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-server';

    protected static string $view = 'filament.pages.token-usage-page';

    protected static ?string $slug = 'token-usage';

    public function getTitle(): string
    {
        return Lang::get('token_usage.usage_token');
    }

    public static function getNavigationLabel(): string
    {
        return Lang::get('token_usage.usage_token');
    }

    protected function getTableQuery(): Builder
    {
        return TokenUsage::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('product_description_id')->label(Lang::get('token_usage.product_description_id')),
            Tables\Columns\TextColumn::make('prompt_tokens')->label(Lang::get('token_usage.prompt_tokens')),
            Tables\Columns\TextColumn::make('completion_tokens')->label(Lang::get('token_usage.completion_tokens')),
            Tables\Columns\TextColumn::make('total_tokens')->label(Lang::get('token_usage.total_tokens')),
            Tables\Columns\TextColumn::make('estimated_cost')->label(Lang::get('token_usage.estimated_cost')),
            ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return true;
    }

}
