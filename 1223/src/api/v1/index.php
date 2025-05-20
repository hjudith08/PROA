<?php

require_once '../../includes/PeticionREST.inc';

$peticion = new PeticionREST('v1');

$salida = [];
$salida['metodo'] = $peticion->metodo();
$salida['recurso'] = $peticion->recurso();
if(count($peticion->parametrosPath()) > 0) $salida['parametrosPath'] = $peticion->parametrosPath();
if(count($peticion->parametrosQuery()) > 0)$salida['parametrosQuery'] = $peticion->parametrosQuery();
if(count($peticion->parametrosPost()) > 0)$salida['parametrosPost'] = $peticion->parametrosPost();
if($peticion->parametrosBody() !== null)$salida['parametrosBody'] = $peticion->parametrosBody();

echo json_encode($salida);