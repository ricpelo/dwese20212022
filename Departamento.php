<?php

class Departamento
{
    const MAX_EMPLE = 500;

    private $id;

    public $denominacion;
    public $localidad;

    public function __construct($denominacion = null, $localidad = null)
    {
        $this->denominacion = $denominacion;
        $this->localidad = $localidad;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this->getId();
    }

    public function maxEmple()
    {
        return self::MAX_EMPLE;
    }
}
