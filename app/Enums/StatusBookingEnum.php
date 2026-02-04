<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusBookingEnum: string implements HasLabel, HasColor
{
    case WAITING_PAYMENT = 'waiting_payment';
    case WAITING_VERIFICATION = 'waiting_verification';
    case CONFIRMED = 'confirmed';
    case REJECTED = 'rejected';
    case EXPIRED = 'expired';
    case COMPLETED = 'completed';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::WAITING_PAYMENT => 'Menunggu Pembayaran',
            self::WAITING_VERIFICATION => 'Menunggu Verifikasi',
            self::CONFIRMED => 'Terverifikasi',
            self::REJECTED => 'Ditolak',
            self::EXPIRED => 'Kadaluarsa',
            self::COMPLETED => 'Selesai',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::WAITING_PAYMENT, self::WAITING_VERIFICATION => 'warning',
            self::CONFIRMED => 'info',
            self::COMPLETED => 'success',
            self::REJECTED, self::EXPIRED => 'danger',
        };
    }
}
