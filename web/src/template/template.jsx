import { TemplateMenu } from "./menu";

export const Template = (props) => {
    return (
        <main>
            <TemplateMenu />
            {props.page}
        </main>
    );
}