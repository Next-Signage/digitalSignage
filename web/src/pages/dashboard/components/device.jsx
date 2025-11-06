import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

export const Device = ({count, text, type}) => {
    var icons = {
        "dispositivos":"desktop",
        "online":"globe",
        "offline":"plane-circle-xmark"
    }
    return <div className={`device device-${type}`}>
        <FontAwesomeIcon icon={`fa-solid fa-${icons[type]}`} />
        <h3>{count}</h3>
        <span>{text}</span>
    </div>;
}