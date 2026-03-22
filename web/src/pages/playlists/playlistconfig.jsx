import { useEffect, useState } from "react";
import { Button } from "../../template/components/button";
import { Table } from "../../template/components/table";
import { TableItem } from "../../template/components/table-item";
import { PageHeader } from "../../template/page-header";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Navigate, useNavigate } from "react-router-dom";
import { faFileUpload } from "@fortawesome/free-solid-svg-icons";

function ToMinutes(s) {
    let sec = (s-(Math.floor(s/60)*60));
    let min = Math.floor(s/60);

    if ((sec+"").length == 1) {
        sec = "0"+sec;
    }
    if ((min+"").length == 1) {
        min = "0"+min;
    }

    return min+":"+sec;
}

export const PlaylistConfig = ({controller}) => {
    const navigate = useNavigate();

    const [items, setItems] = useState([]);
    const CreatePlaylist = () => {
        let nome = prompt("Qual nome deseja atribuir a ela? ");
        alert(nome);
    }
    const UploadFile = () => {
        ;
    }
    
    useEffect(() => {
        let params = new URLSearchParams(window.location.search);
        let id = params.get("id");
        if (id) {
            const response = controller.getAll()[id-1];
            setItems(response)
            console.log(items.conteudo);
        }
    },[]);

    const getItems = () => {
        if (items.length === 0) {
            return null;
        }
        return items.conteudo.map((item, index) => {
            return <TableItem key={`tableitem-${index}`} content={[
                item.nome,
                item.descricao,
                item.data,
                ToMinutes(item.duracao),
                <div className="tableitem-icon-line"><FontAwesomeIcon icon="fa-solid fa-trash" className="tableitem-icon" /></div>
                ,
            ]} />
        });
        // TODO: colocar uma caixa de verificação para deletar o item
    }

    return (
        <div className="right-panel">
            <PageHeader
                title={"thrgefsv"}
                actionItems={[
                    <Button type="red" icon={<FontAwesomeIcon icon="fa-solid fa-plus" />} content="Carregar Arquivos" onClick={UploadFile}/>,
                    <Button type="red" icon={<FontAwesomeIcon icon="fa-solid fa-floppy-disk" />} content="Salvar Modificações" onClick={CreatePlaylist}/>
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