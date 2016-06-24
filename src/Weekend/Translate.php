<?php
namespace Weekend;

class Translate
{
    /**
     * @var string
     */
    private $lang;

    /**
     * @var array
     */
    private $translations = [];

    /**
     * Translate constructor.
     * @param string $lang
     */
    public function __construct($lang = 'english')
    {
        $this->lang = $lang;
    }

    /**
     * @param $sentence
     * @return string
     */
    public function getTranslation($sentence)
    {
        if (is_file(__DIR__ . '/../../translations/' . $this->lang . '.php')) {
            $this->translations = include __DIR__ . '/../../translations/' . $this->lang . '.php';
        }

        $englishTranslations = include __DIR__ . '/../../translations/english.php';

        if (isset($this->translations[md5($sentence)])) {
            return $this->translations[md5($sentence)];
        } elseif (isset($englishTranslations[md5($sentence)])) {
            return $englishTranslations[md5($sentence)];
        } else {
            return $sentence;
        }
    }
}
