<?php

declare(strict_types=1);

namespace byrokrat\banking\Rewriter;

/**
 * Generate permutations for a set of values
 */
class Permutator
{
    /**
     * @param array<mixed> $set
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
     * @param array<mixed> $set
     * @return array<array>
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
     * @param array<mixed> $set
     * @param array<array> $permutations
     * @return \Generator & iterable<array>
     */
    private static function generateFixedLengthPermutations(array $set, array $permutations = []): \Generator
    {
        if (empty($set)) {
            yield $permutations;
        } else {
            for ($i = count($set) - 1; $i >= 0; $i--) {
                $newSet = $set;
                $newPermutations = $permutations;
                list($foo) = array_splice($newSet, $i, 1);
                array_unshift($newPermutations, $foo);
                yield from self::generateFixedLengthPermutations($newSet, $newPermutations);
            }
        }
    }
}
