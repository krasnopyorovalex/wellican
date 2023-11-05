<?php

declare(strict_types=1);

namespace Domain\Entities\Page\Enums;

enum Template: string
{
    case INDEX = 'index';
    case CONTACTS = 'contacts';
    case PAGE = 'info';
}
