<?php
/**
 * EJERCICIO 6: Programación Orientada a Objetos en PHP
 * 
 * En este ejercicio aprenderás:
 * - Clases y objetos
 * - Propiedades y métodos
 * - Constructores y destructores
 * - Visibilidad (public, private, protected)
 * - Herencia
 * - Métodos y propiedades estáticas
 * - Interfaces y clases abstractas
 */

echo "<h1>6. Programación Orientada a Objetos</h1>";

// ========================================
// 1. CLASES Y OBJETOS BÁSICOS
// ========================================
echo "<h2>6.1 Clases y Objetos Básicos</h2>";

class Persona {
    // Propiedades
    public $nombre;
    public $edad;
    public $email;
    
    // Métodos
    public function saludar() {
        return "Hola, soy " . $this->nombre;
    }
    
    public function obtenerInformacion() {
        return "Nombre: " . $this->nombre . ", Edad: " . $this->edad . ", Email: " . $this->email;
    }
    
    public function cumplirAnios() {
        $this->edad++;
        return "¡Feliz cumpleaños! Ahora tienes " . $this->edad . " años.";
    }
}

// Crear objetos
$persona1 = new Persona();
$persona1->nombre = "Juan";
$persona1->edad = 25;
$persona1->email = "juan@email.com";

$persona2 = new Persona();
$persona2->nombre = "María";
$persona2->edad = 30;
$persona2->email = "maria@email.com";

echo $persona1->saludar() . "<br>";
echo $persona1->obtenerInformacion() . "<br>";
echo $persona1->cumplirAnios() . "<br><br>";

echo $persona2->saludar() . "<br>";
echo $persona2->obtenerInformacion() . "<br><br>";

// ========================================
// 2. CONSTRUCTORES Y DESTRUCTORES
// ========================================
echo "<h2>6.2 Constructores y Destructores</h2>";

class Producto {
    public $nombre;
    public $precio;
    public $categoria;
    
    // Constructor
    public function __construct($nombre, $precio, $categoria) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->categoria = $categoria;
        echo "Producto '{$this->nombre}' creado.<br>";
    }
    
    // Destructor
    public function __destruct() {
        echo "Producto '{$this->nombre}' destruido.<br>";
    }
    
    public function obtenerInfo() {
        return "Producto: {$this->nombre}, Precio: \${$this->precio}, Categoría: {$this->categoria}";
    }
    
    public function aplicarDescuento($porcentaje) {
        $descuento = $this->precio * ($porcentaje / 100);
        $this->precio -= $descuento;
        return "Descuento aplicado. Nuevo precio: \${$this->precio}";
    }
}

$laptop = new Producto("Laptop Gaming", 1200, "Electrónicos");
echo $laptop->obtenerInfo() . "<br>";
echo $laptop->aplicarDescuento(10) . "<br><br>";

// ========================================
// 3. VISIBILIDAD DE PROPIEDADES Y MÉTODOS
// ========================================
echo "<h2>6.3 Visibilidad (public, private, protected)</h2>";

class CuentaBancaria {
    public $titular;
    private $saldo;
    protected $numeroCuenta;
    
    public function __construct($titular, $saldoInicial = 0) {
        $this->titular = $titular;
        $this->saldo = $saldoInicial;
        $this->numeroCuenta = $this->generarNumeroCuenta();
        echo "Cuenta bancaria creada para {$this->titular}<br>";
    }
    
    // Método público
    public function depositar($cantidad) {
        if ($cantidad > 0) {
            $this->saldo += $cantidad;
            return "Depósito exitoso. Saldo actual: \${$this->saldo}";
        }
        return "La cantidad debe ser mayor a 0";
    }
    
    public function retirar($cantidad) {
        if ($cantidad > 0 && $cantidad <= $this->saldo) {
            $this->saldo -= $cantidad;
            return "Retiro exitoso. Saldo actual: \${$this->saldo}";
        }
        return "Fondos insuficientes o cantidad inválida";
    }
    
    public function obtenerSaldo() {
        return $this->saldo;
    }
    
    // Método privado (solo accesible dentro de esta clase)
    private function generarNumeroCuenta() {
        return "ACC-" . rand(100000, 999999);
    }
    
    // Método protegido (accesible en esta clase y sus hijas)
    protected function obtenerNumeroCuenta() {
        return $this->numeroCuenta;
    }
}

$cuenta = new CuentaBancaria("Ana García", 1000);
echo $cuenta->depositar(500) . "<br>";
echo $cuenta->retirar(200) . "<br>";
echo "Saldo final: \$" . $cuenta->obtenerSaldo() . "<br><br>";

// echo $cuenta->saldo; // Error: no se puede acceder a propiedades privadas
// echo $cuenta->generarNumeroCuenta(); // Error: no se puede acceder a métodos privados

// ========================================
// 4. HERENCIA
// ========================================
echo "<h2>6.4 Herencia</h2>";

// Clase padre
class Vehiculo {
    protected $marca;
    protected $modelo;
    protected $año;
    
    public function __construct($marca, $modelo, $año) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->año = $año;
    }
    
    public function obtenerInfo() {
        return "{$this->marca} {$this->modelo} ({$this->año})";
    }
    
    public function arrancar() {
        return "El vehículo está arrancando...";
    }
}

// Clase hija
class Automovil extends Vehiculo {
    private $puertas;
    private $combustible;
    
    public function __construct($marca, $modelo, $año, $puertas, $combustible) {
        parent::__construct($marca, $modelo, $año); // Llamar constructor del padre
        $this->puertas = $puertas;
        $this->combustible = $combustible;
    }
    
    // Sobrescribir método del padre
    public function obtenerInfo() {
        return parent::obtenerInfo() . " - {$this->puertas} puertas, {$this->combustible}";
    }
    
    // Método específico de la clase hija
    public function abrirMaletero() {
        return "Maletero abierto";
    }
}

class Motocicleta extends Vehiculo {
    private $cilindrada;
    
    public function __construct($marca, $modelo, $año, $cilindrada) {
        parent::__construct($marca, $modelo, $año);
        $this->cilindrada = $cilindrada;
    }
    
    public function obtenerInfo() {
        return parent::obtenerInfo() . " - {$this->cilindrada}cc";
    }
    
    public function hacerCaballito() {
        return "¡Haciendo caballito!";
    }
}

$auto = new Automovil("Toyota", "Corolla", 2022, 4, "Gasolina");
$moto = new Motocicleta("Yamaha", "R1", 2023, 1000);

echo "Auto: " . $auto->obtenerInfo() . "<br>";
echo $auto->arrancar() . "<br>";
echo $auto->abrirMaletero() . "<br><br>";

echo "Moto: " . $moto->obtenerInfo() . "<br>";
echo $moto->arrancar() . "<br>";
echo $moto->hacerCaballito() . "<br><br>";

// ========================================
// 5. MÉTODOS Y PROPIEDADES ESTÁTICAS
// ========================================
echo "<h2>6.5 Métodos y Propiedades Estáticas</h2>";

class Utilidades {
    public static $contador = 0;
    
    public static function incrementarContador() {
        self::$contador++;
    }
    
    public static function obtenerContador() {
        return self::$contador;
    }
    
    public static function calcularAreaCirculo($radio) {
        return 3.14159 * $radio * $radio;
    }
    
    public static function convertirTemperatura($temperatura, $de, $a) {
        // Convertir a Celsius primero
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
        
        // Convertir de Celsius a la unidad destino
        switch (strtoupper($a)) {
            case 'F':
                return ($celsius * 9/5) + 32;
            case 'K':
                return $celsius + 273.15;
            default:
                return $celsius;
        }
    }
}

// Usar métodos estáticos sin crear objetos
echo "Contador inicial: " . Utilidades::obtenerContador() . "<br>";
Utilidades::incrementarContador();
Utilidades::incrementarContador();
echo "Contador después de incrementar: " . Utilidades::obtenerContador() . "<br>";

echo "Área de círculo (radio 5): " . round(Utilidades::calcularAreaCirculo(5), 2) . "<br>";
echo "100°C a Fahrenheit: " . round(Utilidades::convertirTemperatura(100, 'C', 'F'), 2) . "°F<br><br>";

// ========================================
// 6. INTERFACES
// ========================================
echo "<h2>6.6 Interfaces</h2>";

interface Reproducible {
    public function reproducir();
    public function pausar();
    public function detener();
}

class ReproductorMusica implements Reproducible {
    private $cancionActual;
    private $estado;
    
    public function __construct($cancion) {
        $this->cancionActual = $cancion;
        $this->estado = 'detenido';
    }
    
    public function reproducir() {
        $this->estado = 'reproduciendo';
        return "Reproduciendo: {$this->cancionActual}";
    }
    
    public function pausar() {
        $this->estado = 'pausado';
        return "Pausado: {$this->cancionActual}";
    }
    
    public function detener() {
        $this->estado = 'detenido';
        return "Detenido";
    }
    
    public function obtenerEstado() {
        return "Estado: {$this->estado}";
    }
}

$reproductor = new ReproductorMusica("Bohemian Rhapsody");
echo $reproductor->reproducir() . "<br>";
echo $reproductor->obtenerEstado() . "<br>";
echo $reproductor->pausar() . "<br>";
echo $reproductor->detener() . "<br><br>";

// ========================================
// 7. CLASES ABSTRACTAS
// ========================================
echo "<h2>6.7 Clases Abstractas</h2>";

abstract class Forma {
    protected $color;
    
    public function __construct($color) {
        $this->color = $color;
    }
    
    public function obtenerColor() {
        return $this->color;
    }
    
    // Método abstracto que debe ser implementado por las clases hijas
    abstract public function calcularArea();
    abstract public function calcularPerimetro();
}

class Rectangulo extends Forma {
    private $ancho;
    private $alto;
    
    public function __construct($color, $ancho, $alto) {
        parent::__construct($color);
        $this->ancho = $ancho;
        $this->alto = $alto;
    }
    
    public function calcularArea() {
        return $this->ancho * $this->alto;
    }
    
    public function calcularPerimetro() {
        return 2 * ($this->ancho + $this->alto);
    }
}

class Circulo extends Forma {
    private $radio;
    
    public function __construct($color, $radio) {
        parent::__construct($color);
        $this->radio = $radio;
    }
    
    public function calcularArea() {
        return 3.14159 * $this->radio * $this->radio;
    }
    
    public function calcularPerimetro() {
        return 2 * 3.14159 * $this->radio;
    }
}

$rectangulo = new Rectangulo("azul", 5, 3);
$circulo = new Circulo("rojo", 4);

echo "Rectángulo {$rectangulo->obtenerColor()}: Área = " . $rectangulo->calcularArea() . ", Perímetro = " . $rectangulo->calcularPerimetro() . "<br>";
echo "Círculo {$circulo->obtenerColor()}: Área = " . round($circulo->calcularArea(), 2) . ", Perímetro = " . round($circulo->calcularPerimetro(), 2) . "<br><br>";

// ========================================
// 8. EJERCICIO PRÁCTICO: SISTEMA DE BIBLIOTECA
// ========================================
echo "<h2>6.8 Ejercicio Práctico: Sistema de Biblioteca</h2>";

abstract class Material {
    protected $titulo;
    protected $autor;
    protected $anioPublicacion;
    protected $disponible;
    
    public function __construct($titulo, $autor, $anioPublicacion) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anioPublicacion = $anioPublicacion;
        $this->disponible = true;
    }
    
    public function prestar() {
        if ($this->disponible) {
            $this->disponible = false;
            return "Material '{$this->titulo}' prestado exitosamente";
        }
        return "Material '{$this->titulo}' no disponible";
    }
    
    public function devolver() {
        $this->disponible = true;
        return "Material '{$this->titulo}' devuelto exitosamente";
    }
    
    public function estaDisponible() {
        return $this->disponible;
    }
    
    abstract public function obtenerInformacion();
    abstract public function obtenerTipo();
}

class Libro extends Material {
    private $isbn;
    private $paginas;
    
    public function __construct($titulo, $autor, $anioPublicacion, $isbn, $paginas) {
        parent::__construct($titulo, $autor, $anioPublicacion);
        $this->isbn = $isbn;
        $this->paginas = $paginas;
    }
    
    public function obtenerInformacion() {
        $estado = $this->disponible ? "Disponible" : "Prestado";
        return "Libro: {$this->titulo} por {$this->autor} ({$this->anioPublicacion}) - ISBN: {$this->isbn} - {$this->paginas} páginas - {$estado}";
    }
    
    public function obtenerTipo() {
        return "Libro";
    }
}

class Revista extends Material {
    private $numero;
    private $mes;
    
    public function __construct($titulo, $autor, $anioPublicacion, $numero, $mes) {
        parent::__construct($titulo, $autor, $anioPublicacion);
        $this->numero = $numero;
        $this->mes = $mes;
    }
    
    public function obtenerInformacion() {
        $estado = $this->disponible ? "Disponible" : "Prestado";
        return "Revista: {$this->titulo} por {$this->autor} - Número {$this->numero}, {$this->mes} {$this->anioPublicacion} - {$estado}";
    }
    
    public function obtenerTipo() {
        return "Revista";
    }
}

class Biblioteca {
    private $nombre;
    private $materiales;
    
    public function __construct($nombre) {
        $this->nombre = $nombre;
        $this->materiales = [];
    }
    
    public function agregarMaterial(Material $material) {
        $this->materiales[] = $material;
        return "Material agregado a {$this->nombre}";
    }
    
    public function listarMateriales() {
        echo "<h3>Catálogo de {$this->nombre}:</h3>";
        foreach ($this->materiales as $index => $material) {
            echo ($index + 1) . ". " . $material->obtenerInformacion() . "<br>";
        }
    }
    
    public function buscarDisponibles() {
        $disponibles = array_filter($this->materiales, function($material) {
            return $material->estaDisponible();
        });
        
        echo "<h3>Materiales Disponibles:</h3>";
        foreach ($disponibles as $material) {
            echo "- " . $material->obtenerInformacion() . "<br>";
        }
    }
    
    public function obtenerEstadisticas() {
        $total = count($this->materiales);
        $disponibles = count(array_filter($this->materiales, function($material) {
            return $material->estaDisponible();
        }));
        $prestados = $total - $disponibles;
        
        echo "<h3>Estadísticas de {$this->nombre}:</h3>";
        echo "Total de materiales: $total<br>";
        echo "Disponibles: $disponibles<br>";
        echo "Prestados: $prestados<br>";
    }
}

// Crear biblioteca
$biblioteca = new Biblioteca("Biblioteca Central");

// Agregar materiales
$libro1 = new Libro("Cien años de soledad", "Gabriel García Márquez", 1967, "978-84-376-0494-7", 471);
$libro2 = new Libro("1984", "George Orwell", 1949, "978-84-376-0495-4", 328);
$revista1 = new Revista("National Geographic", "Various", 2023, 12, "Diciembre");
$revista2 = new Revista("Scientific American", "Various", 2023, 11, "Noviembre");

echo $biblioteca->agregarMaterial($libro1) . "<br>";
echo $biblioteca->agregarMaterial($libro2) . "<br>";
echo $biblioteca->agregarMaterial($revista1) . "<br>";
echo $biblioteca->agregarMaterial($revista2) . "<br><br>";

// Mostrar catálogo
$biblioteca->listarMateriales();

// Prestar algunos materiales
echo "<br><h3>Préstamos:</h3>";
echo $libro1->prestar() . "<br>";
echo $revista1->prestar() . "<br>";

// Mostrar disponibles
echo "<br>";
$biblioteca->buscarDisponibles();

// Mostrar estadísticas
echo "<br>";
$biblioteca->obtenerEstadisticas();

echo "<hr>";
echo "<p><strong>Para practicar:</strong> Crea más clases como DVD, Audiolibro, etc., y extiende la funcionalidad de la biblioteca.</p>";
?>
