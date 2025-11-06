export const TableItem = ({id, content}) => {
    return <div class="table-row">
        {content.map((item, index) => <div key={index} className="table-cell">{item}</div>)}
    </div>
    
    // <div className="linha" key={id}>
    //     {content.map((item, index) => <div key={index} className="textolinha">{item}</div>)}
    // </div>;
}