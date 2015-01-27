<?php

namespace byrokrat\banking\Component;

/**
 * Helper that implements getStructure() for Type1 accounts
 */
trait Type1
{
    use Constructor;

    /**
     * Get regular expression describing structure (from Component\Constructor)
     *
     * Type1 accounts share the structure xxxx,00000xxxxxxC
     *
     * @return string
     */
    protected function getStructure()
    {
        return "/^(\d{4}),?0{0,5}(\d{6})(\d)$/";
    }
}
