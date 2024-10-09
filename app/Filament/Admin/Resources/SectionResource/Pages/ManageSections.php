<?php

namespace App\Filament\Admin\Resources\SectionResource\Pages;

use App\Filament\Admin\Resources\SectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSections extends ManageRecords
{
    protected static string $resource = SectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('sectionspdf') 
                ->label('PDF')
                ->color('success')
                ->icon('heroicon-m-arrow-down-tray')
                ->url(route('generatePdf','sections')),
        ];
    }
}
