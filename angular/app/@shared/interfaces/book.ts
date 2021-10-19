import { Genre } from "./genre";
import { Author } from "./author";
import { Tag } from "./tag";

export interface Book {
// model generated section
    id?: any;
    title?: any;
    code?: any;
    genre_id?: any;
    cover?: any;
    published_at?: any;
    edition?: any;
    bought_at?: any;
    resume?: any;
    genre?: Genre | any;
    author_ids?: any[] | any;
    authors?: Author[];
    tag_ids?: any[] | any;
    tags?: Tag[];
    created_at?: any;
    updated_at?: any;
    deleted_at?: any;
// end model generated section
}
