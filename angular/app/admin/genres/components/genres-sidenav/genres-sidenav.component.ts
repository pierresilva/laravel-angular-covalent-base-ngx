import {Component, OnInit, ViewChild} from '@angular/core';
import {Router} from "@angular/router";
import {GenresListComponent} from "@app/admin/genres/components/genres-list/genres-list.component";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-genres-sidenav',
  templateUrl: './genres-sidenav.component.html',
  styleUrls: ['./genres-sidenav.component.scss']
})
export class GenresSidenavComponent implements OnInit {

  @ViewChild('sidenav') sidenav: any;

  constructor(
    public router: Router,
    public layoutService: AdminLayoutServiceService,
    public genresListComponent: GenresListComponent
  ) { }

  ngOnInit(): void {
  }

}
