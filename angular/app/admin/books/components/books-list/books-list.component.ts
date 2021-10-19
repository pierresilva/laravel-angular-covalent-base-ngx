import {AfterViewInit, Component, OnInit, ViewChild} from '@angular/core';
import {Book} from "@shared/interfaces/book";
import {BookService} from "@app/admin/books/services/book.service";
import {ActivatedRoute, Router} from "@angular/router";
import {environment} from "@env/environment";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-books-list',
  templateUrl: './books-list.component.html',
  styleUrls: ['./books-list.component.scss']
})
export class BooksListComponent implements OnInit, AfterViewInit {

  @ViewChild('sidenav') sidenav: any;

  environment: any;

  constructor(
    public bookService: BookService,
    public layoutService: AdminLayoutServiceService,
    public router: Router,
    private activatedRoute: ActivatedRoute,
  ) { }

  ngOnInit(): void {
    this.bookService.getItems();
    this.environment = environment
  }

  ngAfterViewInit() {
    this.bookService.sidenav = this.sidenav.sidenav;

    if (this.activatedRoute.snapshot.params.id) {
      if(this.activatedRoute.snapshot.params.id != 0) {
        this.bookService.getItem(this.activatedRoute.snapshot.params.id);
      } else {
        this.bookService.model = <Book>{id: 0};
      }
      this.sidenav.sidenav.open();
    }
  }

}
