import {AfterViewInit, Component, OnInit, ViewChild} from '@angular/core';
import {Genre} from "@shared/interfaces/genre";
import {GenreService} from "@app/admin/genres/services/genre.service";
import {ActivatedRoute, Router} from "@angular/router";
import {environment} from "@env/environment";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-genres-list',
  templateUrl: './genres-list.component.html',
  styleUrls: ['./genres-list.component.scss']
})
export class GenresListComponent implements OnInit, AfterViewInit {

  @ViewChild('sidenav') sidenav: any;

  environment: any;

  constructor(
    public genreService: GenreService,
    public layoutService: AdminLayoutServiceService,
    public router: Router,
    private activatedRoute: ActivatedRoute,
  ) { }

  ngOnInit(): void {
    this.genreService.getItems();
    this.environment = environment
  }

  ngAfterViewInit() {
    this.genreService.sidenav = this.sidenav.sidenav;

    if (this.activatedRoute.snapshot.params.id) {
      if(this.activatedRoute.snapshot.params.id != 0) {
        this.genreService.getItem(this.activatedRoute.snapshot.params.id);
      } else {
        this.genreService.model = <Genre>{id: 0};
      }
      this.sidenav.sidenav.open();
    }
  }

}
