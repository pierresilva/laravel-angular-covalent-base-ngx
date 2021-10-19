import {AfterViewInit, Component, OnInit, ViewChild} from '@angular/core';
import {Author} from "@shared/interfaces/author";
import {AuthorService} from "@app/admin/authors/services/author.service";
import {ActivatedRoute, Router} from "@angular/router";
import {environment} from "@env/environment";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-authors-list',
  templateUrl: './authors-list.component.html',
  styleUrls: ['./authors-list.component.scss']
})
export class AuthorsListComponent implements OnInit, AfterViewInit {

  @ViewChild('sidenav') sidenav: any;

  environment: any;

  constructor(
    public authorService: AuthorService,
    public layoutService: AdminLayoutServiceService,
    public router: Router,
    private activatedRoute: ActivatedRoute,
  ) { }

  ngOnInit(): void {
    this.authorService.getItems();
    this.environment = environment
  }

  ngAfterViewInit() {
    this.authorService.sidenav = this.sidenav.sidenav;

    if (this.activatedRoute.snapshot.params.id) {
      if(this.activatedRoute.snapshot.params.id != 0) {
        this.authorService.getItem(this.activatedRoute.snapshot.params.id);
      } else {
        this.authorService.model = <Author>{id: 0};
      }
      this.sidenav.sidenav.open();
    }
  }

}
