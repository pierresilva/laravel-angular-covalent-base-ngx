import {Injectable} from '@angular/core';
import {Router, CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot} from '@angular/router';

import {Logger} from '@shared';
import {CredentialsService} from './credentials.service';
import {SnackBarService} from "@shared/services/snack-bar.service";

const log = new Logger('AuthenticationGuard');

@Injectable({
  providedIn: 'root'
})
export class AuthenticationGuard implements CanActivate {

  constructor(
    private router: Router,
    private credentialsService: CredentialsService,
    private snackBar: SnackBarService
  ) {
  }

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): boolean {
    if (this.credentialsService.isAuthenticated()) {
      return true;
    }

    log.debug('Not authenticated, redirecting and adding redirect url...');
    this.snackBar.warning('No estas autenticado!');
    this.router.navigate(['/login'], {queryParams: {redirect: state.url}, replaceUrl: true});
    return false;
  }

}
