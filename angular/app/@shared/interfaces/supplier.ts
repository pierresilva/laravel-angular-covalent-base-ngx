import { User } from "./user";
import { SupplierHeadquarter } from "./supplier-headquarter";
import { SupplierRate } from "./supplier-rate";
import { ServiceOrder } from "./service-order";

export interface Supplier {
// model generated section
    id?: any;
    name?: any;
    person_type?: any;
    document_type?: any;
    document_number?: any;
    user_id?: any;
    user?: User | any;
    supplier_headquarter_ids?: any[] | any;
    supplier_headquarters?: SupplierHeadquarter[];
    supplier_rate_ids?: any[] | any;
    supplier_rates?: SupplierRate[];
    service_order_ids?: any[] | any;
    service_orders?: ServiceOrder[];
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
