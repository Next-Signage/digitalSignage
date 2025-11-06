export class PlaylistController {
    constructor(playlistService) {
        this.playlistService = playlistService;
    }

    getAll() {
        return this.playlistService.getAll();
    }
}