<?php

class TranslateTest extends PHPUnit_Framework_TestCase
{
    public function testTranslateFrenchSentence()
    {
        $translate = new \Weekend\Translate('french');
        $sentence = 'Presque, mais pas encore. :(';

        $translatedSentence = $translate->getSentence2($sentence);

        $this->assertEquals($sentence, $translatedSentence);
    }

    public function testTranslateWrongLanguage()
    {
        $translate = new \Weekend\Translate('unknown');
        $sentence = 'Non.';

        $translatedSentence = $translate->getSentence2($sentence);

        $this->assertEquals('No.', $translatedSentence);
    }

    public function testUnknownSentence()
    {
        $translate = new \Weekend\Translate('english');
        $sentence = 'Lorem ipsum';

        $translatedSentence = $translate->getSentence2($sentence);

        $this->assertEquals($sentence, $translatedSentence);
    }

    public function testKnownSentenceOnlyOnEnglishTranslationFile()
    {
        $translate = new \Weekend\Translate('french');
        $sentence = 'test';

        $translatedSentence = $translate->getSentence2($sentence);

        $this->assertEquals($sentence, $translatedSentence);
    }
}

