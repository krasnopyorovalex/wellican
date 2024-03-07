<?php

declare(strict_types=1);

namespace App\Domain\Entities\Filter\Enums;

enum Template: string
{
    case LineCheckboxes = 'line_checkboxes';
    case SelectCheckboxes = 'select_checkboxes';
    case FromTo = 'from_to';
}
