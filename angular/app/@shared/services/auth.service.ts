import {Injectable} from '@angular/core';
import {StorageLocalService} from './storage-local.service';
import {BehaviorSubject} from 'rxjs';
import {HttpApiService} from "@shared/services/http-api.service";

@Injectable({
  providedIn: 'root',
})
export class AuthService {

  public checkToken: any = null;

  /**
   * Save if a user is logged
   */
  public isLoggedSubject = new BehaviorSubject<boolean>(false);
  /**
   * Get the isLoggedSubject value
   */
  public isLogged = this.isLoggedSubject.asObservable();

  constructor(
    private api: HttpApiService,
    private storage: StorageLocalService,
  ) {
  }

  /**
   * Check if a user is logged
   */
  public userIsLogged(): boolean {
    const credentials = this.storage.get('credentials');

    if (credentials) {
      this.isLoggedSubject.next(true);
      return true;
    }
    this.isLoggedSubject.next(false);
    return false;
  }

  /**
   * Get UserToken
   */
  public getToken() {
    const token = this.storage.get('token');
    if (token) {
      return token;
    }

    return null;
  }

  /**
   * Get Credentials
   */
  public getCredentials() {
    const credentials = this.storage.get('credentials');
    if (credentials) {
      return credentials;
    }

    return null;
  }

  /**
   * Get item of JWT
   */
  public getTokenItem(item: string) {
    const decodedToken = this.decodeToken();

    if (decodedToken) {
      return decodedToken[item];
    }
    return null;
  }

  public startCheckExpirationToken() {
    const token = this.storage.get('token');
    if (token) {
      const exp = this.getTokenItem('exp');
      if (exp) {
        this.checkToken = setInterval(() => {
          if ((new Date((exp * 1000) - 20000) < new Date())) {
            console.log('Hay que refrescar el token')
          }
        }, 5000);
      }
    }
  }

  public stopCheckExpirationToken() {

    if (this.checkToken) {
      clearInterval(this.checkToken);
      this.checkToken = null;
    }
  }

  public hasRole(roles: string[]) {

    let ret = false;

    if (roles.length) {
      const userRoles = this.storage.get('credentials').acl.roles;
      if (userRoles && userRoles.length) {
        userRoles.map((userRole: string) => {
          if (roles.includes(userRole)) {
            ret = true;
          }
        })
      }
    }
    return ret;
  }

  hasPermission(permissions: string[]) {

    let ret = false;

    if (permissions.length) {
      const userPermissions = this.storage.get('credentials').acl.permissions
      if (userPermissions && userPermissions.length) {
        userPermissions.map((userPermission: string) => {
          permissions.map((permission: string) => {
            if (permission === userPermission) {
              ret = true;
            }
          })
        })
      }
    }

    return ret;
  }

  /**
   * Decode the JWT
   */
  private decodeToken() {
    const token = this.storage.get('token');

    if (token) {
      const jsonPayload = atob(token.split('.')[1]);
      return JSON.parse(jsonPayload);
    }
    return null;
  }

}
