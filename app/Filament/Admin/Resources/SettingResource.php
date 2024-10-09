<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-m-cog-8-tooth';

    protected static ?int $navigationSort = 3;

    protected static bool $shouldRegisterNavigation = false;

    /*
    |--------------------------------------------------------------------------
    |  Resource labels translation
    |--------------------------------------------------------------------------
    */

    public static function getModelLabel(): string
    {
        return __('setting.system_settings');
    }

    public static function getPluralModelLabel(): string
    {
        return __('setting.settings');
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
                Section::make(__('setting.system_settings'))
                ->schema([
                    TextInput::make('site_name')
                        ->label(__('setting.site_name'))
                        ->required()
                        ->maxLength(255)
                        ->prefixIcon('heroicon-m-globe-alt')
                        ->prefixIconColor('')
                        ->default('Ticket Flow'),
                    TextInput::make('site_email')
                        ->label(__('setting.site_email'))
                        ->email()
                        ->prefixIcon('heroicon-m-envelope')
                        ->prefixIconColor('')
                        ->maxLength(255),
                    TextInput::make('it_support_number')
                        ->label(__('setting.it_support_number'))
                        ->prefixIcon('heroicon-m-phone')
                        ->prefixIconColor('')
                        ->tel()
                        ->maxLength(255),

                    Fieldset::make(__('setting.site_closed_days'))
                        ->schema([
                            Select::make('closed_days')
                            ->label(__('setting.closed_days'))
                            ->multiple()
                            ->options([
                                'Sunday' => __('setting.sunday'),
                                'Monday' => __('setting.monday'),
                                'Tuesday' => __('setting.tuesday'),
                                'Wednesday' => __('setting.wednesday'),
                                'Thursday' => __('setting.thursday'),
                                'Friday' => __('setting.friday'),
                                'Saturday' => __('setting.saturday'),
                            ])
                            ->helperText(__('setting.site_closed_days_description')),
                        ])->columns(1),

                    Fieldset::make(__('setting.site_activation_hours'))
                        ->schema([
                            Toggle::make('site_activation_hours')
                                ->label(__('setting.on_off_activation_hours'))
                                ->required()
                                ->helperText(__('setting.site_activation_description'))
                                ->columnSpanFull()
                                ->live(),
                            Select::make('timezone')
                                ->label(__('setting.timezone'))
                                ->required()
                                ->options(getTimezoneSelectOptions())
                                ->prefixIcon('heroicon-o-globe-alt')
                                ->hidden(fn (Get $get): bool => ! $get('site_activation_hours')),
                            TimePicker::make('site_activation_starts_at')
                                ->label(__('setting.site_activation_starts_at'))
                                ->required()
                                ->hint(__('setting.site_start_at'))
                                ->prefix(__('setting.open'))
                                ->prefixIcon('heroicon-m-clock')
                                ->seconds(false)
                                ->native(false)
                                ->hidden(fn (Get $get): bool => ! $get('site_activation_hours')),
                            TimePicker::make('site_activation_ends_at')
                                ->label(__('setting.site_activation_ends_at'))
                                ->required()
                                ->hint(__('setting.site_end_at'))
                                ->prefix(__('setting.close'))
                                ->prefixIcon('heroicon-m-clock')
                                ->seconds(false)
                                ->native(false)
                                ->hidden(fn (Get $get): bool => ! $get('site_activation_hours')),

                            RichEditor::make('site_activation_hours_massage')
                                ->label(__('setting.site_activation_massage'))
                                    ->hint(__('setting.activation_massage_helper'))
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'bold',
                                        'bulletList',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'orderedList',
                                        'underline',
                                    ])
                                    ->hidden(fn (Get $get): bool => ! $get('site_activation_hours')),
                        ])->columns(3),

                    Fieldset::make(__('setting.on_off_settings'))
                        ->schema([
                            Toggle::make('site_status')
                                ->label(__('setting.site_status'))
                                ->required()
                                ->helperText(__('setting.on_off_site')),

                            Toggle::make('ticket_monitor_status')
                                ->label(__('setting.ticket_monitor_status'))
                                ->required()
                                ->helperText(__('setting.ticket_monitor_description')),

                            Toggle::make('signup_status')
                                ->label(__('setting.signup_status'))
                                ->required()
                                ->helperText(__('setting.signup_status_description')),
                            Toggle::make('users_only_status')
                                ->label(__('setting.users_only_status'))
                                ->required()
                                ->helperText(__('setting.users_only_status_description')),
                            Toggle::make('ticket_search_status')
                                ->label(__('setting.ticket_search_status'))
                                ->required()
                                ->helperText(__('setting.ticket_search_status_helper')),
                            Toggle::make('support_info_page_status')
                                ->label(__('setting.support_info_page_status'))
                                ->required()
                                ->helperText(__('setting.support_info_page_helper')),
                        ])->columns(2),

                    RichEditor::make('site_close_massage')
                        ->label(__('setting.site_close_massage'))
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold',
                                'bulletList',
                                'h2',
                                'h3',
                                'italic',
                                'orderedList',
                                'underline',
                            ]),
                    RichEditor::make('support_info_page')
                        ->hint(__('setting.support_info_page_hint'))
                        ->label(__('setting.support_information'))
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('images/attachments')
                        ->columnSpanFull(),

                ])->columns(3)
            ]);
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
                TextColumn::make('site_name')
                    ->searchable()
                    ->label(__('setting.site_name')),
                TextColumn::make('site_email')
                    ->searchable()
                    ->label(__('setting.email')),
                TextColumn::make('it_support_number')
                    ->searchable()
                    ->label(__('setting.support_number')),
                ToggleColumn::make('site_status')
                    ->label(__('setting.site_status')),
                ToggleColumn::make('support_info_page_status')
                    ->label(__('setting.support_info_page')),
                ToggleColumn::make('ticket_search_status')
                    ->label(__('setting.ticket_search')),
                ToggleColumn::make('site_activation_hours')
                    ->label(__('setting.activation_hours')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSettings::route('/'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }

}
