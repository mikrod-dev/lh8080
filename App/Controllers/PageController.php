<?php

namespace Controllers;

require_once(__DIR__ . '/../../bootstrap/autoload.php');

use Core\Middlewares\GuestMiddleware;
use Core\ViewRenderer;
use Security\SessionManager;

final class PageController
{
    private array $allowed_roles = ['Admin', 'User', 'Moderator'];
    public function index(): void
    {
        $this->renderForRole('index', 'Public/index');
    }

    public function login(): void
    {
        GuestMiddleware::handle();
        ViewRenderer::render('Public/login.view');
    }

    public function signup(): void
    {
        GuestMiddleware::handle();
        ViewRenderer::render('Public/signup.view');
    }

    public function blog(): void
    {
        $this->renderForRole('blog', 'Public/blog');
    }

    public function dashboard(): void
    {
        $this->renderForRole('dashboard');
    }

    private function renderForRole(string $view_name, string $fallback = ''): void
    {
        SessionManager::init();
        $role = ucfirst(SessionManager::get('role') ?? '');

        if (in_array($role, $this->allowed_roles)) {
            ViewRenderer::render("$role/$view_name.view");
        } elseif ($fallback !== '') {
            ViewRenderer::render("$fallback.view");
        } else {
            header('Location: /login');
            exit;
        }
    }

}