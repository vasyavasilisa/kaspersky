<?php

namespace Application;

/**
 * Class Antivirus
 * @package Application
 */
class Antivirus
{

    private $os;
    private $name;

    /**
     * Antivirus constructor.
     * @param $os
     * @param $name
     */
    public function __construct($os, $name)
    {
        $this->os = $os;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


}