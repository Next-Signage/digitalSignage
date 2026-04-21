# DigitalSignage
This is a digital signage brazilian project. The plataform can register players (made with raspberryPi) and play selected playlist of images and videos

# Routes Protocol
Create Routes is simple. This system has a module (class: Route) that coontains methods to manipulate the routes.
The main method is dispatch (public function dispatch). This function works like a core, listening for some request and a path, if this path is on router list, hit a reirect to this path, if not an error is called. 
