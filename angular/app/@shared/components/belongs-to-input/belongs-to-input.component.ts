import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {FormControl} from "@angular/forms";
import {HttpClient} from "@angular/common/http";
import {SnackBarService} from "@shared/services/snack-bar.service";
import {debounceTime, finalize, switchMap, tap} from "rxjs/operators";

@Component({
  selector: 'app-belongs-to-input',
  templateUrl: './belongs-to-input.component.html',
  styleUrls: ['./belongs-to-input.component.scss']
})
export class BelongsToInputComponent implements OnInit {

  @Input() selected: any;
  @Input() selectedId:  any;
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

  @Output() selectOut: EventEmitter<any[]> = new EventEmitter();
  @Output() selectIdOut: EventEmitter<any[]> = new EventEmitter();

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
    this.selectedId =  event.id;
    this.selected = event;

    this.searchInput.setValue('');

    this.selectOut.emit(this.selected);
    this.selectIdOut.emit(this.selectedId);

  }

  removeItem(): void {
    this.selected = null;

    this.selectedId = null;

    this.selectOut.emit(this.selected);
    this.selectIdOut.emit(this.selectedId);
  }

}
