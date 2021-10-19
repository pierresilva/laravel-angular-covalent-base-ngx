import { User } from "./user";
import { ServiceOrder } from "./service-order";
import { Patient } from "./patient";
import { CustomerRate } from "./customer-rate";

export interface Customer {
// model generated section
    id?: any;
    name?: any;
    first_name?: any;
    first_surname?: any;
    person_type?: any;
    document_type?: any;
    document_number?: any;
    address?: any;
    phone?: any;
    email?: any;
    contact_name?: any;
    until_date?: any;
    credit?: any;
    credit_current?: any;
    user_id?: any;
    user?: User | any;
    service_order_ids?: any[] | any;
    service_orders?: ServiceOrder[];
    patient_ids?: any[] | any;
    patients?: Patient[];
    customer_rate_ids?: any[] | any;
    customer_rates?: CustomerRate[];
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
