<?php

namespace App\Router;

class Router
{

    // Массив для хранения маршрутов, разделённых по типам
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    // Здесь вызывается метод initRoutes для инициализации маршрутов
    public function __construct()
    {
        $this->initRoutes();
    }

    // Метод для обработки входящего URI (запроса)
    // Он проверяет, есть ли соответствующий маршрут в массиве $routes и вызывает его
    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if(!$route){
            $this->notFound();
        }

        $route->getAction()();
    }

    private function notFound(): void
    {
        echo "404 | Not Found";
        exit;
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if(!isset($this->routes[$method][$uri])){
            return false;
        }

        return $this->routes[$method][$uri];
    }

    // Получает все маршруты и распределяет их по типу запроса (GET или POST) в массив $routes
    private function initRoutes()
    {
        $routes = $this->getRoutes();

        // Проходим по каждому маршруту и сохраняем его в массив $routes по соответствующему методу (GET или POST)
        foreach ($routes as $route){
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }

    }

    // Метод для получения всех маршрутов из конфигурационного файла routes.php
    private function getRoutes(): array
    {
        return require_once APP_PATH . "/config/routes.php";
    }
}
