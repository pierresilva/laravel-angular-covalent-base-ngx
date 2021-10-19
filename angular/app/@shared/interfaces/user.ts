import { Supplier } from "./supplier";
import { Patient } from "./patient";
import { Customer } from "./customer";
import { ExaminationTrack } from "./examination-track";
import { Position } from "./position";
import {UserRole} from "@shared/interfaces/user-role";

export interface User {
// model generated section
    id?: any;
    name?: any;
    first_name?:  any;
    last_name?:  any;
    email?: any;
    password?: any;
    supplier_ids?: any[] | any;
    suppliers?: Supplier[];
    patient_ids?: any[] | any;
    patients?: Patient[];
    customer_ids?: any[] | any;
    customers?: Customer[];
    examination_track_ids?: any[] | any;
    examination_tracks?: ExaminationTrack[] | any;
    position_ids?: any[] | any;
    user_roles?: UserRole[] | any;
    user_role_ids?: any[] | any;
    positions?: Position[] | any;
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
