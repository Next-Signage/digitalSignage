export const Table = ({headers, items}) => {
    return <>
        {/* <div className="linha-info"> */}
        <div class="table">
            <div class="table-row-header">
                {headers.map((header, index) =>
                    <div key={`header-${index}`} className="table-header">{header}</div>
                )}
            </div>
            {items ? items.map((item) => item) : <p className="nomidia">Sem mídia por enquanto...</p>}
        </div>
    </>
}