<?php

namespace Models\Bot;

class OrientationScoreCalculator
{
    public function calculateScores(array $selectedProfileKeys): array
    {
        $scores = [];

        foreach ($selectedProfileKeys as $profileKey) {
            if (!is_string($profileKey) || $profileKey === '') {
                continue;
            }

            if (!isset($scores[$profileKey])) {
                $scores[$profileKey] = 0;
            }

            $scores[$profileKey]++;
        }

        return $scores;
    }

    public function getWinningProfileKey(array $scores): ?string
    {
        if (empty($scores)) {
            return null;
        }

        arsort($scores);

        return array_key_first($scores);
    }

    public function calculateWinningProfileKey(array $selectedProfileKeys): ?string
    {
        $scores = $this->calculateScores($selectedProfileKeys);

        return $this->getWinningProfileKey($scores);
    }
}