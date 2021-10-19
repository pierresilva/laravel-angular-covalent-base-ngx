import {Component, OnDestroy, OnInit} from '@angular/core';
import {environment} from "@env/environment";
import {Editor} from "ngx-editor";
import {TdFileService} from "@covalent/core/file";
import {SnackBarService} from "@shared/services/snack-bar.service";
import {HttpApiService} from "@shared/services/http-api.service";
import {AuthorService} from "@app/admin/authors/services/author.service";
import {AuthorsListComponent} from "@app/admin/authors/components/authors-list/authors-list.component";

@Component({
  selector: 'app-authors-form',
  templateUrl: './authors-form.component.html',
  styleUrls: ['./authors-form.component.scss']
})
export class AuthorsFormComponent implements OnInit, OnDestroy {

  public files: File | FileList | any;
  disabled: boolean = false;
  hour = '23:59:59';

  environment = environment;

  constructor(
    public authorService: AuthorService,
    public fileUploadService: TdFileService,
    public snackBar: SnackBarService,
    public api: HttpApiService,
    public authorsListComponent: AuthorsListComponent,
  ) {
  }

  ngOnInit(): void {
  }

  ngOnDestroy(): void {
  }


// Books

  setBooks(books: any[]) {
    if (!books.length) {
      this.authorService.model.books = [];
    }
    this.authorService.model.books = books;
  }
  setBookIds(bookIds: any[]) {
    if (!bookIds.length) {
      this.authorService.model.book_ids = null;
    }
    this.authorService.model.book_ids = bookIds;
  }


}
