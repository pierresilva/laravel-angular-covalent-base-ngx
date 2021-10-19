import { Injectable } from '@angular/core';
import {MatSnackBar, MatSnackBarConfig} from "@angular/material/snack-bar";

@Injectable({
  providedIn: 'root'
})
export class SnackBarService {

  config: MatSnackBarConfig = {
    horizontalPosition: 'center',
    verticalPosition: 'top'
  }

  constructor(
    private snackBar:MatSnackBar,
  ) { }


  public openSnackBar(message: string, action: string = '', color: any = null) {
    this.snackBar.open(message, action, {
      panelClass: color
    });
  }

  public success(msg:string) {
    this.config['panelClass'] = ['success', 'notification']
    this.snackBar.open(msg,'OK', this.config)
  }

  public error(msg:string) {
    this.config['panelClass'] = ['error', 'notification']
    this.snackBar.open(msg,'OK', this.config)
  }

  public info(msg:string) {
    this.config['panelClass'] = ['info', 'notification']
    this.snackBar.open(msg,'OK', this.config)
  }

  public warning(msg:string) {
    this.config['panelClass'] = ['warning', 'notification']
    this.snackBar.open(msg,'OK', this.config)
  }
}
