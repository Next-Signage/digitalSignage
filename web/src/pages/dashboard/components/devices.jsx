import { Device } from "./device"

export const Devices = ({online, offline}) => {
    return <div className="devices">
        <Device type="dispositivos" text="Dispositivos" count={online + offline}/>
        <Device type="online" text="Online" count={online}/>
        <Device type="offline" text="Offline" count={offline}/>
    </div>
}