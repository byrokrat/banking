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
class PlusGiro extends AbstractGiro
{
    public function getType()
    {
        return "PlusGiro";
    }

    protected function getStructure()
    {
        return "/^\d{1,7}-\d$/";
    }
}
