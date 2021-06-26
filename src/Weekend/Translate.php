<?php

declare(strict_types=1);

namespace Weekend;

class Translate
{
    /**
     * @var string
     */
    private string $lang;

    /**
     * @var array
     */
    private array $translations = [];

    /**
     * @param string $lang
     */
    public function __construct(string $lang = 'english')
    {
        // add more languages here if needed
        $allowedLangs = [
            'english',
            'french',
            'german',
            'spanish',
            'portuguese',
            'dutch',
        ];

        $this->lang = in_array($lang, $allowedLangs) ? strtolower($lang) : 'english';
    }

    /**
     * @param string $sentence
     * @return string
     */
    public function getSentence2(string $sentence): string
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
    public function getSentence1(): string
    {
        switch (strtolower($this->lang)) {
            case 'french':
                $result = 'Est-ce que c\'est bientôt le week-end ?';
                break;
            case 'german':
                $result = 'Ist es bereits Wochenende?';
                break;
            case 'spanish':
                $result = '¿Ya es fin de semana?';
                break;
            case 'portuguese':
                $result = 'Já é fim de semana?';
                break;
            case 'dutch':
                $result = 'Is het al weekend?';
                break;
            default:
                $result = 'Is it weekend yet?';
        }

        return $result;
    }
}
