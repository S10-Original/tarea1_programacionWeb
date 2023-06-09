<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $empleados = json_decode($_POST["empleados"], true);

    $totalFemenino = 0;
    $totalHombresCasados = 0;
    $totalMujeresViudas = 0;
    $sumaEdadHombres = 0;
    $totalHombres = 0;

    $nombresFemenino = [];
    $nombresHombresCasados = [];
    $nombresMujeresViudas = [];

    foreach ($empleados as $empleado) {
        if ($empleado["sexo"] === "Femenino") {
            $totalFemenino++;
            $nombresFemenino[] = $empleado["nombre"];
        }

        if ($empleado["sexo"] === "Masculino" && $empleado["estadoCivil"] === "Casado(a)" && $empleado["sueldo"] === "Mas de 2500 Bs.") {
            $totalHombresCasados++;
            $nombresHombresCasados[] = $empleado["nombre"];
        }

        if ($empleado["sexo"] === "Femenino" && $empleado["estadoCivil"] === "Viudo(a)" && $empleado["sueldo"] === "Entre 1000 y 2500 Bs.") {
            $totalMujeresViudas++;
            $nombresMujeresViudas[] = $empleado["nombre"];
        }

        if ($empleado["sexo"] === "Femenino" && $empleado["estadoCivil"] === "Viudo(a)" && $empleado["sueldo"] === "Mas de 2500 Bs.") {
            $totalMujeresViudas++;
            $nombresMujeresViudas[] = $empleado["nombre"];
        }

        if ($empleado["sexo"] === "Masculino") {
            $sumaEdadHombres += $empleado["edad"];
            $totalHombres++;
        }
    }

    $promedioEdadHombres = $totalHombres > 0 ? $sumaEdadHombres / $totalHombres : 0;

    $resultados = [
        "totalFemenino" => $totalFemenino,
        "nombresFemenino" => $nombresFemenino,
        "totalHombresCasados" => $totalHombresCasados,
        "nombresHombresCasados" => $nombresHombresCasados,
        "totalMujeresViudas" => $totalMujeresViudas,
        "nombresMujeresViudas" => $nombresMujeresViudas,
        "promedioEdadHombres" => $promedioEdadHombres,
        "empleados" => $empleados
    ];

    echo json_encode($resultados);
}
?>
