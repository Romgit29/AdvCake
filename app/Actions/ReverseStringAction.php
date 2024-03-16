<?php

namespace App\Actions;
class ReverseStringAction
{
    public function execute(string $string): string
    {
        $substrings = preg_split("/[\s\'\"\.\-\?:,!«»`]+/", $string, -1, PREG_SPLIT_OFFSET_CAPTURE);
        foreach($substrings as $substringKey => $substring) {
            $upperOffsets = [];
            $symbols = mb_str_split($substring[0], 1, 'UTF-8');
            foreach($symbols as $key => $letter) {
                if (mb_strtoupper($letter, 'UTF-8') === $letter) array_push($upperOffsets, $key);
                $symbols[$key] = mb_strtolower($letter, 'UTF-8');
            }
            $symbols = array_reverse($symbols);
            foreach($upperOffsets as $key) {
                $symbols[$key] = mb_strtoupper($symbols[$key], 'UTF-8');
            }
            $substrings[$substringKey][0] = implode('', $symbols);
        }
        foreach($substrings as $key => $substring) {
            $string = substr_replace($string, $substring[0], $substring[1], strlen($substring[0]));
        }

        return $string;
    }
}