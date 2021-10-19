import { City } from "./city";
import { County } from "./county";
import { Regional } from "./regional";

export interface Region {
// model generated section
    id?: any;
    name?: any;
    code?: any;
    county_id?: any;
    city_ids?: any[] | any;
    cities?: City[];
    county?: County | any;
    regional_ids?: any[] | any;
    regionals?: Regional[];
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
