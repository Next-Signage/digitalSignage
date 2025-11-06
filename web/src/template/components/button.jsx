export const Button = ({id, icon, content, onClick, bgcolor}) => {
    return (
        <button
            style={{ "background-color":bgcolor }}
            className="stylized-button"
            id={id}
            onClick={onClick}>
            {icon}{content}
        </button>
    )
}