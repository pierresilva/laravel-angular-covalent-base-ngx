import {AfterViewInit, Component, Injectable, OnInit, ViewChild} from '@angular/core';
import {BookService} from "@app/about/services/book.service";
import {MatSidenav} from "@angular/material/sidenav";
import {MediaObserver} from "@angular/flex-layout";
import {MatPaginator, MatPaginatorIntl} from "@angular/material/paginator";
import {MatSort, SortDirection} from "@angular/material/sort";
import {animate, state, style, transition, trigger} from '@angular/animations';
import {HttpClient} from "@angular/common/http";
import {merge, Observable, of as observableOf, Subject} from 'rxjs';
import {catchError, map, startWith, switchMap} from 'rxjs/operators';
import {environment} from "@env/environment";
import {Book} from "@shared/interfaces/book";
import {SelectionModel} from "@angular/cdk/collections";

@Injectable()
export class MyCustomPaginatorIntl implements MatPaginatorIntl {
  changes = new Subject<void>();

  // For internationalization, the `$localize` function from
  // the `@angular/localize` package can be used.
  firstPageLabel = '';
  itemsPerPageLabel = '';
  lastPageLabel = '';

  // You can set labels to an arbitrary string too, or dynamically compute
  // it through other third-party internationalization libraries.
  nextPageLabel = 'Siguiente';
  previousPageLabel = 'Anterior';

  getRangeLabel(page: number, pageSize: number, length: number): string {
    if (length === 0) {
      return $localize`1 - 1`;
    }
    const amountPages = Math.ceil(length / pageSize);
    return $localize`${page + 1} - ${amountPages}`;
  }
}

export enum OrderBy {
  ASC = <any>'asc',
  DESC = <any>'desc',
}


@Component({
  selector: 'app-book-list-alt',
  templateUrl: './book-list-alt.component.html',
  styleUrls: ['./book-list-alt.component.scss'],
  animations: [
    trigger('detailExpand', [
      state('collapsed', style({height: '0px', minHeight: '0'})),
      state('expanded', style({height: '*'})),
      transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
    ]),
  ],
  providers: [
    {provide: MatPaginatorIntl, useClass: MyCustomPaginatorIntl}
  ]
})
export class BookListAltComponent implements OnInit, AfterViewInit {

  @ViewChild(MatPaginator) paginator: MatPaginator | any;
  @ViewChild(MatSort) sort: MatSort | any;
  @ViewChild(MatSidenav, {static: true}) sidenav: any;

  displayedColumns: string[] = ['select', 'id', 'title'];
  exampleDatabase: ExampleHttpDatabase | any;
  selection = new SelectionModel<any>(true, []);
  expandedElement: any = null;

  data: Book[] = [];
  httpData: Book[] = [];

  resultsLength = 0;
  isLoadingResults = true;
  isRateLimitReached = false;

  columnOptions: any[] = [{
    name: 'Updated',
    value: 'updated_at',
  }, {
    name: 'Created',
    value: 'created_at',
  }];
  sortKey: string = this.columnOptions[0].value;
  headers: any = {};
  pageSize: number  = 20;

  constructor(
    public bookService: BookService,
    private mediaObserver: MediaObserver,
    private _httpClient: HttpClient
  ) { }

  ngOnInit(): void {
    this.bookService.getItems();
  }

  ngAfterViewInit() {
    this.exampleDatabase = new ExampleHttpDatabase(this._httpClient);

    // If the user changes the sort order, reset back to the first page.
    this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);

    merge(this.sort.sortChange, this.paginator.page)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.isLoadingResults = true;
          return this.exampleDatabase!.getRepoIssues(
            this.sort.active, this.sort.direction, this.paginator.pageIndex)
            .pipe(catchError(() => observableOf(null)));
        }),
        map((data: any) => {
          // Flip flag to show that loading has finished.
          this.isLoadingResults = false;
          this.isRateLimitReached = data === null;

          if (data === null) {
            return [];
          }

          // Only refresh the result length if there is new data. In case of rate
          // limit errors, we do not want to reset the paginator to zero, as that
          // would prevent users from re-triggering requests.
          this.resultsLength = data.meta.total;
          return data.data;
        })
      ).subscribe(data => this.data = data);
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

  isASC(sortKey: string): boolean {
    return this.headers[sortKey] === OrderBy.ASC;
  }

  get isMobile(): boolean {
    return this.mediaObserver.isActive('xs') || this.mediaObserver.isActive('sm');
  }

  /** Whether the number of selected elements matches the total number of rows. */
  isAllSelected() {
    const numSelected = this.selection.selected.length;
    const numRows = this.data.length;
    return numSelected === numRows;
  }

  /** Selects all rows if they are not all selected; otherwise clear selection. */
  masterToggle() {
    if (this.isAllSelected()) {
      this.selection.clear();
      return;
    }

    this.selection.select(...this.data);
  }

  /** The label for the checkbox on the passed row */
  checkboxLabel(row?: any): string {
    if (!row) {
      return `${this.isAllSelected() ? 'deselect' : 'select'} all`;
    }
    return `${this.selection.isSelected(row) ? 'deselect' : 'select'} row ${row.position + 1}`;
  }

}

/** An example database that the data source uses to retrieve data for the table. */
export class ExampleHttpDatabase {
  constructor(private _httpClient: HttpClient) {}

  getRepoIssues(sort: string, order: SortDirection, page: number): Observable<any> {
    const href = environment.apiUrl + 'api/books';
    const requestUrl =`${href}?q[s]=${sort}:${order}&page=${page + 1}&per_page=20`;

    return this._httpClient.get<any>(requestUrl);
  }
}

