<?php

namespace App\Filament\Admin\Resources;

use PDF;
use Illuminate\Support\Facades\Blade;
use App\Filament\Admin\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Support\Enums\Alignment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-m-rectangle-stack';

    protected static ?int $navigationSort = 1;

    /*
    |--------------------------------------------------------------------------
    |  Resource labels translation
    |--------------------------------------------------------------------------
    */

    public static function getModelLabel(): string
    {
        return __('category.category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('category.categories');
    }

    /*
    |--------------------------------------------------------------------------
    |  Resource form settings
    |--------------------------------------------------------------------------
    */

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('category.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->label(__('category.position'))
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('active')
                    ->label(__('category.active'))
                    ->required()
                    ->inline(false),
                Forms\Components\TextInput::make('description')
                    ->label(__('category.description'))
                    ->maxLength(400)
                    ->columnSpanFull(),
            ])->columns(3);
    }

    /*
    |--------------------------------------------------------------------------
    |  Resource table settings
    |--------------------------------------------------------------------------
    */

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('category.name'))
                    ->searchable(),
                Tables\Columns\ColumnGroup::make( __('category.ticket_status'), [
                    Tables\Columns\TextColumn::make('open_tickets_count')
                        ->counts(['open_tickets'])
                        ->label(__('category.open'))
                        ->alignment(Alignment::Center),
                    Tables\Columns\TextColumn::make('processing_tickets_count')
                        ->counts(['processing_tickets'])
                        ->label(__('category.processing'))
                        ->alignment(Alignment::Center),
                    Tables\Columns\TextColumn::make('closed_tickets_count')
                        ->counts(['closed_tickets'])
                        ->label(__('category.closed'))
                        ->alignment(Alignment::Center),
                ])
                ->alignment(Alignment::Center)
                ->wrapHeader(),

                Tables\Columns\ToggleColumn::make('active')->label(__('category.active')),
            ])
            ->defaultSort('position', 'aesc')
            ->reorderable('position')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('pdf') 
                ->label('PDF')
                ->color('success')
                ->icon('heroicon-m-arrow-down-tray')
                ->action(function (Category $record) {
                    return response()->streamDownload(function () use ($record) {
                        echo PDF::loadHtml(
                            Blade::render('reports.category-report', ['record' => $record])
                        )->stream();
                    }, 'category-'.$record->id . '.pdf');
                }),
            ])
            ->headerActions([])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->striped();
    }

    /*
    |--------------------------------------------------------------------------
    |  Resource pages settings
    |--------------------------------------------------------------------------
    */

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCategories::route('/'),
        ];
    }

}
