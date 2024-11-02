<?php

$tareas = [];

function obtenerTareas() {
    global $tareas;
    return $tareas;
}


function filtrarCampo($campo) {
    return trim(preg_replace('/\s+/', ' ', htmlspecialchars($campo)));
}


function esTextoValido($campo) {
    $campoFiltrado = filtrarCampo($campo);
    return !empty($campoFiltrado);
}


function guardarTarea($descripcion, $estado) {
    global $tareas;

    
    $descripcionFiltrada = filtrarCampo($descripcion);
    $estadoFiltrado = filtrarCampo($estado);

    
    if (esTextoValido($descripcionFiltrada) && esTextoValido($estadoFiltrado)) {
        
        $tarea = [
            'id' => count($tareas) + 1, 
            'descripcion' => $descripcionFiltrada,
            'estado' => $estadoFiltrado
        ];

        
        $tareas[] = $tarea;
        return true; 
    }

    return false; 
}
?>

