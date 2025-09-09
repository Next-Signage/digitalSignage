<?php
// MUDANÇA 1: Os require_once foram removidos. O index.php ou um autoloader cuidam disso.
// A classe Adm não herda mais de User, a menos que User também seja um Model puro.
// Por simplicidade, vamos fazer Adm ser uma classe independente por enquanto.

class Adm {
    
    // Propriedades para guardar os dados. Todas privadas.
    private $id;
    private $name;
    private $birthDate;
    private $username;
    private $password; // E AQ GUARDA O HASH
    private $cpf;
    private $email;
    private $admCode;

    // MUDANÇA 2: Um construtor vazio para mais flexibilidade.
    public function __construct() {}

    // MUDANÇA 3: Getters e Setters para cada propriedade
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function getBirthDate() {
        return $this->birthDate;
    }
    public function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;
    }

    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    
    public function getPassword() {
        return $this->password;
    }
    // O setter da senha já pode aplicar o hash, ou podemos deixar para um método separado.
    public function setPassword($plainPassword) {
        // A senha em texto puro é recebida e o hash é armazenado na propriedade.
        $this->password = password_hash($plainPassword, PASSWORD_DEFAULT);
    }

    public function getCpf() {
        return $this->cpf;
    }
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getAdmCode() {
        return $this->admCode;
    }
    public function setAdmCode($admCode) {
        $this->admCode = $admCode;
    }

    // MUDANÇA 4: O método hashCode() não é mais necessário, 
    // pois a lógica foi movida para dentro do setPassword().
    // Isso garante que uma senha nunca seja armazenada sem hash.
}
?>