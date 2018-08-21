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
        // add more languages here if needed
        $allowedLangs = [
            'english',
            'french',
            'spanish'
        ];

        $this->lang = in_array($lang, $allowedLangs) ? strtolower($lang) : 'english';
    }

    /**
     * @param $sentence
     * @return string
     */
    public function getSentence2($sentence)
    {
        if (is_file(__DIR__ . '/../../translations/' . $this->lang . '.php')) {
            $this->translations = include __DIR__ . '/../../translations/' . $this->lang . '.php';
        }

        if (isset($this->translations[md5($sentence)])) {
            return $this->translations[md5($sentence)];
        } else {
            return $sentence;
        }
    }

    /**
     * @return string
     */
    public function getSentence1()
    {
        switch (strtolower($this->lang)) {
            case 'french':
                $result = 'Est-ce que c\'est bientôt le week-end ?';
                break;
            case 'spanish':
                $result = '¿Ya es fin de semana?';
                break;
            case 'portuguese':
                $result = 'É logo o fim de semana?';
                break;
            default:
                $result = 'Is it weekend yet?';
        }

        return $result;
    }
}
