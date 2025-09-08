<?php
/**
 * EJERCICIO 3: Estructuras de Control en PHP
 * 
 * En este ejercicio aprenderás:
 * - Condicionales: if, else, elseif
 * - Switch/case
 * - Bucles: for, while, do-while, foreach
 * - Break y continue
 */

echo "<h1>3. Estructuras de Control</h1>";

// ========================================
// 1. CONDICIONALES IF/ELSE
// ========================================
echo "<h2>3.1 Condicionales if/else</h2>";

$edad = 20;
$tieneCarnet = true;

echo "Edad: $edad<br>";
echo "Tiene carnet: " . ($tieneCarnet ? "Sí" : "No") . "<br><br>";

// If simple
if ($edad >= 18) {
    echo "✅ Eres mayor de edad<br>";
}

// If-else
if ($tieneCarnet) {
    echo "✅ Puedes conducir<br>";
} else {
    echo "❌ No puedes conducir sin carnet<br>";
}

// If-elseif-else
if ($edad < 13) {
    echo "Categoría: Niño<br>";
} elseif ($edad < 18) {
    echo "Categoría: Adolescente<br>";
} elseif ($edad < 65) {
    echo "Categoría: Adulto<br>";
} else {
    echo "Categoría: Adulto mayor<br>";
}

// Condiciones múltiples
if ($edad >= 18 && $tieneCarnet) {
    echo "✅ Puede alquilar un coche<br>";
} else {
    echo "❌ No puede alquilar un coche<br>";
}

echo "<br>";

// ========================================
// 2. SWITCH/CASE
// ========================================
echo "<h2>3.2 Switch/Case</h2>";

$diaSemana = 3;
$nombreDia = "";

switch ($diaSemana) {
    case 1:
        $nombreDia = "Lunes";
        break;
    case 2:
        $nombreDia = "Martes";
        break;
    case 3:
        $nombreDia = "Miércoles";
        break;
    case 4:
        $nombreDia = "Jueves";
        break;
    case 5:
        $nombreDia = "Viernes";
        break;
    case 6:
        $nombreDia = "Sábado";
        break;
    case 7:
        $nombreDia = "Domingo";
        break;
    default:
        $nombreDia = "Día inválido";
}

echo "Día $diaSemana: $nombreDia<br>";

// Switch con múltiples casos
$mes = 8;
switch ($mes) {
    case 12:
    case 1:
    case 2:
        $estacion = "Invierno";
        break;
    case 3:
    case 4:
    case 5:
        $estacion = "Primavera";
        break;
    case 6:
    case 7:
    case 8:
        $estacion = "Verano";
        break;
    case 9:
    case 10:
    case 11:
        $estacion = "Otoño";
        break;
    default:
        $estacion = "Mes inválido";
}

echo "Mes $mes: $estacion<br><br>";

// ========================================
// 3. BUCLE FOR
// ========================================
echo "<h2>3.3 Bucle For</h2>";

echo "Contando del 1 al 5:<br>";
for ($i = 1; $i <= 5; $i++) {
    echo "Número: $i<br>";
}

echo "<br>Tabla del 5:<br>";
for ($i = 1; $i <= 10; $i++) {
    $resultado = 5 * $i;
    echo "5 x $i = $resultado<br>";
}

echo "<br>Contando hacia atrás:<br>";
for ($i = 10; $i >= 1; $i--) {
    echo "$i ";
}
echo "<br><br>";

// ========================================
// 4. BUCLE WHILE
// ========================================
echo "<h2>3.4 Bucle While</h2>";

$contador = 1;
echo "Usando while, contando hasta 5:<br>";
while ($contador <= 5) {
    echo "Contador: $contador<br>";
    $contador++;
}

// Ejemplo práctico: encontrar potencias de 2
echo "<br>Potencias de 2 menores a 100:<br>";
$potencia = 1;
while ($potencia < 100) {
    echo "$potencia ";
    $potencia *= 2;
}
echo "<br><br>";

// ========================================
// 5. BUCLE DO-WHILE
// ========================================
echo "<h2>3.5 Bucle Do-While</h2>";

$numero = 10;
echo "Usando do-while (se ejecuta al menos una vez):<br>";
do {
    echo "Número: $numero<br>";
    $numero++;
} while ($numero <= 10); // Aunque la condición sea falsa inicialmente, se ejecuta una vez

echo "<br>";

// ========================================
// 6. BUCLE FOREACH (para arrays)
// ========================================
echo "<h2>3.6 Bucle Foreach</h2>";

// Array indexado
$frutas = ["manzana", "plátano", "naranja", "uva", "fresa"];

echo "Lista de frutas:<br>";
foreach ($frutas as $fruta) {
    echo "- $fruta<br>";
}

// Array indexado con índice
echo "<br>Frutas con posición:<br>";
foreach ($frutas as $indice => $fruta) {
    $posicion = $indice + 1;
    echo "$posicion. $fruta<br>";
}

// Array asociativo
$persona = [
    "nombre" => "Ana",
    "edad" => 28,
    "ciudad" => "Madrid",
    "profesion" => "Ingeniera"
];

echo "<br>Datos de la persona:<br>";
foreach ($persona as $clave => $valor) {
    echo ucfirst($clave) . ": $valor<br>";
}

echo "<br>";

// ========================================
// 7. BREAK Y CONTINUE
// ========================================
echo "<h2>3.7 Break y Continue</h2>";

// Break: sale del bucle completamente
echo "Usando break (para en el 5):<br>";
for ($i = 1; $i <= 10; $i++) {
    if ($i == 5) {
        echo "¡Encontré el 5! Saliendo del bucle...<br>";
        break;
    }
    echo "$i ";
}

echo "<br><br>";

// Continue: salta a la siguiente iteración
echo "Usando continue (salta los números pares):<br>";
for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 == 0) {
        continue; // Salta los números pares
    }
    echo "$i "; // Solo imprime números impares
}

echo "<br><br>";

// ========================================
// 8. ESTRUCTURAS ANIDADAS
// ========================================
echo "<h2>3.8 Estructuras Anidadas</h2>";

echo "Tabla de multiplicar del 1 al 5:<br>";
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>x</th>";
for ($j = 1; $j <= 5; $j++) {
    echo "<th>$j</th>";
}
echo "</tr>";

for ($i = 1; $i <= 5; $i++) {
    echo "<tr><th>$i</th>";
    for ($j = 1; $j <= 5; $j++) {
        $resultado = $i * $j;
        echo "<td>$resultado</td>";
    }
    echo "</tr>";
}
echo "</table><br>";

// ========================================
// 9. EJERCICIO PRÁCTICO
// ========================================
echo "<h2>3.9 Ejercicio Práctico: Sistema de Calificaciones</h2>";

$estudiantes = [
    "Juan" => 85,
    "María" => 92,
    "Pedro" => 78,
    "Ana" => 96,
    "Luis" => 67
];

echo "<h3>Calificaciones de estudiantes:</h3>";

$totalEstudiantes = 0;
$sumaCalificaciones = 0;
$aprobados = 0;
$reprobados = 0;

foreach ($estudiantes as $nombre => $calificacion) {
    // Determinar la letra de calificación
    if ($calificacion >= 90) {
        $letra = "A";
        $estado = "Excelente";
    } elseif ($calificacion >= 80) {
        $letra = "B";
        $estado = "Bueno";
    } elseif ($calificacion >= 70) {
        $letra = "C";
        $estado = "Regular";
    } elseif ($calificacion >= 60) {
        $letra = "D";
        $estado = "Suficiente";
    } else {
        $letra = "F";
        $estado = "Reprobado";
    }
    
    // Contar aprobados/reprobados
    if ($calificacion >= 60) {
        $aprobados++;
    } else {
        $reprobados++;
    }
    
    // Mostrar resultado
    echo "$nombre: $calificacion puntos - Calificación $letra ($estado)<br>";
    
    // Acumular para promedio
    $sumaCalificaciones += $calificacion;
    $totalEstudiantes++;
}

// Calcular estadísticas
$promedio = $sumaCalificaciones / $totalEstudiantes;

echo "<br><strong>Estadísticas:</strong><br>";
echo "Total de estudiantes: $totalEstudiantes<br>";
echo "Promedio general: " . round($promedio, 2) . " puntos<br>";
echo "Estudiantes aprobados: $aprobados<br>";
echo "Estudiantes reprobados: $reprobados<br>";

$porcentajeAprobados = ($aprobados / $totalEstudiantes) * 100;
echo "Porcentaje de aprobación: " . round($porcentajeAprobados, 1) . "%<br>";

echo "<hr>";
echo "<p><strong>Para practicar:</strong> Modifica el array \$estudiantes con diferentes nombres y calificaciones.</p>";
?>
