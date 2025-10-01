<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro - PE SIGNAGE</title>
    
    <link rel="stylesheet" type="text-css" href="<?= BASE_URL ?>/css/responsive.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/header.css" />
    <script defer src="<?= BASE_URL ?>/js/header.js"></script> 
</head>
<body>
    <nav>
        <div class="logo">
            <div class="imagem">
                <img class="projectimage" src="<?= BASE_URL ?>/images/favicon.ico" />
            </div>
            <h1 class="projecttitle"></h1>
        </div>
        <div class="items">
            <a href="#">Sobre nós</a>
            <p>|</p>
            <a href="#">Conhecer a ferramenta</a>
            <p>|</p>
            <a href="#">Encarregados</a>
            <p>|</p>
            <a href="#">Github</a>
        </div>
    </nav>

    <main>
        <div class="about-content">
            <div class="content">
                <div class="circular-image">
                    <img class="projectimage" src="<?= BASE_URL ?>/images/favicon.ico" />
                </div>
                <h1 class="projecttitle"></h1>
                <h3>Já tem uma conta? <a href="<?= BASE_URL ?>/login">Entrar</a>.</h3>
                <h3>Que tal entender <a href="#">como nós trabalhamos</a>?</h3>
            </div>
        </div>

        <div class="form-container">
            <div class="content">
                <h1>Bem-vindo</h1>
                <h3>Cadastre-se agora para usar o sistema</h3>
                <h3 class="onlyresponsive">
                    Já tem uma conta? <a href="<?= BASE_URL ?>/login">Entrar</a>.
                </h3>

                <form id="formulario" method="POST" action="<?= BASE_URL ?>/signup/register">
                    <label>Nome</label><br />
                    <input type="text" name="name" required /><br />

                    <label>Nome de Usuario</label><br />
                    <input type="text" name="username" id="birthday" required /><br />
                    <span id="birthday-error" style="color: red; font-size: 0.9em"></span>

                    <label>E-mail</label><br />
                    <input type="email" name="email" id="email" required /><br />
                    <span id="email-error" style="color: red; font-size: 0.9em"></span>

                    <div>
                        <div>
                            <label>Senha</label><br />
                            <input type="password" name="paswd" required /><br />
                        </div>
                        <div>
                            <label>Confirmar senha</label><br />
                            <input type="password" name="paswdconfirm" id="paswdconfirm" required /><br />
                            <span id="paswdconfirm-error" style="color: red; font-size: 0.9em"></span>
                        </div>
                    </div>

                    <label>CPF</label><br />
                    <input type="number" name="cpf" id="cpf" required /><br />
                    <span id="cpf-error" style="color: red; font-size: 0.9em"></span>

                    <label>Data de Aniversário</label><br />
                    <input type="date" name="birthday" id="birthday" required /><br />
                    <span id="birthday-error" style="color: red; font-size: 0.9em"></span>

                    

                    <input type="submit" value="Cadastrar" id="submitform" />
                </form>
            </div>
        </div>
    </main>

    <script>
        const baseUrl = '<?= BASE_URL ?>';

        const form = document.getElementById("formulario");
        const emailInput = document.getElementById("email");
        const paswdInput = document.getElementsByName("paswd")[0];
        const paswdConfirmInput = document.getElementById("paswdconfirm");
        const cpfInput = document.getElementById("cpf");
        const birthdayInput = document.getElementById("birthday");

        const emailError = document.getElementById("email-error");
        const paswdConfirmError = document.getElementById("paswdconfirm-error");
        const cpfError = document.getElementById("cpf-error");
        const birthdayError = document.getElementById("birthday-error");

        function validaEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(String(email).toLowerCase());
        }

        function validaCPF(cpf) {
            cpf = String(cpf).replace(/[^\d]+/g, "");
            if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;
            let soma = 0, resto;
            for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.substring(9, 10))) return false;
            soma = 0;
            for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.substring(10, 11))) return false;
            return true;
        }

        paswdConfirmInput.addEventListener("blur", () => {
            paswdConfirmError.textContent = "";
            if (paswdInput.value !== paswdConfirmInput.value) {
                paswdConfirmError.textContent = "As senhas não coincidem.";
            }
        });

        cpfInput.addEventListener("blur", async () => {
            const cpf = cpfInput.value;
            cpfError.textContent = "";
            if (!validaCPF(cpf)) {
                if (cpf.length > 0) cpfError.textContent = "CPF inválido.";
                return;
            }
            try {
                const response = await fetch(`${baseUrl}/verificar-cpf?cpf=${encodeURIComponent(cpf)}`);
                if (!response.ok) throw new Error(`Erro HTTP: ${response.status}`);
                const data = await response.json();
                if (data.exists) {
                    cpfError.textContent = "Este CPF já está cadastrado.";
                }
            } catch (error) {
                console.error("Falha ao verificar CPF:", error);
                cpfError.textContent = "Não foi possível verificar o CPF.";
            }
        });

        emailInput.addEventListener("blur", async () => {
            const email = emailInput.value;
            emailError.textContent = "";
            if (!validaEmail(email)) {
                if (email.length > 0) emailError.textContent = "Formato de e-mail inválido.";
                return;
            }
            try {
                const response = await fetch(`${baseUrl}/verificar-email?email=${encodeURIComponent(email)}`);
                if (!response.ok) throw new Error(`Erro HTTP: ${response.status}`);
                const data = await response.json();
                if (data.exists) {
                    emailError.textContent = "Este e-mail já está cadastrado.";
                }
            } catch (error) {
                console.error("Falha ao verificar e-mail:", error);
                emailError.textContent = "Não foi possível verificar o e-mail.";
            }
        });

        form.addEventListener("submit", (e) => {
            let hasErrors = false;
            birthdayError.textContent = "";

            if (paswdInput.value !== paswdConfirmInput.value) {
                paswdConfirmError.textContent = "As senhas não coincidem.";
                hasErrors = true;
            }

            const birthDate = new Date(birthdayInput.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
            if (age < 18) {
                birthdayError.textContent = "Você precisa ter pelo menos 18 anos.";
                hasErrors = true;
            }

            if (emailError.textContent !== "" || cpfError.textContent !== "" || paswdConfirmError.textContent !== "") {
                hasErrors = true;
            }

            if (hasErrors) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>