import {Component, OnInit} from '@angular/core';
import {Router, ActivatedRoute} from '@angular/router';
import {FormGroup, FormBuilder, Validators} from '@angular/forms';
import {finalize} from 'rxjs/operators';

import {environment} from '@env/environment';
import {Logger, UntilDestroy, untilDestroyed} from '@shared';
import {AuthenticationService} from './authentication.service';
import {TdLoadingService} from "@covalent/core/loading";
import {HttpApiService} from "@shared/services/http-api.service";
import {HttpClient} from "@angular/common/http";
import {CredentialsService} from "@app/auth/credentials.service";

const log = new Logger('Login');

@UntilDestroy()
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  version: string | null = environment.version;
  error: string | undefined;
  loginForm!: FormGroup;
  isLoading = false;
  overlayStarSyntax: boolean = false;

  constructor(
    public api: HttpApiService,
    public http: HttpClient,
    private router: Router,
    private route: ActivatedRoute,
    private formBuilder: FormBuilder,
    private credentialsService: CredentialsService
  ) {
    this.createForm();
  }

  ngOnInit() {
  }

  login() {
    this.isLoading = true;
    const login$ = this.http.post('api/auth/login', {
      email: this.loginForm.value.username,
      password: this.loginForm.value.password,
    });
    login$
      .pipe(
        finalize(() => {
          this.loginForm.markAsPristine();
          this.isLoading = false;
        }),
        untilDestroyed(this)
      )
      .subscribe(
        (res: any) => {
          log.debug(`${res.data.user.name} successfully logged in`);
          const data = {
            username: res.data.user.name,
            email: res.data.user.email,
            token: res.data.token,
            refreshToken: res.data.reefreshToken,
            acl: res.data.acl
          };
          this.credentialsService.setCredentials(data, this.loginForm.value.remember);
          this.router.navigate([this.route.snapshot.queryParams.redirect || '/'], {replaceUrl: true});
        },
        (error) => {
          log.debug(`Login error: ${JSON.stringify(error.error)}`);
          this.error = error;

          let text = '';

          if (error.error.errors && error.error.errors.length) {
            // tslint:disable-next-line:prefer-for-of
            for (let i = 0; i < error.error.errors.length; i++) {
              text += error.error.errors[i].message + '<br>';
            }
          }

        }
      );
  }

  get getControl() {
    return this.loginForm.controls;
  }

  private createForm() {
    this.loginForm = this.formBuilder.group({
      username: ['', Validators.required],
      password: ['', Validators.required],
      remember: true
    });
  }

}
