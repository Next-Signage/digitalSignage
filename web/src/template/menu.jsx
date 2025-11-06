import { Link } from 'react-router-dom';
import { Profile } from './profile';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'

export const TemplateMenu = () => {
    return (
        <div className="left-painel background-gradient">
            <Profile />
            <ul className="menu-links">
                <li><FontAwesomeIcon icon="fa-solid fa-plug" /><Link to="/dashboard">Dispositivos</Link></li>
                <li><FontAwesomeIcon icon="fa-solid fa-list" /><Link to="/playlists">Playlists</Link></li>
            </ul>
            <ul className="menu-links-down">
                <li><FontAwesomeIcon icon="fa-solid fa-align-left" /><Link to="/doc">Documentação</Link></li>
                <li><FontAwesomeIcon icon="fa-solid fa-people-group" /><Link to="/about">Sobre nós</Link></li>
                <li><FontAwesomeIcon icon="fa-brands fa-github" /><Link to="/github">Github</Link></li>
            </ul>
        </div>
    );
}