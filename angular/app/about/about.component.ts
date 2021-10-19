import {Component, OnInit, TemplateRef, ViewChild} from '@angular/core';

import {environment} from '@env/environment';
import {MediaObserver} from "@angular/flex-layout";
import {TdMediaService} from "@covalent/core/media";
import {TdLayoutManageListComponent} from "@covalent/core/layout";
import {IPageChangeEvent, TdPagingBarComponent} from "@covalent/core/paging";
import {
  ITdDataTableColumn,
  ITdDataTableSortChangeEvent,
  TdDataTableService,
  TdDataTableSortingOrder
} from "@covalent/core/data-table";
import {TdDialogService} from "@covalent/core/dialogs";
import {InternalDocsService} from "@shared/services/internal-docs.service";
import {MatSidenav} from "@angular/material/sidenav";
import {HttpApiService} from "@shared/services/http-api.service";
import {BookService} from "@app/about/services/book.service";
import {TdLoadingService} from "@covalent/core/loading";

export enum OrderBy {
  ASC = <any>'asc',
  DESC = <any>'desc',
}

const DECIMAL_FORMAT: (v: any) => any = (v: number) => v.toFixed(2);

export interface Item {
  created_at?: any;
  updated_at?: any;
  name?: any;
  owner?: any;
}

@Component({
  selector: 'app-about',
  templateUrl: './about.component.html',
  styleUrls: ['./about.component.scss']
})
export class AboutComponent implements OnInit {

  version: string | null = environment.version;

  headers: any = {};

  single: any[] = [];
  multi: any[] = [];

  @ViewChild(TdPagingBarComponent, {static: true}) pagingBar: any;
  @ViewChild(MatSidenav, {static: true}) sidenav: any;

  columns: ITdDataTableColumn[] = [
    {
      name: 'first_name',
      label: 'First Name',
      sortable: true,
      filter: false,
      width: 150
    },
    {
      name: 'last_name',
      label: 'Last Name',
      sortable: false
    },
    {
      name: 'email',
      label: 'Email',
      sortable: true,
      width: 250
    },
    {
      name: 'balance',
      label: 'Balance',
      numeric: true,
      format: DECIMAL_FORMAT
    },
  ];

  data: any[] = [];
  basicData: any[] = [];
  selectable: boolean = true;
  clickable: boolean = true;
  multiple: boolean = true;
  resizableColumns: boolean = false;

  filteredData: any[] = [];
  filteredTotal: number = 0;
  selectedRows: any[] = [];

  filterTerm: string = '';
  fromRow: number = 1;
  currentPage: number = 1;
  pageSize: number = 50;
  sortBy: string = 'published_at';
  sortOrder: TdDataTableSortingOrder = TdDataTableSortingOrder.Descending;

  constructor(
    private mediaObserver: MediaObserver,
    public media: TdMediaService,
    private _dataTableService: TdDataTableService,
    private _dialogService: TdDialogService,
    private _internalDocsService: InternalDocsService,
    public bookService: BookService,
    private _loadingService: TdLoadingService
  ) {
  }

  ngOnInit() {

    // this.bookService.getItems();

    this.media.broadcast();

    this.data = this._internalDocsService.getData();
    this.basicData = this.data.slice(0, 10);
    this.refreshTable();

  }

  get isMobile(): boolean {
    return this.mediaObserver.isActive('xs') || this.mediaObserver.isActive('sm');
  }

  isASC(sortKey: string): boolean {
    return this.headers[sortKey] === OrderBy.ASC;
  }

  sort(sortEvent: ITdDataTableSortChangeEvent): void {
    this.sortBy = sortEvent.name;
    this.sortOrder = sortEvent.order;
    this.refreshTable();
  }

  filter(filterTerm: string): void {
    this.filterTerm = filterTerm;
    this.pagingBar.navigateToPage(1);
    this.refreshTable();
  }

  page(pagingEvent: IPageChangeEvent): void {
    this.fromRow = pagingEvent.fromRow;
    this.currentPage = pagingEvent.page;
    this.pageSize = pagingEvent.pageSize;
    this.refreshTable();
  }

  refreshTable(): void {
    let newData: any[] = this.data;
    const excludedColumns: string[] = this.columns
      .filter((column: ITdDataTableColumn) => {
        return (
          (column.filter === undefined && column.hidden === true) ||
          (column.filter !== undefined && column.filter === false)
        );
      })
      .map((column: ITdDataTableColumn) => {
        return column.name;
      });
    newData = this._dataTableService.filterData(newData, this.filterTerm, true, excludedColumns);
    this.filteredTotal = newData.length;
    newData = this._dataTableService.sortData(newData, this.sortBy, this.sortOrder);
    newData = this._dataTableService.pageData(newData, this.fromRow, this.currentPage * this.pageSize);
    this.filteredData = newData;
  }

  showAlert(event: any): void {
    // this.sidenav.toggle();
    /*this._dialogService.openAlert({
      message: 'You clicked on row: ' + event.row.first_name + ' ' + event.row.last_name,
    });*/
  }

  search(event: any): void {
    // dummy func
    console.log(event);
  }

}
