import {AfterViewInit, Component, OnInit, ViewChild} from '@angular/core';
import {RoleService} from "@app/admin/roles/services/role.service";
import {ActivatedRoute, Router} from "@angular/router";
import {User} from "@shared/interfaces/user";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-roles-list',
  templateUrl: './roles-list.component.html',
  styleUrls: ['./roles-list.component.scss']
})
export class RolesListComponent implements OnInit, AfterViewInit {

  @ViewChild('sidenav') sidenav: any;

  constructor(
    public roleService: RoleService,
    public layoutService: AdminLayoutServiceService,
    public router: Router,
    private activatedRoute: ActivatedRoute,
  ) { }

  ngOnInit(): void {
    this.roleService.getItems();
  }

  ngAfterViewInit() {
    this.roleService.sidenav  = this.sidenav.sidenav;

    if (this.activatedRoute.snapshot.params.id) {
      if(this.activatedRoute.snapshot.params.id != 0) {
        this.roleService.getItem(this.activatedRoute.snapshot.params.id);
      } else {
        this.roleService.model = <User>{id: 0};
      }
      this.sidenav.sidenav.open();
    }
  }

}
