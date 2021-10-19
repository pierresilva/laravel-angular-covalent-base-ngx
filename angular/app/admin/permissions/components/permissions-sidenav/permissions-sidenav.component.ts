import {AfterViewInit, Component, OnInit, ViewChild} from '@angular/core';
import {Router} from "@angular/router";
import {PermissionsListComponent} from "@app/admin/permissions/components/permissions-list/permissions-list.component";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-permissions-sidenav',
  templateUrl: './permissions-sidenav.component.html',
  styleUrls: ['./permissions-sidenav.component.scss']
})
export class PermissionsSidenavComponent implements OnInit {

  @ViewChild('sidenav') sidenav: any;

  constructor(
    public router: Router,
    public layoutService: AdminLayoutServiceService,
    public permissionsListComponent: PermissionsListComponent
  ) { }

  ngOnInit(): void {

  }

}
