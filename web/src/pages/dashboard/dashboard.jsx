import { Badge } from "../../template/components/badge";
import { Button } from "../../template/components/button";
import { Table } from "../../template/components/table";
import { TableItem } from "../../template/components/table-item";
import { PageHeader } from "../../template/page-header";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { DispPlayRefresh } from "./components/dispplayrefresh";
import { Devices } from "./components/devices";
import { useEffect, useState } from "react";

const itens = [
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
];

export const Dashboard = () => {
	// const [itens, setItens] = () => useState([]);

	const fetchData = async () => {
		// const response = await axios.get('http://localhost:8080/dashboard/asdf');
		// setItens(response.data);
	};

	useEffect(() => {
		fetchData();
	}, []);
	// const getItems = () => {
	//     return itens.map((item, index) => {
	//         return <TableItem id={`tableitem-${index}`}
	//         content={[
	//             item.id,
	//             item.nome,
	//             <Badge text={item.status} type={item.status == 'online' ? 'success' : 'error'} />,
	//             item.playlist,
	//             // <><FontAwesomeIcon icon="fa-solid fa-edit" /><FontAwesomeIcon icon="fa-solid fa-trash" /></> ,
	//         ]} />
	//     });
	// }

	return (
		<div className="right-panel">
			<div className="page-body">
				<div className="up">
					<Devices online={5} offline={10} />
					<DispPlayRefresh />
				</div>
				<h2 class="page-title">Todos os Dispositivos</h2>
				{ <Table
                    headers={['#', 'Nome', 'Status', 'Playlist', 'IP', 'Descrição', '']}
                    items={
                        itens.map((item, index) => {
                            return <TableItem id={`tableitem-${index}`}
                            content={[
                                item.id,
                                item.nome,
                                <Badge text={item.status} type={item.status == 'online' ? 'success' : 'error'} />,
                                item.playlist,
                                item.ip,
                                item.descricao,
                                <div className="tableitem-icon-line"><FontAwesomeIcon icon="fa-solid fa-gear" className="tableitem-icon"/><FontAwesomeIcon icon="fa-solid fa-trash" className="tableitem-icon" /></div>
                            ]} />
                        })
                    }/> }
			</div>
		</div>
	);
};
