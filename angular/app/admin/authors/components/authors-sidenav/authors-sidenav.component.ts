import {Component, OnInit, ViewChild} from '@angular/core';
import {Router} from "@angular/router";
import {AuthorsListComponent} from "@app/admin/authors/components/authors-list/authors-list.component";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-authors-sidenav',
  templateUrl: './authors-sidenav.component.html',
  styleUrls: ['./authors-sidenav.component.scss']
})
export class AuthorsSidenavComponent implements OnInit {

  @ViewChild('sidenav') sidenav: any;

  constructor(
    public router: Router,
    public layoutService: AdminLayoutServiceService,
    public authorsListComponent: AuthorsListComponent
  ) { }

  ngOnInit(): void {
  }

}
