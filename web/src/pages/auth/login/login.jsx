// import logo from '/assets/images/logo.png';
export const TemplateAuthLogin = (props) => {
    return (
        <div className="login-page">
            <div className="about-content">
                <div className="login-content">
                    <img className="login-image" src="/assets/images/logo.png" />
                </div>
            </div>
            <div className="login-form">
                <div className="login-content">
                    <h1>Bem-vindo de novo!</h1>
                    <h3>
                        É bom te ter de volta! Insira seus dados para voltar ao sistema
                    </h3>
                    <form>
                        <label>E-mail</label>
                        <input type="email" name="email" required/>
                        <label>Senha</label>
                        <input type="password" name="paswd" required/>
                        <input type="submit" value="Logar" />
                        <h3>Não tem uma conta? <a href="signup">Cadastrar</a></h3>
                    </form>
                </div>
            </div>
        </div>
    );
}