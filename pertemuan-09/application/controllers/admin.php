<?php
class Admin extends Controller
{
    public function index(): void
    {
        require_once APPPATH . 'helpers/auth_helper.php';
        require_admin_login();

        $username = $_SESSION['admin_username'];

        ob_start();

        require APPPATH . 'views/templates/header.php';
        require APPPATH . 'views/templates/sidebar.php';
        require APPPATH . 'views/admin/index.php';
        require APPPATH . 'views/templates/footer.php';

        $html = ob_get_clean();

        echo $html;
    }
}