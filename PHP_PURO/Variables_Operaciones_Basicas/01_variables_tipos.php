<?php
/**
 * EJERCICIO 1: Variables y Tipos de Datos en PHP
 * 
 * En este ejercicio aprenderás:
 * - Cómo declarar variables en PHP
 * - Los diferentes tipos de datos básicos
 * - Cómo verificar el tipo de una variable
 * - Conversiones de tipos (casting)
 */

echo "<h1>1. Variables y Tipos de Datos</h1>";

// ========================================
// 1. DECLARACIÓN DE VARIABLES
// ========================================
echo "<h2>1.1 Declaración de Variables</h2>";

// En PHP las variables siempre empiezan con $
$nombre = "Gabriel";
$edad = 25;
$salario = 2500.50;
$esEstudiante = true;

echo "Nombre: " . $nombre . "<br>";
echo "Edad: " . $edad . "<br>";
echo "Salario: $" . $salario . "<br>";
echo "Es estudiante: " . ($esEstudiante ? "Sí" : "No") . "<br><br>";

// ========================================
// 2. TIPOS DE DATOS BÁSICOS
// ========================================
echo "<h2>1.2 Tipos de Datos</h2>";

// String (cadena de texto)
$texto1 = "Hola mundo";
$texto2 = 'PHP es genial';
echo "String: $texto1<br>";
echo "String: $texto2<br>";

// Integer (número entero)
$numeroEntero = 42;
$numeroNegativo = -15;
echo "Integer: $numeroEntero<br>";
echo "Integer negativo: $numeroNegativo<br>";

// Float (número decimal)
$numeroDecimal = 3.14159;
$precio = 29.99;
echo "Float: $numeroDecimal<br>";
echo "Precio: $$precio<br>";

// Boolean (verdadero/falso)
$verdadero = true;
$falso = false;
echo "Boolean verdadero: " . ($verdadero ? "true" : "false") . "<br>";
echo "Boolean falso: " . ($falso ? "true" : "false") . "<br>";

// Array (arreglo)
$frutas = ["manzana", "plátano", "naranja"];
$numeros = [1, 2, 3, 4, 5];
echo "Array de frutas: " . implode(", ", $frutas) . "<br>";
echo "Array de números: " . implode(", ", $numeros) . "<br>";

// NULL
$valorNulo = null;
echo "Valor nulo: " . ($valorNulo === null ? "NULL" : $valorNulo) . "<br><br>";

// ========================================
// 3. VERIFICAR TIPOS DE DATOS
// ========================================
echo "<h2>1.3 Verificar Tipos de Datos</h2>";

function mostrarTipo($variable, $nombreVariable) {
    echo "$nombreVariable es de tipo: " . gettype($variable) . "<br>";
}

mostrarTipo($nombre, '$nombre');
mostrarTipo($edad, '$edad');
mostrarTipo($salario, '$salario');
mostrarTipo($esEstudiante, '$esEstudiante');
mostrarTipo($frutas, '$frutas');
mostrarTipo($valorNulo, '$valorNulo');

echo "<br>";

// ========================================
// 4. FUNCIONES DE VERIFICACIÓN DE TIPOS
// ========================================
echo "<h2>1.4 Funciones de Verificación</h2>";

$valor = "123";

echo "¿'$valor' es string? " . (is_string($valor) ? "Sí" : "No") . "<br>";
echo "¿'$valor' es integer? " . (is_int($valor) ? "Sí" : "No") . "<br>";
echo "¿'$valor' es numeric? " . (is_numeric($valor) ? "Sí" : "No") . "<br>";

$numero = 123;
echo "¿'$numero' es integer? " . (is_int($numero) ? "Sí" : "No") . "<br>";
echo "¿'$numero' es string? " . (is_string($numero) ? "Sí" : "No") . "<br><br>";

// ========================================
// 5. CONVERSIONES DE TIPOS (CASTING)
// ========================================
echo "<h2>1.5 Conversiones de Tipos</h2>";

$textoNumero = "100";
$numeroTexto = 200;

// Conversión explícita
$textoAEntero = (int)$textoNumero;
$enteroATexto = (string)$numeroTexto;

echo "Texto '$textoNumero' convertido a entero: $textoAEntero (tipo: " . gettype($textoAEntero) . ")<br>";
echo "Número $numeroTexto convertido a texto: '$enteroATexto' (tipo: " . gettype($enteroATexto) . ")<br>";

// Más conversiones
$decimal = 3.14159;
$decimalAEntero = (int)$decimal;
$enteroADecimal = (float)$textoAEntero;

echo "Decimal $decimal convertido a entero: $decimalAEntero<br>";
echo "Entero $textoAEntero convertido a decimal: $enteroADecimal<br>";

// Conversión a boolean
$cero = 0;
$vacio = "";
$conValor = "Hola";

echo "0 convertido a boolean: " . ((bool)$cero ? "true" : "false") . "<br>";
echo "'' convertido a boolean: " . ((bool)$vacio ? "true" : "false") . "<br>";
echo "'Hola' convertido a boolean: " . ((bool)$conValor ? "true" : "false") . "<br><br>";

// ========================================
// 6. EJERCICIO PRÁCTICO
// ========================================
echo "<h2>1.6 Ejercicio Práctico</h2>";
echo "<h3>Crea un perfil de usuario:</h3>";

// Completa las siguientes variables
$miNombre = "Tu Nombre Aquí";
$miEdad = 0;
$miSalarioAnual = 0.0;
$tengoMascota = false;
$misHobbies = [];

// Mostrar el perfil
echo "<strong>Mi Perfil:</strong><br>";
echo "Nombre: $miNombre<br>";
echo "Edad: $miEdad años<br>";
echo "Salario anual: $$miSalarioAnual<br>";
echo "¿Tengo mascota? " . ($tengoMascota ? "Sí" : "No") . "<br>";
echo "Mis hobbies: " . (empty($misHobbies) ? "No definidos" : implode(", ", $misHobbies)) . "<br>";

echo "<hr>";
echo "<p><strong>Para practicar:</strong> Modifica las variables anteriores con tus datos reales y ejecuta el archivo nuevamente.</p>";
?>
