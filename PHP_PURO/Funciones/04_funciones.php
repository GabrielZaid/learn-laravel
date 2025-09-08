<?php
/**
 * EJERCICIO 4: Funciones en PHP
 * 
 * En este ejercicio aprenderás:
 * - Declaración y uso de funciones
 * - Parámetros y argumentos
 * - Valores de retorno
 * - Ámbito de variables (scope)
 * - Funciones anónimas y closures
 * - Funciones predefinidas útiles
 */

echo "<h1>4. Funciones</h1>";

// ========================================
// 1. FUNCIONES BÁSICAS
// ========================================
echo "<h2>4.1 Declaración y Uso de Funciones</h2>";

// Función simple sin parámetros
function saludar() {
    return "¡Hola, mundo!";
}

echo saludar() . "<br>";

// Función con parámetros
function saludarPersona($nombre) {
    return "¡Hola, $nombre!";
}

echo saludarPersona("Gabriel") . "<br>";
echo saludarPersona("María") . "<br>";

// Función con múltiples parámetros
function presentar($nombre, $edad, $ciudad) {
    return "Me llamo $nombre, tengo $edad años y vivo en $ciudad.";
}

echo presentar("Ana", 25, "Madrid") . "<br><br>";

// ========================================
// 2. PARÁMETROS CON VALORES POR DEFECTO
// ========================================
echo "<h2>4.2 Parámetros con Valores por Defecto</h2>";

function crearSaludo($nombre = "amigo", $hora = "día") {
    return "¡Buenos $hora, $nombre!";
}

echo crearSaludo() . "<br>"; // Usa valores por defecto
echo crearSaludo("Carlos") . "<br>"; // Solo cambia el nombre
echo crearSaludo("Laura", "noches") . "<br>"; // Cambia ambos parámetros
echo "<br>";

// ========================================
// 3. FUNCIONES QUE RETORNAN VALORES
// ========================================
echo "<h2>4.3 Funciones con Valores de Retorno</h2>";

function sumar($a, $b) {
    return $a + $b;
}

function calcularArea($radio) {
    return 3.14159 * $radio * $radio;
}

function esPar($numero) {
    return $numero % 2 == 0;
}

$resultado = sumar(5, 3);
echo "5 + 3 = $resultado<br>";

$area = calcularArea(5);
echo "Área del círculo con radio 5: " . round($area, 2) . "<br>";

$numero = 8;
if (esPar($numero)) {
    echo "$numero es par<br>";
} else {
    echo "$numero es impar<br>";
}
echo "<br>";

// ========================================
// 4. FUNCIONES CON MÚLTIPLES VALORES DE RETORNO
// ========================================
echo "<h2>4.4 Retorno de Múltiples Valores</h2>";

function operacionesBasicas($a, $b) {
    $suma = $a + $b;
    $resta = $a - $b;
    $multiplicacion = $a * $b;
    $division = ($b != 0) ? $a / $b : null;
    
    return [$suma, $resta, $multiplicacion, $division];
}

// Usando list() para asignar múltiples variables
list($suma, $resta, $mult, $div) = operacionesBasicas(10, 3);

echo "10 y 3:<br>";
echo "Suma: $suma<br>";
echo "Resta: $resta<br>";
echo "Multiplicación: $mult<br>";
echo "División: " . round($div, 2) . "<br><br>";

// ========================================
// 5. ÁMBITO DE VARIABLES (SCOPE)
// ========================================
echo "<h2>4.5 Ámbito de Variables</h2>";

$variableGlobal = "Soy global";

function mostrarVariables() {
    $variableLocal = "Soy local";
    global $variableGlobal; // Acceder a variable global
    
    echo "Dentro de la función:<br>";
    echo "Variable local: $variableLocal<br>";
    echo "Variable global: $variableGlobal<br>";
}

mostrarVariables();
echo "Fuera de la función:<br>";
echo "Variable global: $variableGlobal<br>";
// echo "Variable local: $variableLocal<br>"; // Esto daría error
echo "<br>";

// Variables estáticas
function contador() {
    static $count = 0;
    $count++;
    echo "Llamada número: $count<br>";
}

echo "Usando variables estáticas:<br>";
contador(); // 1
contador(); // 2
contador(); // 3
echo "<br>";

// ========================================
// 6. FUNCIONES ANÓNIMAS (CLOSURES)
// ========================================
echo "<h2>4.6 Funciones Anónimas</h2>";

// Función anónima asignada a una variable
$multiplicar = function($x, $y) {
    return $x * $y;
};

echo "5 x 4 = " . $multiplicar(5, 4) . "<br>";

// Función anónima con use (captura de variables del ámbito padre)
$factor = 10;
$multiplicarPorFactor = function($numero) use ($factor) {
    return $numero * $factor;
};

echo "8 x $factor = " . $multiplicarPorFactor(8) . "<br>";

// Usando funciones anónimas con array_map
$numeros = [1, 2, 3, 4, 5];
$cuadrados = array_map(function($n) {
    return $n * $n;
}, $numeros);

echo "Números originales: " . implode(", ", $numeros) . "<br>";
echo "Cuadrados: " . implode(", ", $cuadrados) . "<br><br>";

// ========================================
// 7. FUNCIONES PREDEFINIDAS ÚTILES
// ========================================
echo "<h2>4.7 Funciones Predefinidas Útiles</h2>";

// Funciones de string
$texto = "  Hola Mundo PHP  ";
echo "Texto original: '$texto'<br>";
echo "trim(): '" . trim($texto) . "'<br>";
echo "strlen(): " . strlen($texto) . " caracteres<br>";
echo "strtoupper(): " . strtoupper($texto) . "<br>";
echo "strtolower(): " . strtolower($texto) . "<br>";
echo "str_replace(): " . str_replace("PHP", "JavaScript", $texto) . "<br>";

// Funciones matemáticas
echo "<br>Funciones matemáticas:<br>";
echo "abs(-5): " . abs(-5) . "<br>";
echo "round(3.7): " . round(3.7) . "<br>";
echo "ceil(3.2): " . ceil(3.2) . "<br>";
echo "floor(3.8): " . floor(3.8) . "<br>";
echo "max(1, 5, 3): " . max(1, 5, 3) . "<br>";
echo "min(1, 5, 3): " . min(1, 5, 3) . "<br>";
echo "rand(1, 100): " . rand(1, 100) . "<br>";

// Funciones de fecha
echo "<br>Funciones de fecha:<br>";
echo "date('Y-m-d'): " . date('Y-m-d') . "<br>";
echo "date('H:i:s'): " . date('H:i:s') . "<br>";
echo "time(): " . time() . "<br><br>";

// ========================================
// 8. EJERCICIO PRÁCTICO: CALCULADORA AVANZADA
// ========================================
echo "<h2>4.8 Ejercicio Práctico: Calculadora con Funciones</h2>";

// Funciones para operaciones básicas
function sumarNumeros($a, $b) {
    return $a + $b;
}

function restarNumeros($a, $b) {
    return $a - $b;
}

function multiplicarNumeros($a, $b) {
    return $a * $b;
}

function dividirNumeros($a, $b) {
    if ($b == 0) {
        return "Error: División por cero";
    }
    return $a / $b;
}

function potencia($base, $exponente) {
    return pow($base, $exponente);
}

// Función que determina si un número es primo
function esPrimo($numero) {
    if ($numero < 2) return false;
    if ($numero == 2) return true;
    if ($numero % 2 == 0) return false;
    
    for ($i = 3; $i <= sqrt($numero); $i += 2) {
        if ($numero % $i == 0) {
            return false;
        }
    }
    return true;
}

// Función que calcula el factorial
function factorial($n) {
    if ($n <= 1) return 1;
    return $n * factorial($n - 1);
}

// Función que convierte temperatura
function convertirTemperatura($temperatura, $de, $a) {
    // Primero convertir a Celsius
    switch (strtoupper($de)) {
        case 'F':
            $celsius = ($temperatura - 32) * 5/9;
            break;
        case 'K':
            $celsius = $temperatura - 273.15;
            break;
        default:
            $celsius = $temperatura;
    }
    
    // Luego convertir de Celsius a la unidad destino
    switch (strtoupper($a)) {
        case 'F':
            return ($celsius * 9/5) + 32;
        case 'K':
            return $celsius + 273.15;
        default:
            return $celsius;
    }
}

// Pruebas de la calculadora
echo "<h3>Operaciones Básicas:</h3>";
echo "10 + 5 = " . sumarNumeros(10, 5) . "<br>";
echo "10 - 5 = " . restarNumeros(10, 5) . "<br>";
echo "10 * 5 = " . multiplicarNumeros(10, 5) . "<br>";
echo "10 / 5 = " . dividirNumeros(10, 5) . "<br>";
echo "2^8 = " . potencia(2, 8) . "<br>";

echo "<h3>Funciones Avanzadas:</h3>";
$numeros = [7, 12, 13, 15, 17];
foreach ($numeros as $num) {
    echo "$num " . (esPrimo($num) ? "es primo" : "no es primo") . "<br>";
}

echo "<br>Factoriales:<br>";
for ($i = 1; $i <= 5; $i++) {
    echo "$i! = " . factorial($i) . "<br>";
}

echo "<br>Conversiones de temperatura:<br>";
echo "100°C = " . round(convertirTemperatura(100, 'C', 'F'), 2) . "°F<br>";
echo "32°F = " . round(convertirTemperatura(32, 'F', 'C'), 2) . "°C<br>";
echo "273.15K = " . round(convertirTemperatura(273.15, 'K', 'C'), 2) . "°C<br>";

echo "<hr>";
echo "<p><strong>Para practicar:</strong> Crea tus propias funciones para calcular el área de diferentes figuras geométricas.</p>";
?>
