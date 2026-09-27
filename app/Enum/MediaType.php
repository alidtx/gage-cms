<?php

namespace App\Enum;

use App\Enum\Attributes\Description;
use App\Enum\Attributes\EnumAttributes;

enum MediaType: string
{
    use EnumAttributes;

    case IMAGE = 'image';
    #[Description('PDF')]
    case PDF = 'pdf';
    case DOCUMENT = 'document';
    case OTHERS = 'others';
}
