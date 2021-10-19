import {AfterViewInit, Component, OnInit, ViewChild} from '@angular/core';
import {CovalentAuthorService} from "@app/covalent/covalent-authors/services/covalent-author.service";
import {CovalentLayoutService} from "@app/covalent/@layouts/services/covalent-layout.service";
import {AuthorService} from "@app/covalent/covalent-authors/services/author.service";
import {ActivatedRoute, Router} from "@angular/router";
import {Book} from "@shared/interfaces/book";

@Component({
  selector: 'app-covalent-authos-list',
  templateUrl: './covalent-authos-list.component.html',
  styleUrls: ['./covalent-authos-list.component.scss']
})
export class CovalentAuthosListComponent implements OnInit, AfterViewInit {

  @ViewChild('sidenav') sidenav: any;

  constructor(
    public covalentAuthorService: CovalentAuthorService,
    public layoutService: CovalentLayoutService,
    public authorService: AuthorService,
    public router: Router,
    private activatedRoute: ActivatedRoute,
  ) {
  }

  ngOnInit(): void {
    this.authorService.getItems()
  }

  ngAfterViewInit() {
    this.authorService.sidenav = this.sidenav.sidenav;

    if (this.activatedRoute.snapshot.params.id) {
      if(this.activatedRoute.snapshot.params.id != 0) {
        this.authorService.getItem(this.activatedRoute.snapshot.params.id);
      } else {
        this.authorService.model = <Book>{};
      }
      this.sidenav.sidenav.open();
    }
  }

}
