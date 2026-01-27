<?php

namespace App\Enums;

enum PaymentMethods: string
{
    case BCA = 'bca';

    case MANDIRI = 'mandiri';

    case BNI = 'bni';

    case DANA = 'dana';

    case QRIS = 'qris';

    case BRI = 'bri';
}
