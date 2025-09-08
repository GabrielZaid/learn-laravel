<?php
/**
 * EJERCICIO 7: Namespaces e Importación en PHP
 * 
 * En este ejercicio aprenderás:
 * - Inclusión de archivos: include, require
 * - Namespaces en PHP
 * - Use statements
 * - Autoloading
 * - PSR-4 autoloading estándar
 * - Composer (conceptos básicos)
 */

echo "<h1>7. Namespaces e Importación</h1>";

// ========================================
// 1. INCLUSIÓN DE ARCHIVOS
// ========================================
echo "<h2>7.1 Inclusión de Archivos (include, require)</h2>";

echo "<h3>Diferencias entre include/require:</h3>";
echo "<ul>";
echo "<li><strong>include:</strong> Si el archivo no existe, muestra warning pero continúa</li>";
echo "<li><strong>require:</strong> Si el archivo no existe, muestra error fatal y detiene</li>";
echo "<li><strong>include_once/require_once:</strong> Solo incluye una vez el archivo</li>";
echo "</ul>";

// Vamos a crear algunos archivos de ejemplo primero
echo "<p>Creando archivos de ejemplo para demostrar la inclusión...</p>";

// Este contenido se guarda en un archivo separado
$configuracion = '<?php
// Archivo: configuracion.php
define("NOMBRE_APP", "Mi Aplicación");
define("VERSION", "1.0.0");

$config = [
    "base_url" => "http://localhost",
    "db_host" => "localhost",
    "db_name" => "mi_app",
    "db_user" => "usuario",
    "db_pass" => "password"
];

function obtenerConfiguracion($clave) {
    global $config;
    return isset($config[$clave]) ? $config[$clave] : null;
}

echo "Archivo de configuración cargado<br>";
?>';

echo "<p><strong>Ejemplo de uso de require:</strong></p>";
echo "<pre>
// require 'configuracion.php';
// echo NOMBRE_APP . ' v' . VERSION;
// echo 'Base URL: ' . obtenerConfiguracion('base_url');
</pre>";

// ========================================
// 2. NAMESPACES BÁSICOS
// ========================================
echo "<h2>7.2 Namespaces Básicos</h2>";

echo "<h3>¿Qué son los Namespaces?</h3>";
echo "<p>Los namespaces permiten organizar clases, funciones y constantes en grupos lógicos, evitando conflictos de nombres.</p>";

echo "<h3>Ejemplo de Namespace:</h3>";
echo "<pre>
&lt;?php
namespace MiApp\\Modelos;

class Usuario {
    public function obtenerNombre() {
        return 'Juan Pérez';
    }
}

namespace MiApp\\Controladores;

class Usuario {
    public function mostrarPerfil() {
        return 'Mostrando perfil de usuario';
    }
}
</pre>";

// Simulamos namespaces con clases aquí
echo "<h3>Implementación práctica (simulada):</h3>";

// Simularemos diferentes namespaces
class Usuario_Modelo {
    public function obtenerNombre() {
        return 'Juan Pérez';
    }
    
    public function obtenerEmail() {
        return 'juan@email.com';
    }
}

class Usuario_Controlador {
    private $modelo;
    
    public function __construct() {
        $this->modelo = new Usuario_Modelo();
    }
    
    public function mostrarPerfil() {
        return 'Perfil: ' . $this->modelo->obtenerNombre() . ' (' . $this->modelo->obtenerEmail() . ')';
    }
}

$controlador = new Usuario_Controlador();
echo $controlador->mostrarPerfil() . "<br><br>";

// ========================================
// 3. NAMESPACE EN ACCIÓN
// ========================================
echo "<h2>7.3 Trabajando con Namespaces</h2>";

echo "<h3>Estructura de archivos típica:</h3>";
echo "<pre>
src/
├── Modelos/
│   ├── Usuario.php
│   └── Producto.php
├── Controladores/
│   ├── UsuarioControlador.php
│   └── ProductoControlador.php
├── Servicios/
│   ├── EmailService.php
│   └── LogService.php
└── Utilidades/
    ├── Validador.php
    └── Helper.php
</pre>";

echo "<h3>Ejemplo de archivo con namespace:</h3>";
echo "<pre>
&lt;?php
// src/Modelos/Usuario.php
namespace MiApp\\Modelos;

class Usuario {
    private \$nombre;
    private \$email;
    
    public function __construct(\$nombre, \$email) {
        \$this->nombre = \$nombre;
        \$this->email = \$email;
    }
    
    public function obtenerNombre() {
        return \$this->nombre;
    }
    
    public function obtenerEmail() {
        return \$this->email;
    }
}
</pre>";

echo "<h3>Usando la clase con namespace completo:</h3>";
echo "<pre>
&lt;?php
require_once 'src/Modelos/Usuario.php';

\$usuario = new MiApp\\Modelos\\Usuario('Ana', 'ana@email.com');
echo \$usuario->obtenerNombre();
</pre>";

// ========================================
// 4. USE STATEMENTS
// ========================================
echo "<h2>7.4 Use Statements</h2>";

echo "<h3>Importar clases con 'use':</h3>";
echo "<pre>
&lt;?php
use MiApp\\Modelos\\Usuario;
use MiApp\\Servicios\\EmailService;

// Ahora podemos usar las clases directamente
\$usuario = new Usuario('Ana', 'ana@email.com');
\$emailService = new EmailService();
</pre>";

echo "<h3>Alias con 'as':</h3>";
echo "<pre>
&lt;?php
use MiApp\\Modelos\\Usuario as UsuarioModelo;
use MiApp\\Controladores\\Usuario as UsuarioControlador;

\$modelo = new UsuarioModelo('Ana', 'ana@email.com');
\$controlador = new UsuarioControlador();
</pre>";

echo "<h3>Importar múltiples clases del mismo namespace:</h3>";
echo "<pre>
&lt;?php
use MiApp\\Modelos\\{Usuario, Producto, Categoria};

\$usuario = new Usuario('Ana', 'ana@email.com');
\$producto = new Producto('Laptop', 1200);
\$categoria = new Categoria('Electrónicos');
</pre>";

// ========================================
// 5. AUTOLOADING
// ========================================
echo "<h2>7.5 Autoloading</h2>";

echo "<h3>¿Qué es Autoloading?</h3>";
echo "<p>Autoloading permite cargar clases automáticamente cuando se necesitan, sin usar require/include explícitos.</p>";

echo "<h3>Función __autoload() (deprecada):</h3>";
echo "<pre>
&lt;?php
function __autoload(\$className) {
    \$file = str_replace('\\\\', '/', \$className) . '.php';
    require_once \$file;
}
</pre>";

echo "<h3>spl_autoload_register() (recomendado):</h3>";
echo "<pre>
&lt;?php
spl_autoload_register(function(\$className) {
    // Convertir namespace a ruta de archivo
    \$file = __DIR__ . '/src/' . str_replace('\\\\', '/', \$className) . '.php';
    
    if (file_exists(\$file)) {
        require_once \$file;
    }
});

// Ahora las clases se cargan automáticamente
\$usuario = new MiApp\\Modelos\\Usuario('Ana', 'ana@email.com');
</pre>";

// Ejemplo práctico de autoloading
echo "<h3>Ejemplo práctico de autoloading:</h3>";

// Simulamos un autoloader simple
function miAutoloader($className) {
    // Convertir el nombre de la clase a una ruta de archivo
    $parts = explode('_', $className);
    $filename = end($parts) . '.php';
    
    echo "Autoloader intentando cargar: $className desde $filename<br>";
    
    // En un caso real, aquí cargaríamos el archivo
    // require_once $filename;
}

// Registrar nuestro autoloader
spl_autoload_register('miAutoloader');

echo "Autoloader registrado. En un caso real, las clases se cargarían automáticamente.<br><br>";

// ========================================
// 6. PSR-4 AUTOLOADING ESTÁNDAR
// ========================================
echo "<h2>7.6 PSR-4 Autoloading Estándar</h2>";

echo "<h3>¿Qué es PSR-4?</h3>";
echo "<p>PSR-4 es el estándar de autoloading más usado. Define cómo mapear namespaces a directorios.</p>";

echo "<h3>Estructura PSR-4:</h3>";
echo "<pre>
Namespace: MiApp\\Modelos\\Usuario
Archivo:   src/Modelos/Usuario.php

Namespace: MiApp\\Servicios\\Email\\EmailService  
Archivo:   src/Servicios/Email/EmailService.php
</pre>";

echo "<h3>Implementación de PSR-4 Autoloader:</h3>";
echo "<pre>
&lt;?php
class Psr4Autoloader {
    private \$prefixes = [];
    
    public function register() {
        spl_autoload_register([\$this, 'loadClass']);
    }
    
    public function addNamespace(\$prefix, \$baseDir) {
        \$prefix = trim(\$prefix, '\\\\') . '\\\\';
        \$baseDir = rtrim(\$baseDir, DIRECTORY_SEPARATOR) . '/';
        \$this->prefixes[\$prefix][] = \$baseDir;
    }
    
    public function loadClass(\$class) {
        \$prefix = \$class;
        
        while (false !== \$pos = strrpos(\$prefix, '\\\\')) {
            \$prefix = substr(\$class, 0, \$pos + 1);
            \$relative_class = substr(\$class, \$pos + 1);
            
            if (\$mapped_file = \$this->loadMappedFile(\$prefix, \$relative_class)) {
                return \$mapped_file;
            }
            
            \$prefix = rtrim(\$prefix, '\\\\');
        }
        
        return false;
    }
    
    private function loadMappedFile(\$prefix, \$relative_class) {
        if (isset(\$this->prefixes[\$prefix]) === false) {
            return false;
        }
        
        foreach (\$this->prefixes[\$prefix] as \$base_dir) {
            \$file = \$base_dir . str_replace('\\\\', '/', \$relative_class) . '.php';
            
            if (\$this->requireFile(\$file)) {
                return \$file;
            }
        }
        
        return false;
    }
    
    private function requireFile(\$file) {
        if (file_exists(\$file)) {
            require \$file;
            return true;
        }
        return false;
    }
}

// Usar el autoloader
\$loader = new Psr4Autoloader();
\$loader->register();
\$loader->addNamespace('MiApp', __DIR__ . '/src');
</pre>";

// ========================================
// 7. COMPOSER Y AUTOLOADING
// ========================================
echo "<h2>7.7 Composer y Autoloading</h2>";

echo "<h3>¿Qué es Composer?</h3>";
echo "<p>Composer es el manejador de dependencias de PHP más popular. Incluye un autoloader PSR-4 automático.</p>";

echo "<h3>Archivo composer.json:</h3>";
echo "<pre>
{
    \"name\": \"miapp/proyecto\",
    \"description\": \"Mi aplicación PHP\",
    \"autoload\": {
        \"psr-4\": {
            \"MiApp\\\\\": \"src/\"
        }
    },
    \"require\": {
        \"php\": \">=7.4\"
    }
}
</pre>";

echo "<h3>Comandos básicos de Composer:</h3>";
echo "<pre>
# Instalar dependencias
composer install

# Generar autoloader
composer dump-autoload

# Agregar una dependencia
composer require vendor/package

# Actualizar dependencias
composer update
</pre>";

echo "<h3>Usando el autoloader de Composer:</h3>";
echo "<pre>
&lt;?php
// En el archivo principal de tu aplicación
require_once __DIR__ . '/vendor/autoload.php';

// Ahora todas las clases se cargan automáticamente
use MiApp\\Modelos\\Usuario;
use MiApp\\Servicios\\EmailService;

\$usuario = new Usuario('Ana', 'ana@email.com');
\$emailService = new EmailService();
</pre>";

// ========================================
// 8. EJERCICIO PRÁCTICO
// ========================================
echo "<h2>7.8 Ejercicio Práctico: Organizando una Aplicación</h2>";

echo "<h3>Estructura de proyecto recomendada:</h3>";
echo "<pre>
mi-app/
├── composer.json
├── index.php
├── src/
│   ├── Config/
│   │   └── Database.php
│   ├── Models/
│   │   ├── User.php
│   │   └── Product.php
│   ├── Controllers/
│   │   ├── UserController.php
│   │   └── ProductController.php
│   ├── Services/
│   │   ├── AuthService.php
│   │   └── EmailService.php
│   └── Utils/
│       ├── Validator.php
│       └── Helper.php
├── tests/
├── vendor/
└── README.md
</pre>";

// Simulamos la estructura con clases reales
echo "<h3>Implementación práctica:</h3>";

// Config/Database.php
class Config_Database {
    private static $config = [
        'host' => 'localhost',
        'database' => 'mi_app',
        'username' => 'root',
        'password' => ''
    ];
    
    public static function get($key) {
        return isset(self::$config[$key]) ? self::$config[$key] : null;
    }
    
    public static function all() {
        return self::$config;
    }
}

// Models/User.php
class Models_User {
    private $id;
    private $name;
    private $email;
    private $createdAt;
    
    public function __construct($name = null, $email = null) {
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = date('Y-m-d H:i:s');
    }
    
    public function save() {
        // En una app real, guardaría en base de datos
        $this->id = rand(1, 1000);
        return "Usuario '{$this->name}' guardado con ID: {$this->id}";
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public static function find($id) {
        // En una app real, buscaría en base de datos
        return new self("Usuario $id", "user{$id}@email.com");
    }
}

// Services/AuthService.php
class Services_AuthService {
    private static $loggedInUser = null;
    
    public static function login($email, $password) {
        // En una app real, verificaría credenciales
        if ($email && $password) {
            self::$loggedInUser = new Models_User("Usuario Logueado", $email);
            return "Login exitoso para: $email";
        }
        return "Credenciales inválidas";
    }
    
    public static function logout() {
        $user = self::$loggedInUser;
        self::$loggedInUser = null;
        return "Logout exitoso para: " . ($user ? $user->getEmail() : "usuario desconocido");
    }
    
    public static function getCurrentUser() {
        return self::$loggedInUser;
    }
    
    public static function isLoggedIn() {
        return self::$loggedInUser !== null;
    }
}

// Controllers/UserController.php
class Controllers_UserController {
    private $authService;
    
    public function __construct() {
        // En Laravel esto sería inyección de dependencias
        $this->authService = 'Services_AuthService';
    }
    
    public function register($name, $email, $password) {
        // Crear nuevo usuario
        $user = new Models_User($name, $email);
        $saveResult = $user->save();
        
        // Auto-login después del registro
        $loginResult = call_user_func([$this->authService, 'login'], $email, $password);
        
        return "Registro: $saveResult<br>$loginResult";
    }
    
    public function profile() {
        if (call_user_func([$this->authService, 'isLoggedIn'])) {
            $user = call_user_func([$this->authService, 'getCurrentUser']);
            return "Perfil de: " . $user->getName() . " (" . $user->getEmail() . ")";
        }
        return "Debes iniciar sesión para ver tu perfil";
    }
    
    public function logout() {
        return call_user_func([$this->authService, 'logout']);
    }
}

// Utils/Validator.php
class Utils_Validator {
    public static function email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public static function minLength($string, $min) {
        return strlen($string) >= $min;
    }
    
    public static function required($value) {
        return !empty($value);
    }
    
    public static function validateUser($data) {
        $errors = [];
        
        if (!self::required($data['name'] ?? '')) {
            $errors[] = "El nombre es requerido";
        }
        
        if (!self::required($data['email'] ?? '')) {
            $errors[] = "El email es requerido";
        } elseif (!self::email($data['email'])) {
            $errors[] = "El email no es válido";
        }
        
        if (!self::required($data['password'] ?? '')) {
            $errors[] = "La contraseña es requerida";
        } elseif (!self::minLength($data['password'], 6)) {
            $errors[] = "La contraseña debe tener al menos 6 caracteres";
        }
        
        return empty($errors) ? true : $errors;
    }
}

// Probar la aplicación
echo "<h3>Probando la aplicación:</h3>";

// Validar datos de usuario
$userData = [
    'name' => 'Ana García',
    'email' => 'ana@email.com',
    'password' => '123456'
];

$validation = Utils_Validator::validateUser($userData);
if ($validation === true) {
    echo "✅ Datos válidos<br>";
    
    // Crear controlador y registrar usuario
    $controller = new Controllers_UserController();
    echo $controller->register($userData['name'], $userData['email'], $userData['password']) . "<br>";
    
    // Ver perfil
    echo $controller->profile() . "<br>";
    
    // Logout
    echo $controller->logout() . "<br>";
    
    // Intentar ver perfil después del logout
    echo $controller->profile() . "<br>";
    
} else {
    echo "❌ Errores de validación:<br>";
    foreach ($validation as $error) {
        echo "- $error<br>";
    }
}

echo "<br><h3>Configuración de base de datos:</h3>";
$dbConfig = Config_Database::all();
foreach ($dbConfig as $key => $value) {
    echo "$key: $value<br>";
}

echo "<hr>";
echo "<p><strong>Para practicar:</strong></p>";
echo "<ul>";
echo "<li>Crea más clases siguiendo la estructura de namespaces</li>";
echo "<li>Implementa un autoloader PSR-4 real</li>";
echo "<li>Experimenta con Composer en un proyecto separado</li>";
echo "<li>Estudia cómo Laravel organiza sus clases con namespaces</li>";
echo "</ul>";
?>
