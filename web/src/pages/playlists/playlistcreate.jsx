import { useEffect, useState } from "react";
import { Button } from "../../template/components/button";
import { Table } from "../../template/components/table";
import { TableItem } from "../../template/components/table-item";
import { PageHeader } from "../../template/page-header";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Navigate, useNavigate } from "react-router-dom";
import { faFileUpload } from "@fortawesome/free-solid-svg-icons";

export const PlaylistCreate = ({controller}) => {
    const navigate = useNavigate();

    const [items, setItems] = useState([]);
    const CreatePlaylist = () => {
        let nome = prompt("Qual nome deseja atribuir a ela? ");
        alert(nome);
    }
    const UploadFile = () => {
        ;
    }

    const getItems = () => {
        if (items.length === 0) {
            return null;
        }
        return items.map((item, index) => {
            return <TableItem key={`tableitem-${index}`} content={[
                item.nome,
                item.descricao,
                item.data,
                item.duracao,
                <div className="tableitem-icon-line"><FontAwesomeIcon icon="fa-solid fa-trash" className="tableitem-icon" /></div>
                ,
            ]} />
        });
        // TODO: colocar uma caixa de verificação para deletar o item
    }

    return (
        <div className="right-panel">
            <PageHeader
                title="Criar nova Playlist"
                actionItems={[
                    <Button type="red" icon={<FontAwesomeIcon icon="fa-solid fa-plus" />} content="Carregar Arquivos" onClick={UploadFile}/>,
                    <Button type="red" icon={<FontAwesomeIcon icon="fa-solid fa-floppy-disk" />} content="Salvar Mídia" onClick={CreatePlaylist}/>
                ]}
            />
            <h2 class="page-title">Todas as mídias</h2>
            <div className="page-body">
                <Table 
                    headers={['Nome', 'Descrição', 'Data de Adição','Duração', '']}
                    items={getItems()}
                />
          </div>
        </div>
    );
}