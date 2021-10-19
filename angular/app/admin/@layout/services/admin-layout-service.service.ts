import { Injectable } from '@angular/core';
import {TdMediaService} from "@covalent/core/media";
import {MediaObserver} from "@angular/flex-layout";

@Injectable({
  providedIn: 'root'
})
export class AdminLayoutServiceService {

  manageList: any = null;

  tdLayout: any = null;

  miniNav: boolean = false;

  year: string = new Date().getFullYear().toString();

  constructor(
    public media: TdMediaService,
    private mediaObserver: MediaObserver,
  ) { }

  public toggleMiniNav(): void {
    this.miniNav = !this.miniNav;
    this.tdLayout.sidenav.toggle();
    setTimeout(() => {
      this.tdLayout.sidenav.toggle();
    });
  }

  public get isMobile(): boolean {
    return this.mediaObserver.isActive('xs') || this.mediaObserver.isActive('sm');
  }
}
