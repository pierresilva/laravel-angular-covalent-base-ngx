import { Injectable } from '@angular/core';
import {MediaObserver} from "@angular/flex-layout";

@Injectable({
  providedIn: 'root'
})
export class LibraryLayoutService {

  constructor(
    private mediaObserver: MediaObserver,
  ) { }

  get isMobile(): boolean {
    return this.mediaObserver.isActive('xs') || this.mediaObserver.isActive('sm');
  }
}
