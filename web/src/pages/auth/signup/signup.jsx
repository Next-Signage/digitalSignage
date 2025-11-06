// import logo from '/assets/images/logo.png';
export const TemplateAuthSignup = (props) => {
    return (
        <div className="login-page">
            <div className="about-content">
                <div className="login-content">
                    <img className="login-image" src="/assets/images/logo.png" />
                </div>
            </div>
            <div className="login-form">
                <div className="login-content">
                    <h1>Bem-vindo</h1>
                    <h3>
                        Cadastre-se agora para usar o sistema
                    </h3>
                    <form>
                        <label>Nome de usuário</label><br />
                        <input type="text" name="name" required /><br />
                        <label>E-mail</label><br />
                        <input type="email" name="email" required /><br />
                        <div>
                            <div>
                                <label>Senha</label><br />
                                <input type="password" name="paswd" required /><br />
                            </div>
                            <div>
                                <label>Confirmar senha</label><br />
                                <input type="password" name="paswdconfirm" required /><br />
                            </div>
                        </div>
                        <label>CPF</label><br />
                        <input type="text" id="cpf" name="cpf"
                            pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                            placeholder="000.000.000-00"
                            title="Digite o CPF no formato 000.000.000-00"
                            required />
                        <label>Data de Nascimento</label><br />
                        <input type="date" name="birthday" required /><br />
                        <input type="submit" value="Cadastrar" id="submitform" />
                        <h3>Já tem uma conta? <a href="login">Entrar</a></h3>
                    </form>
                </div>
            </div>
        </div>
    );
}