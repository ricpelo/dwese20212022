<?php

namespace X;

require 'Departamento.php';

class Unidad extends Departamento
{
    private $presupuesto = PI;

    public function __construct(
        $denominacion = null,
        $localidad = null,
        $presupuesto = null
    )
    {
        parent::__construct($denominacion, $localidad);
        $this->setPresupuesto($presupuesto);
    }

    public static function campos()
    {
        return array_merge(parent::campos(), ['presupuesto']);
    }

    public function getPresupuesto()
    {
        return $this->presupuesto;
    }

    public function setPresupuesto($presupuesto)
    {
        $this->presupuesto = $presupuesto;
    }

    public function __toString()
    {
        $o = json_decode(parent::__toString());
        $o->presupuesto = $this->presupuesto;
        return json_encode($o);
    }
}
