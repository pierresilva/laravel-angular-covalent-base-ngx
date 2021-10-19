import {Injectable} from "@angular/core";
import { Routes, Route } from '@angular/router';

import { AuthenticationGuard } from '@app/auth';
import { ShellComponent } from './shell.component';
import {TdMediaService} from "@covalent/core/media";

@Injectable({
  providedIn: 'root'
})

/**
 * Provides helper methods to create routes.
 */
export class Shell {

  miniNav: boolean = true;
  year: string = new Date().getFullYear().toString();

  tdLayout: any = null;

  constructor(
    public media: TdMediaService
  ) { }

  /**
   * Creates routes using the shell component and authentication.
   * @param routes The routes to add.
   * @return The new route using shell as the base.
   */
  static childRoutes(routes: Routes): Route {
    return {
      path: '',
      component: ShellComponent,
      children: routes,
      canActivate: [AuthenticationGuard]
    };
  }

  toggleMiniNav(): void {
    this.miniNav = !this.miniNav;
    this.tdLayout.sidenav.toggle();
    setTimeout(() => {
      this.tdLayout.sidenav.toggle();
    });
  }
}
