import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, CanActivateChild, CanDeactivate, CanLoad, Route, RouterStateSnapshot, UrlSegment, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import {AuthService} from "@shared";
import {SnackBarService} from "@shared/services/snack-bar.service";

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate, CanActivateChild {

  constructor(
    private auth: AuthService,
    private snackBar: SnackBarService
    ) {
  }

  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    if (route.data.logged) {
      if (!(this.auth.userIsLogged() === route.data.logged)) {
        this.snackBar.warning('No estas logueado!');
        return false;
      }
    }
    if (route.data.roles !== undefined) {
      if (!this.auth.hasRole(route.data.roles)) {
        this.snackBar.warning('No tienes el rol necesario!');
        return false;
      }
    }
    if (route.data.permissions !== undefined) {
      if (!this.auth.hasPermission(route.data.permissions)) {
        this.snackBar.warning('No tienes el permiso necesario!');
        return false;
      }
    }
    return true;
  }

  canActivateChild(
    childRoute: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    if (childRoute.data.logged) {
      if (!(this.auth.userIsLogged() === childRoute.data.logged)) {
        this.snackBar.warning('No estas logueado!');
        return false;
      }
    }
    if (childRoute.data.roles) {
      if (!this.auth.hasRole(childRoute.data.roles)) {
        this.snackBar.warning('No tienes el rol necesario!');
        return false;
      }
    }
    if (childRoute.data.permissions) {
      if (!this.auth.hasPermission(childRoute.data.permissions)) {
        this.snackBar.warning('No tienes el permiso necesario!');
        return false;
      }
    }
    return true;
  }
}
