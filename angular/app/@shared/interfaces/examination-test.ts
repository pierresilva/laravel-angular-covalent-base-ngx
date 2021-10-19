import { SupplierRate } from "./supplier-rate";
import { ServiceOrder } from "./service-order";
import { CustomerRate } from "./customer-rate";

export interface ExaminationTest {
// model generated section
    id?: any;
    name?: any;
    description?: any;
    supplier_rate_ids?: any[] | any;
    supplier_rates?: SupplierRate[];
    service_order_ids?: any[] | any;
    service_orders?: ServiceOrder[];
    customer_rate_ids?: any[] | any;
    customer_rates?: CustomerRate[];
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
