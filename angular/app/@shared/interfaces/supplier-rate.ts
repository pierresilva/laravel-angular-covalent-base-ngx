import { Supplier } from "./supplier";
import { ExaminationTest } from "./examination-test";

export interface SupplierRate {
// model generated section
    id?: any;
    name?: any;
    supplier_id?: any;
    examination_test_id?: any;
    price?: any;
    supplier?: Supplier | any;
    examination_test?: ExaminationTest | any;
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
