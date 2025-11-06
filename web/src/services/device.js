import axios from 'axios';

export class DeviceService {
    async getAll() {
        const response = await axios.get('http://localhost/api/src/devices');
        return response;
    }
}