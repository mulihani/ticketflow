<?php

namespace App\Filament\Admin\Resources;

use PDF;
use Illuminate\Support\Facades\Blade;
use App\Filament\Admin\Resources\SectionResource\Pages;
use App\Models\Section;
use Filament\Support\Enums\Alignment;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColumnGroup;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    /*
    |--------------------------------------------------------------------------
    |  Resource labels translation
    |--------------------------------------------------------------------------
    */

    public static function getModelLabel(): string
    {
        return __('section.section');
    }

    public static function getPluralModelLabel(): string
    {
        return __('section.sections');
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
                TextInput::make('name')
                    ->label(__('section.name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('position')
                    ->label(__('section.position'))
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('active')
                    ->label(__('section.active'))
                    ->required()
                    ->inline(false),
                TextInput::make('description')
                    ->label(__('section.description'))
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
                TextColumn::make('name')
                    ->label(__('section.name'))
                    ->searchable(),
                ColumnGroup::make( __('section.ticket_status'), [

                    TextColumn::make('open_tickets_count')
                        ->counts(['open_tickets'])
                        ->label(__('section.open'))
                        ->alignment(Alignment::Center),
                    TextColumn::make('processing_tickets_count')
                        ->counts(['processing_tickets'])
                        ->label(__('section.processing'))
                        ->alignment(Alignment::Center),
                    TextColumn::make('closed_tickets_count')
                        ->counts(['closed_tickets'])
                        ->label(__('section.closed'))
                        ->alignment(Alignment::Center),
                ])
                ->alignment(Alignment::Center)
                ->wrapHeader(),
                Tables\Columns\ToggleColumn::make('active')->label(__('section.active')),
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
                ->action(function (Section $record) {
                    return response()->streamDownload(function () use ($record) {
                        echo Pdf::loadHtml(
                            Blade::render('reports.section-report', ['record' => $record])
                        )->stream();
                    }, 'section-'.$record->id . '.pdf');
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
            'index' => Pages\ManageSections::route('/'),
        ];
    }
}
