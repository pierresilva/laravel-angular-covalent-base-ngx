import {AfterViewInit, Component, OnInit, ViewChild} from '@angular/core';
import {ActivatedRoute, Router} from "@angular/router";
import {PermissionService} from "@app/admin/permissions/services/permission.service";
import {User} from "@shared/interfaces/user";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-permissions-list',
  templateUrl: './permissions-list.component.html',
  styleUrls: ['./permissions-list.component.scss']
})
export class PermissionsListComponent implements OnInit, AfterViewInit {

  @ViewChild('sidenav') sidenav: any;

  constructor(
    public permissionService: PermissionService,
    public layoutService: AdminLayoutServiceService,
    public router: Router,
    private activatedRoute: ActivatedRoute,
  ) { }

  ngOnInit(): void {
    this.permissionService.getItems();
  }

  ngAfterViewInit() {
    this.permissionService.sidenav  = this.sidenav.sidenav;

    if (this.activatedRoute.snapshot.params.id) {
      if(this.activatedRoute.snapshot.params.id != 0) {
        this.permissionService.getItem(this.activatedRoute.snapshot.params.id);
      } else {
        this.permissionService.model = <User>{id: 0};
      }
      this.sidenav.sidenav.open();
    }
  }
}
