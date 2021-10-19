import {Inject, Injectable} from '@angular/core';
import { HttpEvent, HttpInterceptor, HttpHandler, HttpRequest } from '@angular/common/http';
import { Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';

import { environment } from '@env/environment';
import { Logger } from '../logger.service';
import {TdDialogService} from "@covalent/core/dialogs";
import {MatDialog} from "@angular/material/dialog";
import {ErrorHandlerDialogComponent} from "@shared/http/error-handler-dialog/error-handler-dialog.component";
import {SnackBarService} from "@shared/services/snack-bar.service";

const log = new Logger('ErrorHandlerInterceptor');

/**
 * Adds a default error handler to all requests.
 */
@Injectable({
  providedIn: 'root'
})
export class ErrorHandlerInterceptor implements HttpInterceptor {

  constructor(
    private _dialogService: TdDialogService,
    public dialog: MatDialog,
    public snackbar: SnackBarService
  ) {

  }

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    return next.handle(request).pipe(catchError(error => this.errorHandler(error)));
  }

  // Customize the default error handler here if needed
  private errorHandler(response: HttpEvent<any> | any): Observable<HttpEvent<any>> {
    if (!environment.production) {
      // Do something with the error
      this.openDialog('Request error', response);
      log.error('Request error', response);
    }

    if  (response.status === 422) {
      this.snackbar.error(response.error.message);
    }

    if  (response.status === 401) {
      this.snackbar.error(response.error.message);
    }

    throw response;
  }

  openDialog(title: any, json: any): void {
    const dialogRef = this.dialog.open(ErrorHandlerDialogComponent, {
      data: {title: title, json: json}
    });

    dialogRef.afterClosed().subscribe(result => {
      console.log('The dialog was closed');
    });
  }


}
