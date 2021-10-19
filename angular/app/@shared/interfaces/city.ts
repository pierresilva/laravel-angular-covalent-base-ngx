import { SupplierHeadquarter } from "./supplier-headquarter";
import { ServiceOrder } from "./service-order";
import { Region } from "./region";

export interface City {
// model generated section
    id?: any;
    name?: any;
    code?: any;
    region_id?: any;
    supplier_headquarter_ids?: any[] | any;
    supplier_headquarters?: SupplierHeadquarter[];
    service_order_ids?: any[] | any;
    service_orders?: ServiceOrder[];
    region?: Region | any;
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
