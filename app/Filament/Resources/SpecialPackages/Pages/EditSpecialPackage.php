<?php

namespace App\Filament\Resources\SpecialPackages\Pages;

use App\Filament\Resources\SpecialPackages\SpecialPackageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSpecialPackage extends EditRecord
{
    protected static string $resource = SpecialPackageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
