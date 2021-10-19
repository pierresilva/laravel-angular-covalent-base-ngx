import { User } from "./user";
import { ServiceOrder } from "./service-order";
import { Customer } from "./customer";

export interface Patient {
// model generated section
    id?: any;
    first_name?: any;
    second_name?: any;
    first_surname?: any;
    second_surname?: any;
    full_name?: any;
    email?: any;
    phone?: any;
    whatsapp?: any;
    document_type?: any;
    document_number?: any;
    user_id?: any;
    user?: User | any;
    service_order_ids?: any[] | any;
    service_orders?: ServiceOrder[];
    customer_ids?: any[] | any;
    customers?: Customer[];
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
