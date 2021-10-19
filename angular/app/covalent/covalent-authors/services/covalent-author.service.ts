import {Injectable} from '@angular/core';
import {HttpApiService} from "@shared/services/http-api.service";

export enum OrderBy {
  ASC = <any>'asc',
  DESC = <any>'desc',
}

export interface Item {
  created_at?: any;
  updated_at?: any;
  name?: any;
  owner?: any;
}

@Injectable({
  providedIn: 'root'
})
export class CovalentAuthorService {

  data: Item[] = [
    {
      'created_at': '2015-11-04T19:00:31Z',
      'name': 'Change data capture for sales DB',
      'owner': 'Kyle',
      'updated_at': '2016-11-08T19:00:31Z',
    },
    {
      'created_at': '2015-11-08T19:00:31Z',
      'name': 'Change data capture for MF DB',
      'owner': 'Richa',
      'updated_at': '2016-11-09T19:00:31Z',
    },
    {
      'created_at': '2015-12-11T19:00:31Z',
      'name': 'Our Data Lake',
      'owner': 'Ed',
      'updated_at': '2016-12-07T19:00:31Z',
    },
    {
      'created_at': '2015-11-05T19:00:31Z',
      'name': 'Nightly batched analytics',
      'owner': 'Ilsun',
      'updated_at': '2016-11-07T19:00:31Z',
    },
    {
      'created_at': '2015-12-12T19:00:31Z',
      'name': 'Long term data storage',
      'owner': 'Jeremy',
      'updated_at': '2016-12-08T19:00:31Z',
    },
    {
      'created_at': '2015-12-15T19:00:31Z',
      'name': 'On the fly analytics',
      'owner': 'Jenn',
      'updated_at': '2016-12-09T19:00:31Z',
    },
    {
      'created_at': '2015-11-04T19:00:31Z',
      'name': 'Change data capture for sales DB',
      'owner': 'Kyle',
      'updated_at': '2016-11-08T19:00:31Z',
    },
    {
      'created_at': '2015-11-08T19:00:31Z',
      'name': 'Change data capture for MF DB',
      'owner': 'Richa',
      'updated_at': '2016-11-09T19:00:31Z',
    },
    {
      'created_at': '2015-12-11T19:00:31Z',
      'name': 'Our Data Lake',
      'owner': 'Ed',
      'updated_at': '2016-12-07T19:00:31Z',
    },
    {
      'created_at': '2015-11-05T19:00:31Z',
      'name': 'Nightly batched analytics',
      'owner': 'Ilsun',
      'updated_at': '2016-11-07T19:00:31Z',
    },
    {
      'created_at': '2015-12-12T19:00:31Z',
      'name': 'Long term data storage',
      'owner': 'Jeremy',
      'updated_at': '2016-12-08T19:00:31Z',
    },
    {
      'created_at': '2015-12-15T19:00:31Z',
      'name': 'On the fly analytics',
      'owner': 'Jenn',
      'updated_at': '2016-12-09T19:00:31Z',
    },
    {
      'created_at': '2015-11-08T19:00:31Z',
      'name': 'Change data capture for MF DB',
      'owner': 'Richa',
      'updated_at': '2016-11-09T19:00:31Z',
    },
    {
      'created_at': '2015-12-11T19:00:31Z',
      'name': 'Our Data Lake',
      'owner': 'Ed',
      'updated_at': '2016-12-07T19:00:31Z',
    },
    {
      'created_at': '2015-11-05T19:00:31Z',
      'name': 'Nightly batched analytics',
      'owner': 'Ilsun',
      'updated_at': '2016-11-07T19:00:31Z',
    },
    {
      'created_at': '2015-12-12T19:00:31Z',
      'name': 'Long term data storage',
      'owner': 'Jeremy',
      'updated_at': '2016-12-08T19:00:31Z',
    },
    {
      'created_at': '2015-12-15T19:00:31Z',
      'name': 'On the fly analytics',
      'owner': 'Jenn',
      'updated_at': '2016-12-09T19:00:31Z',
    },
    {
      'created_at': '2015-11-04T19:00:31Z',
      'name': 'Change data capture for sales DB',
      'owner': 'Kyle',
      'updated_at': '2016-11-08T19:00:31Z',
    },
    {
      'created_at': '2015-11-08T19:00:31Z',
      'name': 'Change data capture for MF DB',
      'owner': 'Richa',
      'updated_at': '2016-11-09T19:00:31Z',
    },
    {
      'created_at': '2015-12-11T19:00:31Z',
      'name': 'Our Data Lake',
      'owner': 'Ed',
      'updated_at': '2016-12-07T19:00:31Z',
    },
    {
      'created_at': '2015-11-05T19:00:31Z',
      'name': 'Nightly batched analytics',
      'owner': 'Ilsun',
      'updated_at': '2016-11-07T19:00:31Z',
    },
    {
      'created_at': '2015-12-12T19:00:31Z',
      'name': 'Long term data storage',
      'owner': 'Jeremy',
      'updated_at': '2016-12-08T19:00:31Z',
    },
    {
      'created_at': '2015-12-15T19:00:31Z',
      'name': 'On the fly analytics',
      'owner': 'Jenn',
      'updated_at': '2016-12-09T19:00:31Z',
    }
  ];

  columnOptions: any[] = [
    {
      name: 'Name',
      value: 'name',
    },
    {
      name: 'Updated',
      value: 'updated_at',
    },
    {
      name: 'Created',
      value: 'created_at',
    }
  ];

  sortKey: string = this.columnOptions[1].value;
  pageSize: number = 5;
  example1: boolean = true;
  headers: any = {};

  constructor(
    private api: HttpApiService
  ) {
    this.columnOptions.forEach((option: any) => {
      this.headers[option.value] = OrderBy.ASC;
    });
  }

  isASC(sortKey: string): boolean {
    return this.headers[sortKey] === OrderBy.ASC;
  }

  sortBy(sortKey: string): void {
    if (this.headers[sortKey] === OrderBy.ASC) {
      this.headers[sortKey] = OrderBy.DESC;
    } else {
      this.headers[sortKey] = OrderBy.ASC;
    }
    this.data = this.data.sort((rowA: Object, rowB: Object) => {
      let cellA: string = rowA[sortKey];
      let cellB: string = rowB[sortKey];
      let sort: number = 0;
      if (cellA < cellB) {
        sort = -1;
      } else if (cellA > cellB) {
        sort = 1;
      }
      return sort * (this.headers[sortKey] === OrderBy.DESC ? -1 : 1);
    });
  }

  search(event: any): void {
    // dummy func
  }
}
