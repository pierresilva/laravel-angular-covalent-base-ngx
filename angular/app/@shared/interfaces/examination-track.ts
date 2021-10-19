import { User } from "./user";
import { ServiceOrder } from "./service-order";

export interface ExaminationTrack {
// model generated section
    id?: any;
    name?: any;
    description?: any;
    user_id?: any;
    service_order_id?: any;
    user?: User | any;
    service_order?: ServiceOrder | any;
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
