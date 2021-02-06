<?php

use PHPUnit\Framework\TestCase;

class TranslateTest extends TestCase
{
    public function testTranslateFrenchSentence()
    {
        $translate = new \Weekend\Translate('french');
        $sentence1 = 'Est-ce que c\'est bientôt le week-end ?';

        $sentence2 = 'Presque, mais pas encore. :(';

        $translatedSentence1 = $translate->getSentence1();
        $translatedSentence2 = $translate->getSentence2($sentence2);

        $this->assertEquals($sentence1, $translatedSentence1);
        $this->assertEquals($sentence2, $translatedSentence2);
    }

    public function testTranslateSpanishSentence()
    {
        $translate = new \Weekend\Translate('spanish');
        $sentence1 = '¿Ya es fin de semana?';

        $sentence2 = 'Casi, pero no todavía :(';

        $translatedSentence1 = $translate->getSentence1();
        $translatedSentence2 = $translate->getSentence2($sentence2);

        $this->assertEquals($sentence1, $translatedSentence1);
        $this->assertEquals($sentence2, $translatedSentence2);
    }

    public function testTranslateWrongLanguage()
    {
        $translate = new \Weekend\Translate('unknown');
        $sentence  = 'Non.';

        $translatedSentence = $translate->getSentence2($sentence);

        $this->assertEquals('No.', $translatedSentence);
    }

    public function testUnknownSentence()
    {
        $translate = new \Weekend\Translate('english');
        $sentence  = 'Lorem ipsum';

        $translatedSentence = $translate->getSentence2($sentence);

        $this->assertEquals($sentence, $translatedSentence);
    }

    public function testKnownSentenceOnlyOnEnglishTranslationFile()
    {
        $translate = new \Weekend\Translate('french');
        $sentence  = 'test';

        $translatedSentence = $translate->getSentence2($sentence);

        $this->assertEquals($sentence, $translatedSentence);
    }
}
