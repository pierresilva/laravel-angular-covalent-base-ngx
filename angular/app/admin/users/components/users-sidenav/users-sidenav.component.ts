import {Component, OnInit, ViewChild} from '@angular/core';
import {Router} from "@angular/router";
import {UsersListComponent} from "@app/admin/users/components/users-list/users-list.component";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-users-sidenav',
  templateUrl: './users-sidenav.component.html',
  styleUrls: ['./users-sidenav.component.scss']
})
export class UsersSidenavComponent implements OnInit {

  @ViewChild('sidenav') sidenav: any;

  constructor(
    public router: Router,
    public layoutService: AdminLayoutServiceService,
    public usersListComponent: UsersListComponent,
  ) { }

  ngOnInit(): void {
  }

}
