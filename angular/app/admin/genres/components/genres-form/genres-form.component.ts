import {Component, OnDestroy, OnInit} from '@angular/core';
import {environment} from "@env/environment";
import {Editor} from "ngx-editor";
import {TdFileService} from "@covalent/core/file";
import {SnackBarService} from "@shared/services/snack-bar.service";
import {HttpApiService} from "@shared/services/http-api.service";
import {GenreService} from "@app/admin/genres/services/genre.service";
import {GenresListComponent} from "@app/admin/genres/components/genres-list/genres-list.component";

@Component({
  selector: 'app-genres-form',
  templateUrl: './genres-form.component.html',
  styleUrls: ['./genres-form.component.scss']
})
export class GenresFormComponent implements OnInit, OnDestroy {

  public files: File | FileList | any;
  disabled: boolean = false;
  hour = '23:59:59';

  environment = environment;

  constructor(
    public genreService: GenreService,
    public fileUploadService: TdFileService,
    public snackBar: SnackBarService,
    public api: HttpApiService,
    public genresListComponent: GenresListComponent,
  ) {
  }

  ngOnInit(): void {
  }

  ngOnDestroy(): void {
  }


// Books

  setBooks(books: any[]) {
      if (!books.length) {
        this.genreService.model.books = [];
      }
      this.genreService.model.books = books;
    }
  setBookIds(bookIds: any[]) {
    if (!bookIds.length) {
      this.genreService.model.book_ids = null;
    }
    this.genreService.model.book_ids = bookIds;
  }


}
