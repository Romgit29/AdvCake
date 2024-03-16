<?php

namespace App\Actions;
class ReverseStringAction
{
    public function execute(string $string): string
    {
        $substrings = preg_split("/[\s\'\"\.\-\?:,!«»`]+/", $string, -1, PREG_SPLIT_OFFSET_CAPTURE);
        foreach($substrings as $substringKey => $substring) {
            $symbols = mb_str_split($substring[0], 1, 'UTF-8');
            $upperOffsets = $this->getUppercasePositions($symbols);
            foreach($symbols as $key => $symbol) {
                $symbols[$key] = mb_strtolower($symbol, 'UTF-8');
            }
            $symbols = array_reverse($symbols);
            foreach($upperOffsets as $key) {
                $symbols[$key] = mb_strtoupper($symbols[$key], 'UTF-8');
            }
            $substrings[$substringKey][0] = implode('', $symbols);
        }
        $this->replaceSubstrings($string, $substrings);

        return $string;
    }


    /**
     * Chek if given letter is uppercase
     *
     * @return bool
     */
    private function isUppercase(string $letter): bool
    {
        return mb_strtoupper($letter, 'UTF-8') === $letter;
    }

    /**
     * Recieve array of symbols and return keys of symbols which are uppercase
     *
     * @param array<string> $symbols
     * @return array<int>
     */
    private function getUppercasePositions(array $symbols): array
    {
        $upperOffsets = [];
        foreach($symbols as $key => $letter) {
            if ($this->isUppercase($letter)) array_push($upperOffsets, $key);
        }

        return $upperOffsets;
    }

    /**
     * Replaces substrings in given string
     *
     * @param string $string
     * @param array<array> $substrings
     */
    private function replaceSubstrings(string &$string, array $substrings): void
    {
        foreach($substrings as $substring) {
            $string = substr_replace($string, $substring[0], $substring[1], strlen($substring[0]));
        }
    }
}