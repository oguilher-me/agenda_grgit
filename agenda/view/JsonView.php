<?php

/**
 * View that renders the result in json format
 */
class JsonView extends ApiView
{
    /**
     * [render description]
     *
     * @param  string $content - requested data
     * @return Json - Json representation of requested data
     */
    public function render($content)
    {
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($content);

        return true;
    }
}