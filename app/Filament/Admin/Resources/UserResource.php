<?php

namespace App\Filament\Admin\Resources;

use PDF;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\User;
use App\Models\Section;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Support\Enums\Alignment;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-m-user';

    protected static ?int $navigationSort = 1;

    /*
    |--------------------------------------------------------------------------
    |  Resource navigation group
    |--------------------------------------------------------------------------
    */

    public static function getNavigationGroup(): string
    {
        return __('user.users');
    }

    /*
    |--------------------------------------------------------------------------
    |  Show user only (not admin or staff)
    |--------------------------------------------------------------------------
    */

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'user');
    }

    /*
    |--------------------------------------------------------------------------
    |  Resource labels translation
    |--------------------------------------------------------------------------
    */

    public static function getModelLabel(): string
    {
        return __('user.user');
    }

    public static function getPluralModelLabel(): string
    {
        return __('user.users');
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
                ->label(__('user.name'))
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->label(__('user.email'))
                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),
            TextInput::make('password')
                ->label(__('user.password'))
                ->password()
                ->revealable()
                ->maxLength(255)
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create')
                ->helperText(function (string $context) {
                    if ($context === 'create') {
                        return '';
                    } else {
                        return __('user.leave_password_blank');
                    }
                }),
            DateTimePicker::make('email_verified_at')
                ->label(__('user.email_verified_at'))
                ->default(now()),
            Toggle::make('is_admin')
                ->label(__('user.is_admin'))
                ->required()
                ->inline(true)
                ->live()
                ->helperText(__('user.is_admin_description')),
            Toggle::make('is_active')
                ->label(__('user.active'))
                ->required()
                ->inline(true)
                ->default(true)
                ->helperText(__('user.active_description')),
            Select::make('type')
                ->label( __('user.user_type') )
                ->options([
                    'admin' => __('user.admin').' : '.__('user.admin_note'),
                    'staff' => __('user.staff').' : '.__('user.staff_note'),
                    'user' => __('user.normal_user').' : '.__('user.user_note'),
                ])
                ->searchable()
                ->preload()
                ->visible(fn (Get $get): bool => !$get('is_admin')),
            Select::make('roles')
                ->relationship('roles', 'name')
                ->multiple()
                ->preload()
                ->searchable()
        ])->columns(2);
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
                TextColumn::make('id')
                    ->label(__('user.id')),
                TextColumn::make('name')
                    ->label(__('user.name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label(__('user.email'))
                    ->sortable()
                    ->searchable(),

                ToggleColumn::make('is_admin')
                    ->label(__('user.is_admin'))
                    ->sortable()
                    ->hidden(fn(): bool => ! auth()->user()->is_admin),

                ToggleColumn::make('is_active')
                    ->label(__('user.active')),

                TextColumn::make('created_at')
                    ->label(__('user.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('user.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                ColumnGroup::make( __('ticket.status'), [
                    TextColumn::make('open_tickets_count')
                        ->counts(['open_tickets'])
                        ->label(__('ticket.open'))
                        ->alignment(Alignment::Center),
                    TextColumn::make('processing_tickets_count')
                        ->counts(['processing_tickets'])
                        ->label(__('ticket.processing'))
                        ->alignment(Alignment::Center),
                    TextColumn::make('closed_tickets_count')
                        ->counts(['closed_tickets'])
                        ->label(__('ticket.closed'))
                        ->alignment(Alignment::Center),
                ])
                ->alignment(Alignment::Center)
                ->wrapHeader(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_admin')
                    ->label(__('user.is_admin'))
                    ->hidden(fn(): bool => ! auth()->user()->is_admin),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label(__('user.active')),
                Tables\Filters\SelectFilter::make('section_id')
                    ->label(__('user.section'))
                    ->options(Section::all()->pluck('name', 'id')),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),//->visible(auth()->user()->is_admin),
                Tables\Actions\DeleteAction::make(),//->visible(auth()->user()->is_admin),
                Tables\Actions\Action::make('pdf') 
                ->label('PDF')
                ->color('success')
                ->icon('heroicon-m-arrow-down-tray')
                ->action(function (User $record) {
                    return response()->streamDownload(function () use ($record) {
                        echo PDF::loadHtml(
                            Blade::render('reports.user-report', ['record' => $record])
                        )->stream();
                    }, 'user-'.$record->id . '.pdf');
                }), 
            ])
            ->headerActions([
                // ...
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(auth()->user()->is_admin),
                ]),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Resource pages settings
    |--------------------------------------------------------------------------
    */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
