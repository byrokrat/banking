<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace ledgr\banking;

/**
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class SEB implements AccountNumber
{
    use Component\Type1A;

    public function getType()
    {
        return "SEB";
    }

    protected function isValidClearing()
    {
        return (
            ( $this->getClearing() >= 5000 && $this->getClearing() <= 5999 )
            || ( $this->getClearing() >= 9120 && $this->getClearing() <= 9124 )
            || ( $this->getClearing() >= 9130 && $this->getClearing() <= 9149 )
        );
    }
}
