<?php

namespace X;

const PI = 3.14;

class Departamento
{
    const MAX_EMPLE = 500;

    private $id = PI;

    public $denominacion;
    public $localidad;

    public static $numInstancias = 0;

    public function __construct($denominacion = null, $localidad = null)
    {
        self::$numInstancias++;
        $this->denominacion = $denominacion;
        $this->localidad = $localidad;
    }

    public static function imprimeCampos()
    {
        print_r(static::campos());
    }

    public function longitudDenominacion()
    {
        return mb_strlen($this->denominacion);
    }

    public static function campos()
    {
        return ['id', 'denominacion', 'localidad'];
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

    public function __toString()
    {
        return json_encode([
            'id' => $this->id,
            'denominacion' => $this->denominacion,
            'localidad' => $this->localidad,
        ]);
    }
}
