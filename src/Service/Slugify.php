<?php


namespace App\Service;


class Slugify
{
    public function generate(string $input) : string
    {
        $input = iconv('utf-8', 'us-ascii//TRANSLIT', $input);
        $input = str_replace(['!', '?', '\'', '.', ';', ','], '', $input);
        $input = trim($input);
        $input = str_replace(' ', '-', $input);
        $input = preg_replace('/-{2}/', '-', $input);
        return strtolower($input);
    }
}
