<?php
/**
 * EJERCICIO 5: Arrays y Manipulación en PHP
 * 
 * En este ejercicio aprenderás:
 * - Arrays indexados y asociativos
 * - Arrays multidimensionales
 * - Funciones para manipular arrays
 * - Recorrido y búsqueda en arrays
 * - Ordenamiento de arrays
 */

echo "<h1>5. Arrays y Manipulación</h1>";

// ========================================
// 1. ARRAYS INDEXADOS
// ========================================
echo "<h2>5.1 Arrays Indexados</h2>";

// Diferentes formas de crear arrays indexados
$frutas = ["manzana", "plátano", "naranja"];
$numeros = array(1, 2, 3, 4, 5);
$colores = [];
$colores[0] = "rojo";
$colores[1] = "verde";
$colores[2] = "azul";

echo "Frutas: " . implode(", ", $frutas) . "<br>";
echo "Números: " . implode(", ", $numeros) . "<br>";
echo "Colores: " . implode(", ", $colores) . "<br>";

// Acceder a elementos
echo "Primera fruta: " . $frutas[0] . "<br>";
echo "Último número: " . $numeros[count($numeros) - 1] . "<br>";
echo "Segundo color: " . $colores[1] . "<br><br>";

// ========================================
// 2. ARRAYS ASOCIATIVOS
// ========================================
echo "<h2>5.2 Arrays Asociativos</h2>";

$persona = [
    "nombre" => "Ana García",
    "edad" => 28,
    "email" => "ana@email.com",
    "ciudad" => "Madrid"
];

$producto = array(
    "id" => 101,
    "nombre" => "Laptop",
    "precio" => 899.99,
    "categoria" => "Electrónicos"
);

echo "Persona:<br>";
foreach ($persona as $clave => $valor) {
    echo ucfirst($clave) . ": $valor<br>";
}

echo "<br>Producto:<br>";
echo "ID: " . $producto["id"] . "<br>";
echo "Nombre: " . $producto["nombre"] . "<br>";
echo "Precio: $" . $producto["precio"] . "<br>";
echo "Categoría: " . $producto["categoria"] . "<br><br>";

// ========================================
// 3. ARRAYS MULTIDIMENSIONALES
// ========================================
echo "<h2>5.3 Arrays Multidimensionales</h2>";

$estudiantes = [
    [
        "nombre" => "Juan",
        "edad" => 20,
        "notas" => [85, 90, 78]
    ],
    [
        "nombre" => "María",
        "edad" => 19,
        "notas" => [92, 88, 95]
    ],
    [
        "nombre" => "Pedro",
        "edad" => 21,
        "notas" => [76, 82, 80]
    ]
];

echo "Información de estudiantes:<br>";
foreach ($estudiantes as $indice => $estudiante) {
    $promedio = array_sum($estudiante["notas"]) / count($estudiante["notas"]);
    echo ($indice + 1) . ". " . $estudiante["nombre"] . " (" . $estudiante["edad"] . " años)<br>";
    echo "   Notas: " . implode(", ", $estudiante["notas"]) . "<br>";
    echo "   Promedio: " . round($promedio, 2) . "<br><br>";
}

// ========================================
// 4. FUNCIONES BÁSICAS DE ARRAYS
// ========================================
echo "<h2>5.4 Funciones Básicas de Arrays</h2>";

$numeros = [5, 2, 8, 1, 9, 3];

echo "Array original: " . implode(", ", $numeros) . "<br>";
echo "Cantidad de elementos: " . count($numeros) . "<br>";
echo "Suma total: " . array_sum($numeros) . "<br>";
echo "Valor máximo: " . max($numeros) . "<br>";
echo "Valor mínimo: " . min($numeros) . "<br>";
echo "¿Existe el 8? " . (in_array(8, $numeros) ? "Sí" : "No") . "<br>";
echo "Posición del 8: " . array_search(8, $numeros) . "<br><br>";

// ========================================
// 5. AGREGAR Y QUITAR ELEMENTOS
// ========================================
echo "<h2>5.5 Agregar y Quitar Elementos</h2>";

$lista = ["a", "b", "c"];
echo "Lista inicial: " . implode(", ", $lista) . "<br>";

// Agregar al final
array_push($lista, "d");
echo "Después de push('d'): " . implode(", ", $lista) . "<br>";

// Agregar al inicio
array_unshift($lista, "z");
echo "Después de unshift('z'): " . implode(", ", $lista) . "<br>";

// Quitar del final
$ultimo = array_pop($lista);
echo "Después de pop() (quitó '$ultimo'): " . implode(", ", $lista) . "<br>";

// Quitar del inicio
$primero = array_shift($lista);
echo "Después de shift() (quitó '$primero'): " . implode(", ", $lista) . "<br><br>";

// ========================================
// 6. ORDENAMIENTO DE ARRAYS
// ========================================
echo "<h2>5.6 Ordenamiento de Arrays</h2>";

$numeros = [5, 2, 8, 1, 9, 3];
$nombres = ["Carlos", "Ana", "Pedro", "Beatriz"];

// Ordenar números
$numerosAsc = $numeros;
sort($numerosAsc);
echo "Números ordenados ascendente: " . implode(", ", $numerosAsc) . "<br>";

$numerosDesc = $numeros;
rsort($numerosDesc);
echo "Números ordenados descendente: " . implode(", ", $numerosDesc) . "<br>";

// Ordenar strings
$nombresAsc = $nombres;
sort($nombresAsc);
echo "Nombres ordenados: " . implode(", ", $nombresAsc) . "<br>";

// Ordenar array asociativo por valores
$edades = ["Ana" => 25, "Carlos" => 30, "Pedro" => 20, "Beatriz" => 35];
echo "<br>Edades originales:<br>";
foreach ($edades as $nombre => $edad) {
    echo "$nombre: $edad años<br>";
}

asort($edades); // Mantiene las claves
echo "<br>Ordenado por edad (asort):<br>";
foreach ($edades as $nombre => $edad) {
    echo "$nombre: $edad años<br>";
}

ksort($edades); // Ordenar por claves
echo "<br>Ordenado por nombre (ksort):<br>";
foreach ($edades as $nombre => $edad) {
    echo "$nombre: $edad años<br>";
}
echo "<br>";

// ========================================
// 7. FUNCIONES AVANZADAS DE ARRAYS
// ========================================
echo "<h2>5.7 Funciones Avanzadas</h2>";

$numeros = [1, 2, 3, 4, 5];

// array_map: aplica una función a cada elemento
$cuadrados = array_map(function($n) {
    return $n * $n;
}, $numeros);
echo "Números: " . implode(", ", $numeros) . "<br>";
echo "Cuadrados: " . implode(", ", $cuadrados) . "<br>";

// array_filter: filtra elementos según una condición
$pares = array_filter($numeros, function($n) {
    return $n % 2 == 0;
});
echo "Números pares: " . implode(", ", $pares) . "<br>";

// array_reduce: reduce el array a un solo valor
$suma = array_reduce($numeros, function($carry, $item) {
    return $carry + $item;
}, 0);
echo "Suma usando reduce: $suma<br>";

// array_merge: combinar arrays
$array1 = [1, 2, 3];
$array2 = [4, 5, 6];
$combinado = array_merge($array1, $array2);
echo "Arrays combinados: " . implode(", ", $combinado) . "<br>";

// array_slice: extraer una porción del array
$porcion = array_slice($numeros, 1, 3);
echo "Porción (índice 1, 3 elementos): " . implode(", ", $porcion) . "<br><br>";

// ========================================
// 8. ARRAYS Y JSON
// ========================================
echo "<h2>5.8 Arrays y JSON</h2>";

$datos = [
    "usuario" => "admin",
    "activo" => true,
    "roles" => ["administrador", "editor"],
    "configuracion" => [
        "tema" => "oscuro",
        "idioma" => "es"
    ]
];

// Convertir array a JSON
$json = json_encode($datos, JSON_PRETTY_PRINT);
echo "Array convertido a JSON:<br>";
echo "<pre>$json</pre>";

// Convertir JSON a array
$arrayDesdeJson = json_decode($json, true);
echo "JSON convertido de vuelta a array:<br>";
print_r($arrayDesdeJson);
echo "<br>";

// ========================================
// 9. EJERCICIO PRÁCTICO: SISTEMA DE INVENTARIO
// ========================================
echo "<h2>5.9 Ejercicio Práctico: Sistema de Inventario</h2>";

$inventario = [
    [
        "id" => 1,
        "nombre" => "Laptop",
        "categoria" => "Electrónicos",
        "precio" => 899.99,
        "stock" => 15
    ],
    [
        "id" => 2,
        "nombre" => "Mouse",
        "categoria" => "Accesorios",
        "precio" => 29.99,
        "stock" => 50
    ],
    [
        "id" => 3,
        "nombre" => "Teclado",
        "categoria" => "Accesorios",
        "precio" => 79.99,
        "stock" => 25
    ],
    [
        "id" => 4,
        "nombre" => "Monitor",
        "categoria" => "Electrónicos",
        "precio" => 299.99,
        "stock" => 8
    ],
    [
        "id" => 5,
        "nombre" => "Impresora",
        "categoria" => "Oficina",
        "precio" => 199.99,
        "stock" => 5
    ]
];

// Función para mostrar el inventario
function mostrarInventario($productos) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Valor Total</th></tr>";
    
    $valorTotalInventario = 0;
    
    foreach ($productos as $producto) {
        $valorTotal = $producto["precio"] * $producto["stock"];
        $valorTotalInventario += $valorTotal;
        
        echo "<tr>";
        echo "<td>" . $producto["id"] . "</td>";
        echo "<td>" . $producto["nombre"] . "</td>";
        echo "<td>" . $producto["categoria"] . "</td>";
        echo "<td>$" . number_format($producto["precio"], 2) . "</td>";
        echo "<td>" . $producto["stock"] . "</td>";
        echo "<td>$" . number_format($valorTotal, 2) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "<strong>Valor total del inventario: $" . number_format($valorTotalInventario, 2) . "</strong><br><br>";
}

echo "<h3>Inventario Completo:</h3>";
mostrarInventario($inventario);

// Filtrar productos por categoría
function filtrarPorCategoria($productos, $categoria) {
    return array_filter($productos, function($producto) use ($categoria) {
        return $producto["categoria"] === $categoria;
    });
}

$electronicos = filtrarPorCategoria($inventario, "Electrónicos");
echo "<h3>Productos Electrónicos:</h3>";
mostrarInventario($electronicos);

// Productos con stock bajo (menos de 10)
$stockBajo = array_filter($inventario, function($producto) {
    return $producto["stock"] < 10;
});

echo "<h3>Productos con Stock Bajo (< 10):</h3>";
if (empty($stockBajo)) {
    echo "No hay productos con stock bajo.<br>";
} else {
    mostrarInventario($stockBajo);
}

// Ordenar por precio (más caro primero)
$inventarioOrdenado = $inventario;
usort($inventarioOrdenado, function($a, $b) {
    return $b["precio"] <=> $a["precio"];
});

echo "<h3>Productos Ordenados por Precio (Mayor a Menor):</h3>";
mostrarInventario($inventarioOrdenado);

// Estadísticas del inventario
$precios = array_column($inventario, 'precio');
$stocks = array_column($inventario, 'stock');

echo "<h3>Estadísticas del Inventario:</h3>";
echo "Total de productos: " . count($inventario) . "<br>";
echo "Precio promedio: $" . number_format(array_sum($precios) / count($precios), 2) . "<br>";
echo "Precio más alto: $" . number_format(max($precios), 2) . "<br>";
echo "Precio más bajo: $" . number_format(min($precios), 2) . "<br>";
echo "Stock total: " . array_sum($stocks) . " unidades<br>";
echo "Stock promedio: " . round(array_sum($stocks) / count($stocks), 2) . " unidades<br>";

echo "<hr>";
echo "<p><strong>Para practicar:</strong> Agrega más productos al inventario y prueba las diferentes funciones de filtrado y ordenamiento.</p>";
?>
