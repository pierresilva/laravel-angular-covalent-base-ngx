import {Title} from '@angular/platform-browser';
import {AfterViewInit, Component, OnInit, ViewChild} from '@angular/core';
import {Router} from '@angular/router';
import {MediaObserver} from '@angular/flex-layout';
import {DomSanitizer} from '@angular/platform-browser';
import {MatIconRegistry} from '@angular/material/icon';

import {tdRotateAnimation} from "@covalent/core/common";

import {AuthenticationService, CredentialsService} from '@app/auth';
import {Shell} from "@app/shell/shell.service";
import {TdLayoutComponent} from "@covalent/core/layout";
import {StorageLocalService} from "@shared";

@Component({
  selector: 'app-shell',
  templateUrl: './shell.component.html',
  styleUrls: ['./shell.component.scss'],
  animations: [
    tdRotateAnimation,
  ],
})
export class ShellComponent implements OnInit, AfterViewInit {

  @ViewChild('tdLayout') tdLayout: TdLayoutComponent | any;

  constructor(
    private router: Router,
    private titleService: Title,
    private authenticationService: AuthenticationService,
    private credentialsService: CredentialsService,
    private media: MediaObserver,
    private _iconRegistry: MatIconRegistry,
    private _domSanitizer: DomSanitizer,
    public storage: StorageLocalService,
    public shellService: Shell
  ) {
    this._iconRegistry.addSvgIconInNamespace('assets', 'logo-white',
      this._domSanitizer.bypassSecurityTrustResourceUrl('/assets/images/logo/logo-white.svg')
    );
    this._iconRegistry.addSvgIconInNamespace('assets', 'logo-black',
      this._domSanitizer.bypassSecurityTrustResourceUrl('/assets/images/logo/logo-black.svg')
    );
  }

  ngOnInit() {
  }

  ngAfterViewInit() {
    this.shellService.tdLayout = this.tdLayout;
  }

  logout() {
    this.authenticationService.logout()
      .subscribe(() => this.router.navigate(['/login'], {replaceUrl: true}));
  }

  get username(): string | null {
    const credentials = this.credentialsService.credentials;
    return credentials ? credentials.username : undefined;
  }

  get isMobile(): boolean {
    return this.media.isActive('xs') || this.media.isActive('sm');
  }

  get title(): string {
    return this.titleService.getTitle();
  }

  // Theme toggle
  get activeTheme(): string {

    if (!localStorage.getItem('theme')) {
      localStorage.setItem('theme', 'theme-dark');
    }

    return <string>localStorage.getItem('theme');
  }

  theme(theme: string): void {
    const bodyTag = document.getElementsByTagName('body');
    bodyTag[0].classList.toggle('theme-dark');
    localStorage.setItem('theme', theme);
  }
}
