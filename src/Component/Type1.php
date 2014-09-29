<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace ledgr\banking\Component;

/**
 * Helper that implements getStructure() for Type1 accounts
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
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
