export class PlaylistService {
    getAll() {
        return [
            {
                id: 1,
                nome: "Esporte 1",
                descricao: "Colocar em ocasicoes especiais",
                conteudo:[
                    {
                        nome:"futebol.mp4",
                        descricao: "Bem vindo ao povo",
                        data: "06-11-2025",
                        duracao: 1,
                    },
                    {
                        nome:"transicao.png",
                        descricao: "Transição magnifica",
                        data: "06-11-2025",
                        duracao: 2,
                    },
                ]
            },
            {
                id: 2,
                nome: "Playlist Cozinha",
                descricao: "Colocar quando tiver visita",
                conteudo:[
                    {
                        nome:"video98765.mp4",
                        descricao: "Bem vindo ao povo",
                        data: "06-11-2025",
                        duracao: 3,
                    },
                    {
                        nome:"foto09876.png",
                        descricao: "Transição magnifica",
                        data: "06-11-2025",
                        duracao: 4,
                    },
                ]
            },
            {
                id: 3,
                nome: "Pedagógico",
                descricao: "Colocar quando quiser",
                conteudo:[
                    {
                        nome:"video do pedagogo.mp4",
                        descricao: "Bem vindo ao povo",
                        data: "06-11-2025",
                        duracao: 5,
                    },
                    {
                        nome:"transicao pedagogo.png",
                        descricao: "Transição magnifica",
                        data: "06-11-2025",
                        duracao: 6,
                    },
                ]
            }
        ]
    }
}