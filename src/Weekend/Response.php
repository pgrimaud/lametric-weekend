<?php

namespace Weekend;

class Response
{
    /**
     * @return mixed
     */
    public function returnError()
    {
        return $this->asJson([
            'frames' => [
                [
                    'index' => 0,
                    'text'  => 'Is it weekend yet?',
                    'icon'  => 'i2975'
                ],
                [
                    'index' => 1,
                    'text'  => 'Error',
                    'icon'  => 'null'
                ]
            ]
        ]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function asJson($data = array())
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     * @param $sentence1
     * @param $sentence2
     * @return mixed
     */
    public function returnResponse($sentence1, $sentence2)
    {
        return $this->asJson([
            'frames' => [
                [
                    'index' => 0,
                    'text'  => $sentence1,
                    'icon'  => 'i2975'
                ],
                [
                    'index' => 1,
                    'text'  => $sentence2,
                    'icon'  => 'null'
                ]
            ]
        ]);
    }
}
