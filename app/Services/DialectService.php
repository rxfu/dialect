<?php

namespace App\Services;

use App\Dialect;

class DialectService
{
    private $dialect;

    public function __construct(Dialect $dialect)
    {
        $this->dialect = $dialect;
    }

    public function getAllByPage($zone, $type, $limit)
    {
        $dialects = $this->dialect;

        if ('all' !== $zone) {
            $dialects = $dialects->whereZone($zone);
        }
        if ('all' !== $type) {
            $dialects = $dialects->whereType($type);
        }

        return $dialects->paginate($limit);
    }

    public function getDialectsByPage($zone, $type, $keyword, $limit)
    {
        $dialects = $this->dialect;

        if ('all' !== $zone) {
            $dialects = $dialects->whereZone($zone);
        }
        if ('all' !== $type) {
            $dialects = $dialects->whereType($type);
        }
        $dialects = $dialects->whereKeyword($keyword);

        return $dialects->paginate($limit);
    }
}
