import { Component, OnInit } from '@angular/core';
import {AuthenticationService} from "@app/auth";
import {Router} from "@angular/router";

@Component({
  selector: 'app-shell-menu-drawer',
  templateUrl: './shell-menu-drawer.component.html',
  styleUrls: ['./shell-menu-drawer.component.scss']
})
export class ShellMenuDrawerComponent implements OnInit {

  constructor(
    private authenticationService: AuthenticationService,
    private router: Router,
  ) { }

  ngOnInit(): void {
  }

  logout() {
    this.authenticationService.logout()
      .subscribe(() => this.router.navigate(['/login'], { replaceUrl: true }));
  }

}
