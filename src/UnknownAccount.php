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
 * Fake account, all is valid
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class UnknownAccount extends AbstractBankAccount
{
    public function getType()
    {
        return "Unknown";
    }

    protected function getStructure()
    {
        return "/.*/";
    }

    protected function isValidClearing()
    {
        return true;
    }

    protected function isValidCheckDigit()
    {
        return true;
    }
}
