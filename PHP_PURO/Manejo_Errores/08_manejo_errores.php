<?php
/**
 * EJERCICIO 8: Manejo de Errores y Excepciones en PHP
 * 
 * En este ejercicio aprenderás:
 * - Try/Catch/Finally
 * - Tipos de excepciones
 * - Excepciones personalizadas
 * - Manejo de errores PHP tradicionales
 * - Logging y debugging
 * - Mejores prácticas
 */

echo "<h1>8. Manejo de Errores y Excepciones</h1>";

// ========================================
// 1. TRY/CATCH BÁSICO
// ========================================
echo "<h2>8.1 Try/Catch Básico</h2>";

echo "<h3>Sintaxis básica:</h3>";
echo "<pre>
try {
    // Código que puede generar una excepción
    \$resultado = division(10, 0);
} catch (Exception \$e) {
    // Manejar la excepción
    echo 'Error: ' . \$e->getMessage();
}
</pre>";

function division($a, $b) {
    if ($b == 0) {
        throw new Exception("División por cero no permitida");
    }
    return $a / $b;
}

echo "<h3>Ejemplo práctico:</h3>";
try {
    echo "Calculando 10 ÷ 2: " . division(10, 2) . "<br>";
    echo "Calculando 10 ÷ 0: " . division(10, 0) . "<br>"; // Esto generará excepción
    echo "Esta línea no se ejecutará<br>";
} catch (Exception $e) {
    echo "❌ Error capturado: " . $e->getMessage() . "<br>";
}

echo "El programa continúa ejecutándose...<br><br>";

// ========================================
// 2. MÚLTIPLES CATCH Y TIPOS DE EXCEPCIONES
// ========================================
echo "<h2>8.2 Múltiples Catch y Tipos de Excepciones</h2>";

function procesarNumero($numero) {
    if (!is_numeric($numero)) {
        throw new InvalidArgumentException("El valor debe ser numérico");
    }
    
    if ($numero < 0) {
        throw new OutOfRangeException("El número debe ser positivo");
    }
    
    if ($numero > 1000) {
        throw new OverflowException("El número es demasiado grande");
    }
    
    return sqrt($numero);
}

$valores = [25, "abc", -5, 1500, 100];

foreach ($valores as $valor) {
    try {
        $resultado = procesarNumero($valor);
        echo "✅ Raíz de $valor = " . round($resultado, 2) . "<br>";
    } catch (InvalidArgumentException $e) {
        echo "❌ Argumento inválido para '$valor': " . $e->getMessage() . "<br>";
    } catch (OutOfRangeException $e) {
        echo "❌ Fuera de rango para '$valor': " . $e->getMessage() . "<br>";
    } catch (OverflowException $e) {
        echo "❌ Overflow para '$valor': " . $e->getMessage() . "<br>";
    } catch (Exception $e) {
        echo "❌ Error general para '$valor': " . $e->getMessage() . "<br>";
    }
}

echo "<br>";

// ========================================
// 3. FINALLY
// ========================================
echo "<h2>8.3 Bloque Finally</h2>";

function conectarBaseDatos($host) {
    echo "Intentando conectar a $host...<br>";
    
    if ($host === "servidor_caido") {
        throw new Exception("No se pudo conectar al servidor");
    }
    
    echo "Conexión exitosa a $host<br>";
    return "connection_$host";
}

function procesarConBaseDatos($host) {
    $conexion = null;
    
    try {
        $conexion = conectarBaseDatos($host);
        echo "Ejecutando consultas...<br>";
        // Simular trabajo con base de datos
        return "Datos procesados correctamente";
        
    } catch (Exception $e) {
        echo "Error en base de datos: " . $e->getMessage() . "<br>";
        return false;
        
    } finally {
        // Este bloque SIEMPRE se ejecuta
        if ($conexion) {
            echo "Cerrando conexión a base de datos<br>";
        } else {
            echo "Limpiando recursos...<br>";
        }
        echo "Finally ejecutado<br>";
    }
}

echo "<h3>Conexión exitosa:</h3>";
$resultado1 = procesarConBaseDatos("localhost");
echo "Resultado: " . ($resultado1 ?: "Sin resultado") . "<br><br>";

echo "<h3>Conexión fallida:</h3>";
$resultado2 = procesarConBaseDatos("servidor_caido");
echo "Resultado: " . ($resultado2 ?: "Sin resultado") . "<br><br>";

// ========================================
// 4. EXCEPCIONES PERSONALIZADAS
// ========================================
echo "<h2>8.4 Excepciones Personalizadas</h2>";

class ValidationException extends Exception {
    private $field;
    private $value;
    
    public function __construct($message, $field = null, $value = null, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->field = $field;
        $this->value = $value;
    }
    
    public function getField() {
        return $this->field;
    }
    
    public function getValue() {
        return $this->value;
    }
    
    public function getDetailedMessage() {
        return "Error de validación en campo '{$this->field}' con valor '{$this->value}': {$this->getMessage()}";
    }
}

class DatabaseException extends Exception {
    private $query;
    
    public function __construct($message, $query = null, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->query = $query;
    }
    
    public function getQuery() {
        return $this->query;
    }
}

class User {
    private $name;
    private $email;
    private $age;
    
    public function __construct($name, $email, $age) {
        $this->validateName($name);
        $this->validateEmail($email);
        $this->validateAge($age);
        
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
    }
    
    private function validateName($name) {
        if (empty($name)) {
            throw new ValidationException("El nombre es requerido", "name", $name);
        }
        if (strlen($name) < 2) {
            throw new ValidationException("El nombre debe tener al menos 2 caracteres", "name", $name);
        }
    }
    
    private function validateEmail($email) {
        if (empty($email)) {
            throw new ValidationException("El email es requerido", "email", $email);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException("El email no es válido", "email", $email);
        }
    }
    
    private function validateAge($age) {
        if (!is_numeric($age)) {
            throw new ValidationException("La edad debe ser numérica", "age", $age);
        }
        if ($age < 0 || $age > 120) {
            throw new ValidationException("La edad debe estar entre 0 y 120 años", "age", $age);
        }
    }
    
    public function save() {
        // Simular error de base de datos
        if (rand(1, 3) === 1) {
            throw new DatabaseException(
                "Error al insertar usuario en la base de datos",
                "INSERT INTO users (name, email, age) VALUES ('{$this->name}', '{$this->email}', {$this->age})"
            );
        }
        
        return "Usuario '{$this->name}' guardado exitosamente";
    }
    
    public function getName() {
        return $this->name;
    }
}

// Probar excepciones personalizadas
$usuarios = [
    ["", "email@test.com", 25],           // Nombre vacío
    ["Ana", "email-invalido", 25],        // Email inválido
    ["Carlos", "carlos@test.com", "abc"], // Edad no numérica
    ["María", "maria@test.com", -5],      // Edad negativa
    ["Juan", "juan@test.com", 25],        // Usuario válido
];

foreach ($usuarios as $index => $datos) {
    echo "<h4>Usuario " . ($index + 1) . ":</h4>";
    try {
        list($name, $email, $age) = $datos;
        $user = new User($name, $email, $age);
        echo "✅ Usuario creado: " . $user->getName() . "<br>";
        
        // Intentar guardar
        $result = $user->save();
        echo "✅ $result<br>";
        
    } catch (ValidationException $e) {
        echo "❌ " . $e->getDetailedMessage() . "<br>";
    } catch (DatabaseException $e) {
        echo "❌ Error de base de datos: " . $e->getMessage() . "<br>";
        echo "Query: " . $e->getQuery() . "<br>";
    } catch (Exception $e) {
        echo "❌ Error inesperado: " . $e->getMessage() . "<br>";
    }
    echo "<br>";
}

// ========================================
// 5. MANEJO DE ERRORES PHP TRADICIONALES
// ========================================
echo "<h2>8.5 Manejo de Errores PHP Tradicionales</h2>";

echo "<h3>Configuración de errores:</h3>";
echo "<pre>
// Mostrar todos los errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// No mostrar errores (producción)
error_reporting(0);
ini_set('display_errors', 0);
</pre>";

// Custom error handler
function customErrorHandler($severity, $message, $file, $line) {
    $errorTypes = [
        E_ERROR => 'ERROR',
        E_WARNING => 'WARNING',
        E_NOTICE => 'NOTICE',
        E_USER_ERROR => 'USER ERROR',
        E_USER_WARNING => 'USER WARNING',
        E_USER_NOTICE => 'USER NOTICE'
    ];
    
    $type = isset($errorTypes[$severity]) ? $errorTypes[$severity] : 'UNKNOWN';
    
    echo "<div style='color: red; background: #ffe6e6; padding: 10px; margin: 5px; border: 1px solid red;'>";
    echo "<strong>[$type]</strong> $message<br>";
    echo "<small>Archivo: $file, Línea: $line</small>";
    echo "</div>";
    
    // Log del error (en producción)
    error_log("[$type] $message en $file:$line");
    
    // No detener la ejecución para warnings y notices
    if ($severity === E_ERROR || $severity === E_USER_ERROR) {
        die("Error fatal detectado");
    }
}

// Registrar el error handler personalizado
set_error_handler('customErrorHandler');

echo "<h3>Generando diferentes tipos de errores:</h3>";

// Notice
echo "Variable no definida: " . @$variableNoDefinida . "<br>";

// Warning (comentado para no romper el ejemplo)
// include 'archivo_no_existe.php';

// User error
trigger_error("Este es un error personalizado", E_USER_WARNING);

echo "<br>";

// ========================================
// 6. LOGGING Y DEBUGGING
// ========================================
echo "<h2>8.6 Logging y Debugging</h2>";

class Logger {
    private $logFile;
    
    public function __construct($logFile = 'app.log') {
        $this->logFile = $logFile;
    }
    
    public function log($level, $message, $context = []) {
        $timestamp = date('Y-m-d H:i:s');
        $contextStr = !empty($context) ? ' ' . json_encode($context) : '';
        $logEntry = "[$timestamp] [$level] $message$contextStr" . PHP_EOL;
        
        // En un caso real, escribiríamos al archivo
        // file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
        
        // Para el ejemplo, mostramos en pantalla
        echo "<div style='font-family: monospace; background: #f0f0f0; padding: 5px; margin: 2px;'>";
        echo htmlspecialchars($logEntry);
        echo "</div>";
    }
    
    public function info($message, $context = []) {
        $this->log('INFO', $message, $context);
    }
    
    public function warning($message, $context = []) {
        $this->log('WARNING', $message, $context);
    }
    
    public function error($message, $context = []) {
        $this->log('ERROR', $message, $context);
    }
    
    public function debug($message, $context = []) {
        $this->log('DEBUG', $message, $context);
    }
}

class OrderService {
    private $logger;
    
    public function __construct($logger) {
        $this->logger = $logger;
    }
    
    public function processOrder($orderData) {
        $this->logger->info("Iniciando procesamiento de orden", ['order_id' => $orderData['id']]);
        
        try {
            $this->validateOrder($orderData);
            $this->logger->debug("Orden validada", ['order_id' => $orderData['id']]);
            
            $this->calculateTotal($orderData);
            $this->logger->debug("Total calculado", [
                'order_id' => $orderData['id'],
                'total' => $orderData['total']
            ]);
            
            $this->chargePayment($orderData);
            $this->logger->info("Pago procesado", [
                'order_id' => $orderData['id'],
                'amount' => $orderData['total']
            ]);
            
            return "Orden {$orderData['id']} procesada exitosamente";
            
        } catch (ValidationException $e) {
            $this->logger->error("Error de validación", [
                'order_id' => $orderData['id'],
                'field' => $e->getField(),
                'message' => $e->getMessage()
            ]);
            throw $e;
            
        } catch (Exception $e) {
            $this->logger->error("Error inesperado", [
                'order_id' => $orderData['id'],
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
    
    private function validateOrder($orderData) {
        if (empty($orderData['id'])) {
            throw new ValidationException("ID de orden requerido", "id", $orderData['id']);
        }
        if (empty($orderData['items'])) {
            throw new ValidationException("La orden debe tener items", "items", $orderData['items']);
        }
    }
    
    private function calculateTotal(&$orderData) {
        $total = 0;
        foreach ($orderData['items'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $orderData['total'] = $total;
    }
    
    private function chargePayment($orderData) {
        // Simular error de pago ocasional
        if (rand(1, 4) === 1) {
            throw new Exception("Error en el procesamiento del pago");
        }
    }
}

echo "<h3>Ejemplo de logging en acción:</h3>";

$logger = new Logger();
$orderService = new OrderService($logger);

$ordenes = [
    [
        'id' => 'ORD-001',
        'items' => [
            ['name' => 'Laptop', 'price' => 1000, 'quantity' => 1],
            ['name' => 'Mouse', 'price' => 25, 'quantity' => 2]
        ]
    ],
    [
        'id' => '',
        'items' => []
    ],
    [
        'id' => 'ORD-003',
        'items' => [
            ['name' => 'Teclado', 'price' => 75, 'quantity' => 1]
        ]
    ]
];

foreach ($ordenes as $orden) {
    echo "<h4>Procesando orden:</h4>";
    try {
        $resultado = $orderService->processOrder($orden);
        echo "<p style='color: green;'>✅ $resultado</p>";
    } catch (Exception $e) {
        echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
    }
    echo "<br>";
}

// ========================================
// 7. MEJORES PRÁCTICAS
// ========================================
echo "<h2>8.7 Mejores Prácticas</h2>";

echo "<h3>✅ Buenas prácticas:</h3>";
echo "<ol>";
echo "<li><strong>Específico vs General:</strong> Captura excepciones específicas antes que generales</li>";
echo "<li><strong>No captures y ignores:</strong> Si capturas una excepción, haz algo con ella</li>";
echo "<li><strong>Log errores:</strong> Registra errores para debugging posterior</li>";
echo "<li><strong>Limpieza de recursos:</strong> Usa finally para limpiar recursos</li>";
echo "<li><strong>Excepciones personalizadas:</strong> Crea excepciones específicas para tu dominio</li>";
echo "<li><strong>No uses excepciones para control de flujo:</strong> Son para errores excepcionales</li>";
echo "<li><strong>Información útil:</strong> Incluye contexto útil en tus mensajes de error</li>";
echo "</ol>";

echo "<h3>❌ Malas prácticas:</h3>";
echo "<pre>
// MAL: Capturar y no hacer nada
try {
    riskOperation();
} catch (Exception \$e) {
    // Silencioso - nunca hagas esto
}

// MAL: Demasiado genérico
try {
    complexOperation();
} catch (Exception \$e) {
    echo 'Algo salió mal';
}

// BIEN: Específico y útil
try {
    \$user = createUser(\$data);
} catch (ValidationException \$e) {
    \$logger->warning('Datos de usuario inválidos', [
        'field' => \$e->getField(),
        'value' => \$e->getValue()
    ]);
    throw new ApiException('Datos inválidos: ' . \$e->getMessage(), 400);
} catch (DatabaseException \$e) {
    \$logger->error('Error de base de datos', ['query' => \$e->getQuery()]);
    throw new ApiException('Error interno del servidor', 500);
}
</pre>";

echo "<hr>";
echo "<p><strong>Para practicar:</strong></p>";
echo "<ul>";
echo "<li>Crea más excepciones personalizadas para diferentes dominios</li>";
echo "<li>Implementa un sistema de logging completo</li>";
echo "<li>Practica el debugging con var_dump, print_r y herramientas como Xdebug</li>";
echo "<li>Estudia cómo Laravel maneja excepciones y errores</li>";
echo "</ul>";

// Finalizar el manejo de errores personalizado
restore_error_handler();

echo "<h3>🎉 ¡Felicitaciones!</h3>";
echo "<p>Has completado todos los ejercicios básicos de PHP. Ahora estás listo para adentrarte en Laravel con una base sólida.</p>";

// Marcar como completado
echo "<script>console.log('Ejercicios de PHP completados');</script>";
?>
