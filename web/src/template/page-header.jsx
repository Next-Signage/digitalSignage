import { Button } from "./components/button";

export const PageHeader = ({title, actionItems}) => {
    return (
        <div className="titlemain">
            <div>
                <h2>{title}</h2>
            </div>
            <div className="end">
                {actionItems}
            </div>
        </div>
    );
}