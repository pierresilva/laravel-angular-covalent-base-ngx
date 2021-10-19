import { Customer } from "./customer";
import { Patient } from "./patient";
import { ExaminationType } from "./examination-type";
import { Supplier } from "./supplier";
import { City } from "./city";
import { ExaminationTest } from "./examination-test";
import { ExaminationTrack } from "./examination-track";
import { ServiceOrderFile } from "./service-order-file";
import { ServiceOrderNote } from "./service-order-note";

export interface ServiceOrder {
// model generated section
    id?: any;
    name?: any;
    customer_id?: any;
    patient_id?: any;
    examination_type_id?: any;
    date_attention?: any;
    supplier_id?: any;
    city_id?: any;
    status?: any;
    customer?: Customer | any;
    patient?: Patient | any;
    examination_type?: ExaminationType | any;
    supplier?: Supplier | any;
    city?: City | any;
    examination_test_ids?: any[] | any;
    examination_tests?: ExaminationTest[];
    examination_track_ids?: any[] | any;
    examination_tracks?: ExaminationTrack[];
    service_order_file_ids?: any[] | any;
    service_order_files?: ServiceOrderFile[];
    service_order_note_ids?: any[] | any;
    service_order_notes?: ServiceOrderNote[];
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
