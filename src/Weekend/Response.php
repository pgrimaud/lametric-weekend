<?php

declare(strict_types=1);

namespace Weekend;

class Response
{
    /**
     * @return string
     */
    public function returnError(): string
    {
        return $this->asJson([
            'frames' => [
                [
                    'index' => 0,
                    'text'  => 'Is it weekend yet?',
                    'icon'  => 'i2975',
                ],
                [
                    'index' => 1,
                    'text'  => 'Error',
                    'icon'  => 'null',
                ],
            ],
        ]);
    }

    /**
     * @param array $data
     * @return string
     */
    public function asJson(array $data = []): string
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     * @param string $sentence1
     * @param string $sentence2
     * @return string
     */
    public function returnResponse(string $sentence1, string $sentence2): string
    {
        return $this->asJson([
            'frames' => [
                [
                    'index' => 0,
                    'text'  => $sentence1,
                    'icon'  => 'i2975',
                ],
                [
                    'index' => 1,
                    'text'  => $sentence2,
                    'icon'  => 'null',
                ],
            ],
        ]);
    }
}
