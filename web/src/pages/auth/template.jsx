import { Header } from "./head";

export const TemplateAuth = (props) => {
    return (
        <main className="login">
            <Header />
            {props.page}
        </main>
    );
}