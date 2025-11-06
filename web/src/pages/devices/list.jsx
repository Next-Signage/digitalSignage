import { useEffect, useState } from "react";
import { Button } from "../../template/components/button";
import { Table } from "../../template/components/table";
import { TableItem } from "../../template/components/table-item";
import { PageHeader } from "../../template/page-header";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'

export const DeviceList = ({controller}) => {

    const [items, setItems] = useState([
        {
            id: 1,
            nome: "Corredor tecnológico",
            descricao: "Colocar em ocasicoes especiais",
            status: "online",
            ip: '192.168.0.1',
            playlist: "Esporte 1",
        },
        {
            id: 2,
            nome: "Refeitório",
            descricao: "Colocar quando tiver visita",
            status: "offline",
            ip: '192.168.0.2',
            playlist: "Cozinha",
        },
    ])
    
    useEffect(() => {
        fetchData();        
    },[]);

    const fetchData = async () => {
        const response = await controller.getAll();
        setItems(response.data);        
    }

    const getItems = () => {


        return items.map((item, index) => {
            return <TableItem key={`tableitem-${index}`}content={[
                item.id,
                item.ipAddress,
                item.name,
                <><FontAwesomeIcon icon="fa-solid fa-edit" /><FontAwesomeIcon icon="fa-solid fa-trash" /></> ,
            ]} />
        });
    }

    return (
        <div className="right-panel">
            <div className="titlemain">
            <div>
                <h1>Dispositivos</h1>
            </div>
            <div>
                <Button key={1} id="newdevice" icon={<FontAwesomeIcon icon="fa-solid fa-plus" />} content="Novo" />
            </div>
        </div>
            <div className="page-body">
                <div class="table">
                    <div class="table-row">
                        <div key={`header-0`} className="table-header">#</div>
                        <div key={`header-1`} className="table-header">IP</div>
                        <div key={`header-2`} className="table-header">Nome</div>
                        <div key={`header-3`} className="table-header"></div>
                    </div>
                    {items.map((item, index) => (
                        <div class="table-row">
                            <div key={`item-${index}1`} className="table-cell">{item.id}</div>
                            <div key={`item-${index}2`} className="table-cell">{item.ipAddress}</div>
                            <div key={`item-${index}3`} className="table-cell">{item.name}</div>
                            <div key={`item-${index}4`} className="table-cell"><FontAwesomeIcon icon="fa-solid fa-edit" /><FontAwesomeIcon icon="fa-solid fa-trash" /></div>
                        </div>
                    ))}
                </div>                
            </div>
        </div>
    );
}