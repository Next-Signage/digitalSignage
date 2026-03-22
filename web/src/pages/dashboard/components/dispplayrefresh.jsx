import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Button } from "../../../template/components/button";

export const DispPlayRefresh = () => {
	return (
        <div className="newdispplayrefresh">
            <Button type={"red"} content={"Novo dispositivo"} icon={<FontAwesomeIcon icon={"fa-solid fa-plus"}/>}/>
            <Button type={"red"} content={"Nova playlist"} icon={<FontAwesomeIcon icon={"fa-solid fa-plus"}/>}/>
            <Button type={"grey"} content={"Salvar Modificações"} icon={<FontAwesomeIcon icon={"fa-solid fa-arrows-rotate"}/>}/>
        </div>
    )
};
