<?php

declare(strict_types = 1);

namespace byrokrat\banking\Rewriter;

/**
 * Generate permutations for a set of values
 */
class Permutator
{
    /**
     * @return \Generator & iterable<array>
     */
    public static function getPermutations(array $set): \Generator
    {
        foreach (self::getPowerSet($set) as $subset) {
            foreach (self::generateFixedLengthPermutations($subset) as $perm) {
                yield $perm;
            }
        }
    }

    /**
     * @return array[]
     */
    private static function getPowerSet(array $set): array
    {
        $results = [[]];

        foreach ($set as $element) {
            foreach ($results as $combination) {
                $subset = array_merge([$element], $combination);
                $results[] = $subset;
            }
        }

        usort(
            $results,
            function (array $left, array $right): int {
                return count($left) <=> count($right);
            }
        );

        return array_filter($results);
    }

    /**
     * @return \Generator & iterable<array>
     */
    private static function generateFixedLengthPermutations(array $items, array $perms = []): \Generator
    {
        if (empty($items)) {
            yield $perms;
        } else {
            for ($i = count($items)-1; $i>=0; $i--) {
                $newitems = $items;
                $newperms = $perms;
                list($foo) = array_splice($newitems, $i, 1);
                array_unshift($newperms, $foo);
                yield from self::generateFixedLengthPermutations($newitems, $newperms);
            }
        }
    }
}
