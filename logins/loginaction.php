<?php

// Include necessary libraries
require_once 'vendor/autoload.php';

use \Firebase\JWT\JWT;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\Factory\AppFactory;
use \Slim\Routing\RouteCollectorProxy;

// Create Slim app
$app = AppFactory::create();

// Database connection (replace with your actual setup)
$db = new PDO('mysql:host=localhost;dbname=ai', 'root', '');

// Define signup route
$app->post('/signup', function (Request $request, Response $response) use ($db) {
    // Get data from request body
    $data = $request->getParsedBody();
    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];

    try {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into database
        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashedPassword]);

        // Success response
        return $response->withJson(['message' => 'User created successfully!'], 201);

    } catch (PDOException $e) {
        // Handle duplicate entry error
        if ($e->getCode() === '23000') {
            return $response->withJson(['error' => 'Username or email already exists.'], 409);
        } else {
            return $response->withJson(['error' => 'Failed to create user.'], 500);
        }
    }
});

// Define login route
$app->post('/login', function (Request $request, Response $response) use ($db) {
    // Get data from request body
    $data = $request->getParsedBody();
    $username = $data['username'];
    $password = $data['password'];

    try {
        // Fetch user from database
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists
        if (!$user) {
            return $response->withJson(['error' => 'Invalid credentials.'], 401);
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            return $response->withJson(['error' => 'Invalid credentials.'], 401);
        }

        // Generate JWT token
        $secretKey = 'your_secret_key';
        $payload = ['iss' => 'your_application', 'sub' => $user['id'], 'iat' => time(), 'exp' => time() + (60 * 60)];
        $token = JWT::encode($payload, $secretKey);

        // Success response
        return $response->withJson(['message' => 'Login successful!', 'token' => $token], 200);

    } catch (PDOException $e) {
        return $response->withJson(['error' => 'Failed to login.'], 500);
    }
});

// ... other routes for chat functionality ...

// Run the app
$app->run();
?>
