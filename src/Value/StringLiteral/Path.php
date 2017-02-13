<?php

namespace OpenBibIdApi\Value\StringLiteral;

class Path extends StringLiteral
{

    /**
     * Returns a path array.
     *
     * @return array
     *   An array of url parts.
     */
    public function getPath()
    {
        return parse_url($this->value);
    }
}
