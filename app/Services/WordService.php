<?php

namespace App\Services;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;

class WordService
{
    public function countWords($filePath)
    {
        $phpWord = IOFactory::load($filePath);
        $text = '';

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getText')) {
                    $text .= $element->getText();
                }
            }
        }

        return str_word_count($text);
    }
}
