<?php

declare(strict_types=1);

function sanitizeData(string $value): string
{
    return htmlspecialchars(stripslashes(trim($value)));
}
