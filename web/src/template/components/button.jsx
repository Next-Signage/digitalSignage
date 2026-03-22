export const Button = ({id, icon, content, onClick, type}) => {
    return (
        <button
            className={`stylized-button button-${type}`}
            id={id}
            onClick={onClick}>
            {icon}{content}
        </button>
    )
}