import {AfterViewInit, Component, OnInit, ViewChild} from '@angular/core';
import {UserService} from "@app/admin/users/services/user.service";
import {ActivatedRoute, Router} from "@angular/router";
import {User} from "@shared/interfaces/user";
import {environment} from "@env/environment";
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-users-list',
  templateUrl: './users-list.component.html',
  styleUrls: ['./users-list.component.scss']
})
export class UsersListComponent implements OnInit, AfterViewInit {

  @ViewChild('sidenav') sidenav: any;

  environment: any;

  constructor(
    public user: UserService,
    public layoutService: AdminLayoutServiceService,
    public router: Router,
    private activatedRoute: ActivatedRoute,
  ) { }

  ngOnInit(): void {
    this.user.getItems();
    this.environment = environment
  }

  ngAfterViewInit() {
    this.user.sidenav = this.sidenav.sidenav;

    if (this.activatedRoute.snapshot.params.id) {
      if(this.activatedRoute.snapshot.params.id != 0) {
        this.user.getItem(this.activatedRoute.snapshot.params.id);
      } else {
        this.user.model = <User>{id: 0};
      }
      this.sidenav.sidenav.open();
    }
  }

}
