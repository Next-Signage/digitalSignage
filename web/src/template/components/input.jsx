export const Input = ({type, id, label, ...props }) => {
    return <>
        {label ? <label>{label}</label> : null}
        <input type={type} id={id} {...props}/>
        </>
}