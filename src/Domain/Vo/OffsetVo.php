<?php
declare(strict_types=1);

namespace Runtuer\Domain\Vo;

class OffsetVo
{
    public $x;
    public $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

}
