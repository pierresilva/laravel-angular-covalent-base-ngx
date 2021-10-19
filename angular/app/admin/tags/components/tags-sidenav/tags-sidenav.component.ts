import {Component, OnInit, ViewChild} from '@angular/core';
import {Router} from "@angular/router";
import {TagsListComponent} from "@app/admin/tags/components/tags-list/tags-list.component";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-tags-sidenav',
  templateUrl: './tags-sidenav.component.html',
  styleUrls: ['./tags-sidenav.component.scss']
})
export class TagsSidenavComponent implements OnInit {

  @ViewChild('sidenav') sidenav: any;

  constructor(
    public router: Router,
    public layoutService: AdminLayoutServiceService,
    public tagsListComponent: TagsListComponent
  ) { }

  ngOnInit(): void {
  }

}
