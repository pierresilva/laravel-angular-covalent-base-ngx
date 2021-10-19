import {Component, OnInit, ViewChild} from '@angular/core';
import {Router} from "@angular/router";
import {BooksListComponent} from "@app/admin/books/components/books-list/books-list.component";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-books-sidenav',
  templateUrl: './books-sidenav.component.html',
  styleUrls: ['./books-sidenav.component.scss']
})
export class BooksSidenavComponent implements OnInit {

  @ViewChild('sidenav') sidenav: any;

  constructor(
    public router: Router,
    public layoutService: AdminLayoutServiceService,
    public booksListComponent: BooksListComponent
  ) { }

  ngOnInit(): void {
  }

}
