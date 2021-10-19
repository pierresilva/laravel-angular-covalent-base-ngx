import { Component, OnInit } from '@angular/core';
import {MediaObserver} from "@angular/flex-layout";

@Component({
  selector: 'app-notifications',
  templateUrl: './notifications.component.html',
  styleUrls: ['./notifications.component.scss']
})
export class NotificationsComponent implements OnInit {

  constructor(
    private mediaObserver: MediaObserver,
  ) { }

  ngOnInit(): void {
  }

  get isMobile(): boolean {
    return this.mediaObserver.isActive('xs') || this.mediaObserver.isActive('sm');
  }

}
