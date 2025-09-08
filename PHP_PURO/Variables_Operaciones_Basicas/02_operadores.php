<?php
/**
 * EJERCICIO 2: Operadores Básicos en PHP
 * 
 * En este ejercicio aprenderás:
 * - Operadores aritméticos
 * - Operadores de comparación  
 * - Operadores lógicos
 * - Operadores de asignación
 */

echo "<h1>2. Operadores Básicos</h1>";

// ========================================
// 1. OPERADORES ARITMÉTICOS
// ========================================
echo "<h2>2.1 Operadores Aritméticos</h2>";

$a = 10;
$b = 3;

echo "a = $a, b = $b<br><br>";

// Suma
$suma = $a + $b;
echo "Suma: $a + $b = $suma<br>";

// Resta
$resta = $a - $b;
echo "Resta: $a - $b = $resta<br>";

// Multiplicación
$multiplicacion = $a * $b;
echo "Multiplicación: $a * $b = $multiplicacion<br>";

// División
$division = $a / $b;
echo "División: $a / $b = " . round($division, 2) . "<br>";

// Módulo (resto de la división)
$modulo = $a % $b;
echo "Módulo: $a % $b = $modulo<br>";

// Potencia (PHP 5.6+)
$potencia = $a ** $b;
echo "Potencia: $a ** $b = $potencia<br><br>";

// ========================================
// 2. OPERADORES DE COMPARACIÓN
// ========================================
echo "<h2>2.2 Operadores de Comparación</h2>";

$x = 5;
$y = "5";
$z = 10;

echo "x = $x (integer), y = '$y' (string), z = $z<br><br>";

// Igual (==) - compara valor
echo "x == y: " . ($x == $y ? "true" : "false") . " (mismo valor)<br>";

// Idéntico (===) - compara valor y tipo
echo "x === y: " . ($x === $y ? "true" : "false") . " (valor y tipo)<br>";

// Diferente (!=)
echo "x != z: " . ($x != $z ? "true" : "false") . "<br>";

// No idéntico (!==)
echo "x !== y: " . ($x !== $y ? "true" : "false") . " (diferente tipo)<br>";

// Mayor que
echo "z > x: " . ($z > $x ? "true" : "false") . "<br>";

// Mayor o igual que
echo "x >= 5: " . ($x >= 5 ? "true" : "false") . "<br>";

// Menor que
echo "x < z: " . ($x < $z ? "true" : "false") . "<br>";

// Menor o igual que
echo "x <= 5: " . ($x <= 5 ? "true" : "false") . "<br><br>";

// ========================================
// 3. OPERADORES LÓGICOS
// ========================================
echo "<h2>2.3 Operadores Lógicos</h2>";

$esMayorDeEdad = true;
$tienePermiso = false;
$tieneDinero = true;

echo "Es mayor de edad: " . ($esMayorDeEdad ? "true" : "false") . "<br>";
echo "Tiene permiso: " . ($tienePermiso ? "true" : "false") . "<br>";
echo "Tiene dinero: " . ($tieneDinero ? "true" : "false") . "<br><br>";

// AND (&&) - ambas condiciones deben ser verdaderas
$puedeConducir = $esMayorDeEdad && $tienePermiso;
echo "¿Puede conducir? (mayor de edad AND tiene permiso): " . ($puedeConducir ? "Sí" : "No") . "<br>";

// OR (||) - al menos una condición debe ser verdadera
$puedeComprar = $esMayorDeEdad || $tieneDinero;
echo "¿Puede comprar? (mayor de edad OR tiene dinero): " . ($puedeComprar ? "Sí" : "No") . "<br>";

// NOT (!) - invierte el valor boolean
$esmenorDeEdad = !$esMayorDeEdad;
echo "¿Es menor de edad? (NOT mayor de edad): " . ($esmenorDeEdad ? "Sí" : "No") . "<br><br>";

// ========================================
// 4. OPERADORES DE ASIGNACIÓN
// ========================================
echo "<h2>2.4 Operadores de Asignación</h2>";

$numero = 10;
echo "Valor inicial: $numero<br>";

// Suma y asignación
$numero += 5; // equivale a: $numero = $numero + 5
echo "Después de += 5: $numero<br>";

// Resta y asignación
$numero -= 3; // equivale a: $numero = $numero - 3
echo "Después de -= 3: $numero<br>";

// Multiplicación y asignación
$numero *= 2; // equivale a: $numero = $numero * 2
echo "Después de *= 2: $numero<br>";

// División y asignación
$numero /= 4; // equivale a: $numero = $numero / 4
echo "Después de /= 4: $numero<br>";

// Módulo y asignación
$numero %= 3; // equivale a: $numero = $numero % 3
echo "Después de %= 3: $numero<br><br>";

// ========================================
// 5. OPERADORES DE INCREMENTO Y DECREMENTO
// ========================================
echo "<h2>2.5 Incremento y Decremento</h2>";

$contador = 5;
echo "Contador inicial: $contador<br>";

// Pre-incremento
echo "Pre-incremento (++contador): " . (++$contador) . "<br>";
echo "Valor actual del contador: $contador<br>";

// Post-incremento
echo "Post-incremento (contador++): " . ($contador++) . "<br>";
echo "Valor actual del contador: $contador<br>";

// Pre-decremento
echo "Pre-decremento (--contador): " . (--$contador) . "<br>";
echo "Valor actual del contador: $contador<br>";

// Post-decremento
echo "Post-decremento (contador--): " . ($contador--) . "<br>";
echo "Valor actual del contador: $contador<br><br>";

// ========================================
// 6. OPERADOR TERNARIO
// ========================================
echo "<h2>2.6 Operador Ternario</h2>";

$edad = 18;
$mensaje = ($edad >= 18) ? "Eres mayor de edad" : "Eres menor de edad";
echo "Edad: $edad - $mensaje<br>";

$puntuacion = 85;
$nota = ($puntuacion >= 90) ? "A" : (($puntuacion >= 80) ? "B" : (($puntuacion >= 70) ? "C" : "D"));
echo "Puntuación: $puntuacion - Nota: $nota<br><br>";

// ========================================
// 7. OPERADOR DE FUSIÓN NULL (??) - PHP 7+
// ========================================
echo "<h2>2.7 Operador de Fusión NULL (??)</h2>";

$username = null;
$defaultUsername = "invitado";

// Si $username es null, usa $defaultUsername
$nombreUsuario = $username ?? $defaultUsername;
echo "Nombre de usuario: $nombreUsuario<br>";

// También funciona con variables no definidas
$nombreCompleto = $nombreNoDefinido ?? "Nombre no disponible";
echo "Nombre completo: $nombreCompleto<br><br>";

// ========================================
// 8. EJERCICIO PRÁCTICO
// ========================================
echo "<h2>2.8 Ejercicio Práctico: Calculadora Simple</h2>";

// Variables para la calculadora
$num1 = 15;
$num2 = 4;
$operacion = "+"; // Cambia esta operación: +, -, *, /, %

echo "Número 1: $num1<br>";
echo "Número 2: $num2<br>";
echo "Operación: $operacion<br><br>";

// Realizar la operación
$resultado = 0;
$operacionValida = true;

switch ($operacion) {
    case "+":
        $resultado = $num1 + $num2;
        break;
    case "-":
        $resultado = $num1 - $num2;
        break;
    case "*":
        $resultado = $num1 * $num2;
        break;
    case "/":
        if ($num2 != 0) {
            $resultado = $num1 / $num2;
        } else {
            $operacionValida = false;
            echo "<strong>Error:</strong> No se puede dividir por cero.<br>";
        }
        break;
    case "%":
        if ($num2 != 0) {
            $resultado = $num1 % $num2;
        } else {
            $operacionValida = false;
            echo "<strong>Error:</strong> No se puede calcular módulo con cero.<br>";
        }
        break;
    default:
        $operacionValida = false;
        echo "<strong>Error:</strong> Operación no válida.<br>";
}

if ($operacionValida) {
    echo "<strong>Resultado:</strong> $num1 $operacion $num2 = $resultado<br>";
}

echo "<hr>";
echo "<p><strong>Para practicar:</strong> Cambia los valores de \$num1, \$num2 y \$operacion para probar diferentes cálculos.</p>";
?>
