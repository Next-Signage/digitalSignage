import { useEffect, useState } from "react";
import { Button } from "../../template/components/button";
import { Table } from "../../template/components/table";
import { TableItem } from "../../template/components/table-item";
import { PageHeader } from "../../template/page-header";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Navigate, useNavigate } from "react-router-dom";

export const PlaylistList = ({controller}) => {
    const navigate = useNavigate();

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

    const EditPlaylist = (index) => {
        navigate("/playlists/config?id="+(index));
    }
    const CreatePlaylist = () => {
        navigate("/playlists/create");
    }
    
    useEffect(() => {
        const response = controller.getAll();
        setItems(response)
    },[]);

    const getItems = () => {
        if (items.length == 0) {
            return null;
        }
        return items.map((item, index) => {
            return <TableItem key={`tableitem-${index}`} content={[
                item.nome,
                item.descricao,
                <div className="tableitem-icon-line"><FontAwesomeIcon icon="fa-solid fa-gear" className="tableitem-icon" onClick={() => {EditPlaylist(index+1)}}/><FontAwesomeIcon icon="fa-solid fa-trash" className="tableitem-icon" /></div>
                ,
            ]} />
        });
        // TODO: colocar uma caixa de verificação para deletar o item
    }

    return (
        <div className="right-panel">
            <PageHeader
                title="Todas as playlists"
                actionItems={[
                    <Button id="newplaylist" bgcolor="var(--red)" icon={<FontAwesomeIcon icon="fa-solid fa-plus" />} content="Nova Playlist" onClick={CreatePlaylist}/>
                ]}
            />
            <div className="page-body">
                <Table 
                    headers={['Nome', 'Descrição', ' ']}
                    items={getItems()}
                />
          </div>
        </div>
    );
}