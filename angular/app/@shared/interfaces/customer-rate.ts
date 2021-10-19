import { Customer } from "./customer";
import { ExaminationTest } from "./examination-test";

export interface CustomerRate {
// model generated section
    id?: any;
    name?: any;
    customer_id?: any;
    examination_test_id?: any;
    price?: any;
    customer?: Customer | any;
    examination_test?: ExaminationTest | any;
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
