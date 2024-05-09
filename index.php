<?php

require __DIR__ . '/vendor/autoload.php';

// Get the requested URI
$requestUri = $_SERVER['REQUEST_URI'];
// Define routes and corresponding PHP files
$routes = [
  '/' => 'login.php',
  '/register' => 'register.php',
  '/home' => 'home.php',
  '/stock-entry' => 'entry.php',
  '/edit' => 'edit.php',
  '/logout' => 'logout.php'
];

if (array_key_exists($requestUri, $routes)) {
  // Get the corresponding PHP file for the route
  $targetPhpFile = $routes[$requestUri];
  // Include the corresponding PHP file
  include_once (__DIR__ . "/app/$targetPhpFile");
} else {
  // Route not found, check if it contains query parameters
  $routeParts = explode('?', $requestUri, 2);
  $route = $routeParts[0];
  if (array_key_exists($route, $routes)) {
    // Get the corresponding PHP file for the route
    $targetPhpFile = $routes[$route];
    // Include the corresponding PHP file
    include_once (__DIR__ . "/app/$targetPhpFile");
  } else {
    // Route not found, return 404 error or handle accordingly
    echo '<h1>404 - Not Found</h1>';
  }
}