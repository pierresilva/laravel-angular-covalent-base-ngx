import {AfterViewInit, Component, OnInit, ViewChild} from '@angular/core';
import {Tag} from "@shared/interfaces/tag";
import {TagService} from "@app/admin/tags/services/tag.service";
import {ActivatedRoute, Router} from "@angular/router";
import {environment} from "@env/environment";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-tags-list',
  templateUrl: './tags-list.component.html',
  styleUrls: ['./tags-list.component.scss']
})
export class TagsListComponent implements OnInit, AfterViewInit {

  @ViewChild('sidenav') sidenav: any;

  environment: any;

  constructor(
    public tagService: TagService,
    public layoutService: AdminLayoutServiceService,
    public router: Router,
    private activatedRoute: ActivatedRoute,
  ) { }

  ngOnInit(): void {
    this.tagService.getItems();
    this.environment = environment
  }

  ngAfterViewInit() {
    this.tagService.sidenav = this.sidenav.sidenav;

    if (this.activatedRoute.snapshot.params.id) {
      if(this.activatedRoute.snapshot.params.id != 0) {
        this.tagService.getItem(this.activatedRoute.snapshot.params.id);
      } else {
        this.tagService.model = <Tag>{id: 0};
      }
      this.sidenav.sidenav.open();
    }
  }

}
