import {Injectable} from '@angular/core';
import {ApiMeta} from "@shared/interfaces/api-meta";
import {ITdDataTableColumn, TdDataTableSortingOrder} from "@covalent/core/data-table";
import {Author} from "@shared/interfaces/author";
import {HttpApiService} from "@shared/services/http-api.service";
import {Router} from "@angular/router";
import {TdLoadingService} from "@covalent/core/loading";
import {TdDialogService} from "@covalent/core/dialogs";
import {SnackBarService} from "@shared/services/snack-bar.service";

@Injectable({
    providedIn: 'root'
})
export class AuthorService {

    public drawer: any;
    public path = 'authors';
    public items: Author[] = [];
    public selectedItems: Author[] = [];
    public item: Author = <Author>{};
    public model: Author = <Author>{};
    public apiMeta: ApiMeta = <ApiMeta>{};
    public searchTerm: any = null;
    public sortBy = 'id';
    public sortDirection = 'desc';
    public sortOrder: TdDataTableSortingOrder = TdDataTableSortingOrder.Descending;
    public perPage = 20;
    public isLoading = false;
    public dialogRef: any;
    public overlayStarSyntax: boolean = false;

    public selectable: boolean = true;
    public selectedRows: any[] = [];
    public clickable: boolean = false;
    public multiple: boolean = true;
    public resizableColumns: boolean = false;

    public sidenav: any;

    columns: ITdDataTableColumn[] = [
                        
        {
            name: "name",
            label: "_NAME",
            sortable: true,
        },

                                        
        {
            name: "code",
            label: "Código",
            sortable: true,
        },

                                        
        {
            name: "genre",
            label: "_GENERO",
            sortable: true,
        },

                                        
        {
            name: "birth_date",
            label: "_FECHA-DE-NACIMIENTO",
            sortable: true,
        },

                        
        {
            name: 'id',
            label: '',
            sortable: false,
            width: 60
        },
    ];

    constructor(
        private api: HttpApiService,
        private router: Router,
        private snackBar: SnackBarService,
        private _loadingService: TdLoadingService,
        private _dialogService: TdDialogService,
    ) {
    }

    public filter(event: any) {
        console.log(event);
    }

    public sort(event: any) {
        console.log(event);
    }

    public page(event: any = null) {
        console.log(event);
    }

    public refreshTable(event: any = null) {
        console.log(event);
    }

    public showAlert(event: any = null) {
        console.log(event);
    }

    public getItems(page: any = 1) {
        this.isLoading = true;
        this.api.get('api/' + this.path + '?page=' + page + '&per_page=' + this.perPage + this.getSortString() + this.getSearchString())
            .subscribe(
                (res: any) => {
                    this.items = res.data;
                    this.apiMeta = res.meta;
                    this.isLoading = false;
                },
                (err: any) => {
                    this.isLoading = false;
                }
            );
    }

    public getItem(id: any) {
        this.isLoading = true;
        this.api.get('api/' + this.path + '/' + id)
            .subscribe(
                (res: any) => {
                    this.edit(res.data);
                    this.isLoading = false;
                },
                (err: any) => {
                    this.isLoading = false;
                }
            );
    }

    public setItem(item: Author) {
        this.item = item;
    }

    save() {
        if (this.model.id) {
            this.update();
        } else {
            this.store();
        }
    }

    store() {
        console.log('store', this.model);
        this.api.post('api/' + this.path, {model: this.model})
            .subscribe(
                (res: any) => {
                    this.model = <Author>{};
                    this.snackBar.success(res.message);
                    this.getItems();
                    this.sidenav.close();
                    this.router.navigateByUrl('/admin/{{{ $name|name_name}}}');
                },
                (err: any) => {
                    let message = '';
                    for (const item in err.errors) {
                        message = err.errors[item][0];
                    }
                    this.snackBar.error(message);
                }
            );
    }

    update() {
        this.api.put('api/' + this.path + '/' + this.model.id, {model: this.model})
            .subscribe(
                (res: any) => {
                    this.model = <Author>{};
                    this.snackBar.success(res.message);
                    this.getItems();
                    this.sidenav.close();
                    this.router.navigateByUrl('/admin/authors');
                },
                (err: any) => {
                    console.log(err);
                    let message = '';
                    for (const item in err.errors) {
                        message = err.errors[item][0];
                    }
                    this.snackBar.error(message);
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
                                this.model = <Author>{};
                                this.snackBar.success(res.message);
                                this.getItems();
                            },
                            (err: any) => {
                                this.snackBar.error(err.error.message);
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
                                this.snackBar.success(res.message);
                                this.getItems();
                                this.selectedItems = [];
                            },
                            (err: any) => {
                                this.snackBar.error(err.error.message);
                            }
                        );
                }
            });
    }

    edit(item: Author) {
        this.model = Object.assign({}, item);
    }

    getSortString() {
        return '&q[s]=' + this.sortBy + ':' + this.sortDirection;
    }

    getSearchString() {
        let string = '';
        if (this.searchTerm && this.searchTerm !== '') {
            for (let i = 0; i < this.columns.length; i++) {
                if (this.columns[i].name !== 'id') { // poner todos lo many2many
                    string += '&q[' + this.columns[i].name + ':cont]=' + this.searchTerm;
                }
            }
        }
        return string;
    }

    public setPerPage(event: any) {
        this.perPage = event.source.value;
    }

    public setSearchTerm(event: any) {
        console.log(event);
        this.searchTerm = event;
    }

    public setSortBy(event: any) {
        this.sortBy = event.name;
        this.sortDirection = event.order.toLowerCase();
    }

    toggleLoading(mode: 'close' | 'open'): void {

        if (mode === 'close') {
            this._loadingService.resolve()
        }

        if (mode === 'open') {
            this._loadingService.register();
        }
    }

}
