import {Component, Inject, OnInit} from '@angular/core';
import {MAT_DIALOG_DATA, MatDialogRef} from "@angular/material/dialog";

export interface dialogData {
  title?: any;
  json?: any;
}

@Component({
  selector: 'app-error-handler-dialog',
  templateUrl: './error-handler-dialog.component.html',
  styleUrls: ['./error-handler-dialog.component.scss']
})
export class ErrorHandlerDialogComponent implements OnInit {



  constructor(
    public dialogRef: MatDialogRef<ErrorHandlerDialogComponent>,
    @Inject(MAT_DIALOG_DATA) public data: dialogData
  ) { }

  ngOnInit(): void {
  }

  onNoClick(): void {
    this.dialogRef.close();
  }

}
