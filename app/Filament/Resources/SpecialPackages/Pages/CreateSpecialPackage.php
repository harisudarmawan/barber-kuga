<?php

namespace App\Filament\Resources\SpecialPackages\Pages;

use App\Filament\Resources\SpecialPackages\SpecialPackageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSpecialPackage extends CreateRecord
{
    protected static string $resource = SpecialPackageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
