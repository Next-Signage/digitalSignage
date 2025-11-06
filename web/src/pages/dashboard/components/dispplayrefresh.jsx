import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Button } from "../../../template/components/button";

export const DispPlayRefresh = () => {
	return (
        <div className="newdispplayrefresh">
            <Button content={"Novo dispositivo"} bgcolor={"var(--red)"} icon={<FontAwesomeIcon icon={"fa-solid fa-plus"}/>}/>
            <Button content={"Nova playlist"} bgcolor={"var(--red)"} icon={<FontAwesomeIcon icon={"fa-solid fa-plus"}/>}/>
            <Button content={"Atualizar"} bgcolor={"grey"} icon={<FontAwesomeIcon icon={"fa-solid fa-arrows-rotate"}/>}/>
        </div>
    )
};
