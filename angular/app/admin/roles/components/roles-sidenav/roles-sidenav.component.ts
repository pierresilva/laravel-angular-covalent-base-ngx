import {Component, OnInit, ViewChild} from '@angular/core';
import {Router} from "@angular/router";
import {RolesListComponent} from "@app/admin/roles/components/roles-list/roles-list.component";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-roles-sidenav',
  templateUrl: './roles-sidenav.component.html',
  styleUrls: ['./roles-sidenav.component.scss']
})
export class RolesSidenavComponent implements OnInit {

  @ViewChild('sidenav') sidenav: any;

  constructor(
    public router: Router,
    public layoutService: AdminLayoutServiceService,
    public rolesListComponent: RolesListComponent
  ) { }

  ngOnInit(): void {
  }

}
