import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {FormControl} from "@angular/forms";
import {HttpClient} from "@angular/common/http";
import {debounceTime, finalize, switchMap, tap} from "rxjs/operators";
import {SnackBarService} from "@shared/services/snack-bar.service";

@Component({
  selector: 'app-belongs-to-many-input',
  templateUrl: './belongs-to-many-input.component.html',
  styleUrls: ['./belongs-to-many-input.component.scss']
})
export class BelongsToManyInputComponent implements OnInit {

  @Input() selected: any[] | any = [];
  @Input() selectedIds:  any[] | any = [];
  @Input() searchUrl: any = null;
  @Input() searchColumns: any[] = ['name'];
  @Input() searchDisplayColumns: any[] = ['name'];
  @Input() searchInputLabel: any = 'Buscar item';
  @Input() searchInputPlaceholder: any = 'Buscar...';
  @Input() notFoundMessage: any = 'No items found';
  @Input() notFoundButtonText: any = null;
  @Input() notFoundUrl: any = null;
  @Input() loadingText: any = 'Buscando...';
  @Input() required: boolean = false;
  @Input() label: any = null;
  @Input() min: any = null;
  @Input() max: any = null;


  @Output() selectOut: EventEmitter<any[]> = new EventEmitter();
  @Output() selectIdsOut: EventEmitter<any[]> = new EventEmitter();

  public searchInput = new FormControl();
  public searchString = '';
  public filteredData: any[] = [];

  public isLoading: boolean = false;
  public errorMessage: string = '';

  constructor(
    private http: HttpClient,
    private snackBar: SnackBarService,
  ) { }

  ngOnInit(): void {
    this.filterData();
  }

  getSearchString(value: string) {
    let search: any[] = [];
    this.searchColumns.map(column => {
      let thisSearch = {
        column: column,
        operator: 'cont',
        text: value
      };
      search.push(thisSearch);
    });

    return '&query=' + JSON.stringify(search);
  }

  filterData() {
    this.searchInput.valueChanges
      .pipe(
        debounceTime(500),
        tap(() => {
          this.errorMessage = '';
          this.filteredData = [];
          this.isLoading = true;
        }),
        switchMap(value => this.http.get(this.searchUrl + "?per_page=100" + this.getSearchString(value))
          .pipe(
            finalize(() => {
              this.isLoading = false
            }),
          )
        )
      )
      .subscribe((res: any) => {
        if (res['data'] == undefined) {
          this.errorMessage = res['message'];
          this.filteredData = [];
        } else {
          this.errorMessage = '';
          this.filteredData = res['data'];
        }
        // console.log(this.filteredData);
      });
  }

  addItem(event: any) {
    let exists = false;
    if (this.selected) {
      for (let i = 0; i < this.selected?.length; i++) {
        if (this.selected[i].id === event.id) {
          exists = true;
        }
      }
    }

    this.searchInput.setValue('')

    if (this.max) {
      if (this.selected.length >= this.max) {
        this.snackBar.openSnackBar('Solo puedes agregar ' + this.max + ' items', 'OK')
        return;
      }
    }

    if (exists) {
      return;
    }

    this.selectedIds?.push(event.id);
    this.selected?.push(event);

    this.selectOut.emit(this.selected);
    this.selectIdsOut.emit(this.selectedIds);

  }

  removeItem(itemIn: any): void {
    this.selected?.map((item: any, index: any) => {
      if (item.id === itemIn.id) {
        this.selected.splice(index, 1);
      }
    });

    this.selectedIds.map((item: any, index: any) => {
      if (item == itemIn.id) {
        this.selectedIds.splice(index, 1);
      }
    });

    this.selectOut.emit(this.selected);
    this.selectIdsOut.emit(this.selectedIds);
  }

}
