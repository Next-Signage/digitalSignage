import React from 'react';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
import { Template } from './template/template';
import './App.css'
import { PlaylistList } from './pages/playlists/playlist';
import { PlaylistCreate } from './pages/playlists/playlistcreate';
import { PlaylistConfig } from './pages/playlists/playlistconfig';
// import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'

/* import all the icons in Free Solid, Free Regular, and Brands styles */
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { Dashboard } from './pages/dashboard/dashboard';
import { PlaylistService } from './services/playlist';
import { PlaylistController } from './controllers/playlist';
import { TemplateAuthLogin } from './pages/auth/login/login';
import { TemplateAuthSignup } from './pages/auth/signup/signup';
import { DeviceService } from './services/device';
import { DeviceController } from './controllers/device';
import { DeviceList } from './pages/devices/list';
import { TemplateAuth } from './pages/auth/template';

library.add(fas, far, fab)

const playlistService = new PlaylistService();
const deviceService = new DeviceService();

const playlistController = new PlaylistController(playlistService);
const deviceController = new DeviceController(deviceService);

function App() {
  return (
    <Router>
        <Routes>
          <Route path="/" element={<Template page={<Dashboard />} /> } />
          <Route path="/dashboard" element={<Template page={<Dashboard />} /> } />
          <Route path="/playlists" element={<Template page={<PlaylistList controller={playlistController}/>} /> } />
          <Route path="/playlists/create" element={<Template page={<PlaylistCreate controller={playlistController} />} />} />
          <Route path="/playlists/config" element={<Template page={<PlaylistConfig controller={playlistController} />} />} />
          <Route path="/login" element={<TemplateAuth page={<TemplateAuthLogin />} />} />
          <Route path="/signup" element={<TemplateAuth page={<TemplateAuthSignup />} />} />
        </Routes>
    </Router>
  );
}

export default App;