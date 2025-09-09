<?php

require_once __DIR__ . '/../dao/AdmDAO.php';

class AuthController {
    
    private $pdo;

    /**
     * O construtor recebe a conexão PDO via Injeção de Dependência.
     * Esta conexão será usada para criar os DAOs necessários.
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Apenas exibe a view do formulário de login.
     */
    public function showLoginForm() {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Orquestra o processo de autenticação.
     */
    public function authenticate() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha_digitada = $_POST['paswd'] ?? ''; // Usamos o operador de coalescência nula por segurança

        if (!$email || empty($senha_digitada)) {
            // Usa a constante BASE_URL para o redirecionamento
            header('Location: ' . BASE_URL . '/login?error=empty');
            exit();
        }

        try {
            $admDAO = new AdmDAO($this->pdo);
            $admin = $admDAO->findByEmail($email);

            // O password_verify compara a senha digitada com o hash salvo no banco.
            if ($admin && password_verify($senha_digitada, $admin->getPassword())) {
                
                session_regenerate_id(true); // Medida de segurança
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $admin->getId();
                $_SESSION['user_name'] = $admin->getName();
                
                header('Location: ' . BASE_URL . '/dashboard');
                exit();
            }

            // Se o admin não foi encontrado ou a senha estava incorreta, cai aqui
            header('Location: ' . BASE_URL . '/login?error=invalid');
            exit();

        } catch (PDOException $e) {
            // Em caso de erro de banco, redireciona para uma página de erro ou loga o erro.
            // Por enquanto, vamos redirecionar para o login com um erro genérico.
            error_log($e->getMessage()); // É uma boa prática logar o erro real
            header('Location: ' . BASE_URL . '/login?error=dberror');
            exit();
        }
    }
    
    /**
     * Faz o logout do usuário.
     */
    public function logout() {
        // Apenas a lógica de sessão é necessária aqui.
        $_SESSION = [];
        session_destroy();

        header('Location: ' . BASE_URL . '/login');
        exit();
    }
}