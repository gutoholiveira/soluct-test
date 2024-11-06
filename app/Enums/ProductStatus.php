<?php

namespace App\Enums;

use App\Traits\IsEnum;

enum ProductStatus: string
{
    use IsEnum;

    case DRAFT     = 'draft';
    case TRASH     = 'trash';
    case PUBLISHED = 'published';
}
