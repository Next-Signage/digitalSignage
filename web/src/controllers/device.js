export class DeviceController {
    constructor(deviceService) {
        this.deviceService = deviceService;
    }

    getAll() {
        return this.deviceService.getAll();
    }
}