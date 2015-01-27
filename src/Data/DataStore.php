<?php

namespace byrokrat\banking\Data;

/**
 * Interface for accessing data about supported account types
 */
interface DataStore
{
    /**
     * Get an array of arrays describing supported account types
     *
     * TODO: beskriv i detalj hur den returnerade vektorn ska se ut!
     *
     * @return array
     */
    public function getAccountTypes();
}
