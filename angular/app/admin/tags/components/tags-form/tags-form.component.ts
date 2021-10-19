import {Component, OnDestroy, OnInit} from '@angular/core';
import {environment} from "@env/environment";
import {Editor} from "ngx-editor";
import {TdFileService} from "@covalent/core/file";
import {SnackBarService} from "@shared/services/snack-bar.service";
import {HttpApiService} from "@shared/services/http-api.service";
import {TagService} from "@app/admin/tags/services/tag.service";
import {TagsListComponent} from "@app/admin/tags/components/tags-list/tags-list.component";

@Component({
  selector: 'app-tags-form',
  templateUrl: './tags-form.component.html',
  styleUrls: ['./tags-form.component.scss']
})
export class TagsFormComponent implements OnInit, OnDestroy {

  public files: File | FileList | any;
  disabled: boolean = false;
  hour = '23:59:59';

  environment = environment;

  constructor(
    public tagService: TagService,
    public fileUploadService: TdFileService,
    public snackBar: SnackBarService,
    public api: HttpApiService,
    public tagsListComponent: TagsListComponent,
  ) {
  }

  ngOnInit(): void {
  }

  ngOnDestroy(): void {
  }


// Books

  setBooks(books: any[]) {
    if (!books.length) {
      this.tagService.model.books = [];
    }
    this.tagService.model.books = books;
  }
  setBookIds(bookIds: any[]) {
    if (!bookIds.length) {
      this.tagService.model.book_ids = null;
    }
    this.tagService.model.book_ids = bookIds;
  }


}
