<?php

namespace App\Entity\Enum;

enum ArticleTypeEnum: string
{
    case Generic = 'generic';
    case Tip = 'tip';
    case Recipee = 'recipee';
}