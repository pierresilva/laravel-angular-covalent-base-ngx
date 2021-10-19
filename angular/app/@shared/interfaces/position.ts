import { User } from "./user";
import { Regional } from "./regional";

export interface Position {
// model generated section
    id?: any;
    name?: any;
    notify_on_create_service_order?: any;
    notify_on_assign_service_order?: any;
    notify_on_reject_service_order?: any;
    notify_on_accept_service_order?: any;
    notify_on_complete_service_order?: any;
    user_ids?: any[] | any;
    users?: User[];
    regional_ids?: any[] | any;
    regionals?: Regional[];
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
