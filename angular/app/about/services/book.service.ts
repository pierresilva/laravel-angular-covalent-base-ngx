import {Injectable} from '@angular/core';
import {MatDrawer} from "@angular/material/sidenav";
import {Book} from "@shared/interfaces/book";
import {ApiMeta} from "@shared/interfaces/api-meta";
import {BehaviorSubject} from "rxjs";
import {HttpApiService} from "@shared/services/http-api.service";
import {Router} from "@angular/router";
import {MatSnackBar} from "@angular/material/snack-bar";
import {ITdDataTableColumn, TdDataTableSortingOrder} from "@covalent/core/data-table";
import {TdLoadingService} from "@covalent/core/loading";
import {TdDialogService} from "@covalent/core/dialogs";

@Injectable({
  providedIn: 'root'
})
export class BookService {

  public drawer: any;
  public path = 'books';
  public items: Book[] = [];
  public selectedItems: Book[] = [];
  public item: Book = <Book>{};
  public model: Book = <Book>{};
  public apiMeta: ApiMeta = <ApiMeta>{};
  public searchTerm: any = null;
  public sortBy = 'id';
  public sortDirection = 'desc';
  public sortOrder: TdDataTableSortingOrder = TdDataTableSortingOrder.Descending;
  public perPage = 20;
  public isLoading = new BehaviorSubject(false);
  public dialogRef: any;
  public overlayStarSyntax: boolean = false;

  columns: ITdDataTableColumn[] = [
    {
      name: 'title',
      label: 'Title',
      sortable: true,
      filter: true,
      width: 240
    },
    {
      name: 'authors',
      label: 'Authors',
      sortable: false,
      width: 200,
    },
    {
      name: 'genre.name',
      label: 'Genre',
      sortable: true,
      width: 180,
    },
    {
      name: 'published_at',
      label: 'Published At',
      sortable: true,
    },
    {
      name: 'id',
      label: '',
      sortable: false,
      width: 120
    },
  ];

  constructor(
    private api: HttpApiService,
    private router: Router,
    private snackBar: MatSnackBar,
    private _loadingService: TdLoadingService,
    private _dialogService: TdDialogService
  ) {
  }

  public getItems(page: any = 1) {
    this.isLoading.next(true);
    this._loadingService.register('overlayStarSyntax');
    this.api.get('api/' + this.path + '?page=' + page + '&per_page=' + this.perPage + this.getSortString() + this.getSearchString())
      .subscribe(
        (res: any) => {
          this.items = res.data;
          this.apiMeta = res.meta;
          this.isLoading.next(false);
          this._loadingService.resolve('overlayStarSyntax');
        },
        (err: any) => {
          this.isLoading.next(false);
          this._loadingService.resolve('overlayStarSyntax');
        }
      );
  }

  public getItem(id: any) {
    this.isLoading.next(true);
    this._loadingService.register('overlayStarSyntax');
    this.api.get('api/' + this.path + '/' + id)
      .subscribe(
        (res: any) => {
          this.edit(res.data);
          this.isLoading.next(false);
          this._loadingService.resolve('overlayStarSyntax');
        },
        (err: any) => {
          this.isLoading.next(false);
          this._loadingService.resolve('overlayStarSyntax');
        }
      );
  }

  save() {
    if (this.model.id === 0 || undefined || null) {
      this.store();
    } else {
      this.update();
    }
  }

  store() {
    console.log('store', this.model);
    this.api.post('api/' + this.path, {model: this.model})
      .subscribe(
        (res: any) => {
          this.model = <Book>{};
          this.openSnackBar(res.message, 'OK', ['snack-bar-success']);
          this.getItems();
        },
        (err: any) => {
          let message = '';
          for (const item in err.errors) {
            message = err.errors[item][0];
          }
          this.openSnackBar(message, 'OK', ['snack-bar-danger']);
        }
      );
  }

  update() {
    console.log('update', this.model);
    this.api.put('api/' + this.path + '/' + this.model.id, {model: this.model})
      .subscribe(
        (res: any) => {
          this.model = <Book>{};
          this.openSnackBar(res.message, 'OK', ['snack-bar-success']);
          this.getItems();
          // this.backdropClick();
        },
        (err: any) => {
          console.log(err);
          let message = '';
          for (const item in err.errors) {
            message = err.errors[item][0];
          }
          this.openSnackBar(message, 'OK', ['snack-bar-danger']);
        }
      );
  }

  delete(id: any) {

    this._dialogService.openConfirm({
      title: 'Eliminar item',
      message: 'Realmente desea realizar esta acción?',
      cancelButton: 'Cancelar',
      acceptButton: 'Eliminar',
      width: '350px',
      disableClose: true
    })
      .afterClosed()
      .subscribe((accept: boolean) => {
        if (accept) {
          this.api.delete('api/' + this.path + '/' + id)
            .subscribe(
              (res: any) => {
                this.model = <Book>{};
                this.openSnackBar(res.message, 'OK', ['snack-bar-success']);
                this.getItems();
              },
              (err: any) => {
                this.openSnackBar(err.error.message, 'OK', ['snack-bar-danger']);
              }
            );
        }
      });
  }

  deleteMultiple() {
    this._dialogService.openConfirm({
      title: 'Eliminar ' + this.selectedItems.length + ' items',
      message: 'Realmente desea realizar esta acción?',
      cancelButton: 'Cancelar',
      acceptButton: 'Eliminar',
      width: '350px',
      disableClose: true
    })
      .afterClosed()
      .subscribe((accept: boolean) => {
        if (accept) {
          let items = [];
          for (let i = 0; i < this.selectedItems.length; i++) {
            items.push(this.selectedItems[i].id);
          }
          this.api.put('api/' + this.path + '/delete-multiple', {ids: items})
            .subscribe(
              (res: any) => {
                this.openSnackBar(res.message, 'OK', ['snack-bar-success']);
                this.getItems();
                this.selectedItems = [];
              },
              (err: any) => {
                this.openSnackBar(err.error.message, 'OK', ['snack-bar-danger']);
              }
            );
        }
      });
  }

  edit(item: Book) {
    this.model = Object.assign({}, item);
  }

  getSortString() {
    return '&q[s]=' + this.sortBy + ':' + this.sortDirection;
  }

  getSearchString() {
    let string = '';
    if (this.searchTerm && this.searchTerm !== '') {
      for (let i = 0; i < this.columns.length; i++) {
        if (this.columns[i].name !== 'id' && this.columns[i].name !== 'authors') { // poner todos lo many2many
          string += '&q[' + this.columns[i].name + ':cont]=' + this.searchTerm;
        }
      }
    }
    return string;
  }

  public openSnackBar(
    message: string,
    action: string = 'OK',
    panelClass: string | string[] = [],
    vPosition: 'top' | 'bottom' = 'top'
  ) {
    this.snackBar.open(message, action, {
      verticalPosition: vPosition,
      panelClass: panelClass
    });
  }

  public setPerPage(event: any) {
    // console.log(event.source.value);
    this.perPage = event.source.value;
  }

  public setSearchTerm(event: any) {
    console.log(event);
    this.searchTerm = event;
  }

  public setSortBy(event: any) {
    console.log(event);
    this.sortBy = event.name;
    this.sortDirection = event.order.toLowerCase();
    this.sortOrder = (event.order === 'DESC') ? TdDataTableSortingOrder.Descending : TdDataTableSortingOrder.Ascending;
  }

}
