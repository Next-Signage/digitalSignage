<?php

require_once __DIR__ . '/../dao/AdmDAO.php';
require_once __DIR__ . '/../models/Adm.php';

class UserController {
    
    private $pdo;

    /**
     * O construtor recebe a conexão PDO via Injeção de Dependência.
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Apenas exibe a view do formulário de cadastro.
     */
    public function showSignupForm() {
        require_once __DIR__ . '/../views/auth/signup.php';
    }

    /**
     * Orquestra o processo de registro de um novo administrador.
     */
    public function register() {
        // 1. Pega os dados do formulário
        $nome = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST,'paswd');
        $username = filter_input(INPUT_POST,'username');
        $cpf = filter_input(INPUT_POST, 'cpf'); // Adicionar validação se necessário
        $data_nascimento = filter_input(INPUT_POST, 'birthday');

        // 2. Validação básica
        if (!$nome || !$email || empty($senha) || !$cpf || !$data_nascimento || !$username) {
            header('Location: ' . BASE_URL . '/signup?status=error&message=' . urlencode('Todos os campos são obrigatórios.'));
            exit();
        }

        try {
            // 3. Cria um objeto do tipo Adm (Model) com os dados do formulário
            $newAdmin = new Adm();
            $newAdmin->setName($nome);
            $newAdmin->setUsername($nome);
            $newAdmin->setEmail($email);
            $newAdmin->setPassword($senha); // O hashing é feito dentro do model/DAO
            $newAdmin->setCpf($cpf);
            $newAdmin->setBirthDate($data_nascimento);
            // Defina um admCode padrão ou gere um, se necessário
            $newAdmin->setAdmCode('default_code'); 

            // 4. DELEGA o trabalho de salvar para o DAO
            $admDAO = new AdmDAO($this->pdo);
            $admDAO->save($newAdmin);

            // 5. Redireciona para o sucesso
            header("Location: " . BASE_URL . "/login?status=success");
            exit();

        } catch (PDOException $e) {
            // Trata erros, como e-mail ou CPF duplicado
            $message = urlencode("Erro ao cadastrar. Verifique se o e-mail ou CPF já estão em uso.");
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                 header("Location: " . BASE_URL . "/signup?status=error&message=" . $message);
            } else {
                 header("Location: " . BASE_URL . "/signup?status=error&message=" . urlencode("Erro inesperado no banco de dados."));
            }
            exit();
        }
    }
    
    /**
     * Exibe a página principal do usuário (dashboard).
     */
    public function dashboard() {
        require_once __DIR__ . '/../views/dashboard/dashboard.php';
    }

    /**
     * Verifica via AJAX se um e-mail já existe. MUDAR FUTURAMENTE 
     * PQ DÁ PRA USAR UM FILTER
     */
    public function verifyEmailAjax() {
        header('Content-Type: application/json');
        $email = filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL);

        if (!$email) {
            echo json_encode(['exists' => false]);
            exit();
        }

        $admDAO = new AdmDAO($this->pdo);
        $admin = $admDAO->findByEmail($email);

        echo json_encode(['exists' => ($admin !== false)]);
    }

    /**
     * Verifica via AJAX se um CPF já existe.
     */
    public function verifyCpfAjax() {
        header('Content-Type: application/json');
        $cpf = preg_replace('/[^0-9]/', '', $_GET['cpf'] ?? '');

        if (strlen($cpf) !== 11) {
            echo json_encode(['exists' => false, 'message' => 'CPF inválido para verificação.']);
            exit();
        }
        
        $admDAO = new AdmDAO($this->pdo);
        $admin = $admDAO->findByCpf($cpf);

        echo json_encode(['exists' => ($admin !== false)]);
    }
}