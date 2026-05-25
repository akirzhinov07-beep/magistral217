<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }

$dataFile = __DIR__ . '/../data/projects.json';

function loadProjects(string $file): array {
    if (!file_exists($file)) return [];
    $data = json_decode(file_get_contents($file), true);
    return is_array($data) ? $data : [];
}

function saveProjects(string $file, array $projects): void {
    file_put_contents($file, json_encode(array_values($projects), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

function respond(mixed $data, int $code = 200): void {
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

switch ($method) {
    case 'GET':
        respond(loadProjects($dataFile));

    case 'POST':
        $body = json_decode(file_get_contents('php://input'), true);
        if (!$body || empty($body['title'])) respond(['error' => 'title is required'], 400);
        $projects = loadProjects($dataFile);
        $project = [
            'id'          => uniqid('p_', true),
            'label'       => trim($body['label'] ?? ''),
            'title'       => trim($body['title']),
            'description' => trim($body['description'] ?? ''),
            'image'       => trim($body['image'] ?? ''),
            'current'     => (bool)($body['current'] ?? false),
            'created'     => date('c'),
        ];
        $projects[] = $project;
        saveProjects($dataFile, $projects);
        respond($project, 201);

    case 'PUT':
        if (!$id) respond(['error' => 'id required'], 400);
        $body = json_decode(file_get_contents('php://input'), true);
        $projects = loadProjects($dataFile);
        foreach ($projects as &$p) {
            if ($p['id'] === $id) {
                if (isset($body['label']))       $p['label']       = trim($body['label']);
                if (isset($body['title']))       $p['title']       = trim($body['title']);
                if (isset($body['description'])) $p['description'] = trim($body['description']);
                if (isset($body['image']))       $p['image']       = trim($body['image']);
                if (isset($body['current']))     $p['current']     = (bool)$body['current'];
                $p['updated'] = date('c');
                saveProjects($dataFile, $projects);
                respond($p);
            }
        }
        respond(['error' => 'not found'], 404);

    case 'DELETE':
        if (!$id) respond(['error' => 'id required'], 400);
        $projects = loadProjects($dataFile);
        $filtered = array_filter($projects, fn($p) => $p['id'] !== $id);
        if (count($filtered) === count($projects)) respond(['error' => 'not found'], 404);
        foreach ($projects as $p) {
            if ($p['id'] === $id && !empty($p['image'])) {
                $imgPath = __DIR__ . '/../' . ltrim($p['image'], '/');
                if (file_exists($imgPath)) @unlink($imgPath);
            }
        }
        saveProjects($dataFile, $filtered);
        respond(['ok' => true]);

    default:
        respond(['error' => 'method not allowed'], 405);
}
