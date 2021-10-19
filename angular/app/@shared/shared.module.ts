import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {HttpClientModule} from '@angular/common/http';
import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {TranslateModule} from '@ngx-translate/core';
import {FlexLayoutModule} from '@angular/flex-layout';

import {MaterialModule} from '@shared/material.module';
import {CovalentModule} from "@shared/covalent.module";
import {HttpApiService} from "@shared/services/http-api.service";
import {TdMediaService} from "@covalent/core/media";
import {InternalDocsService} from "@shared/services/internal-docs.service";

import {LoaderComponent} from './loader/loader.component';
import {BelongsToManyInputComponent} from '@shared/components/belongs-to-many-input/belongs-to-many-input.component';
import {RouterModule} from "@angular/router";
import {NgxMatSelectSearchModule} from "ngx-mat-select-search";
import {SnackBarService} from "@shared/services/snack-bar.service";
import {NgxEditorModule} from "ngx-editor";
import {NgxMatFileInputModule} from "@angular-material-components/file-input";
import {NgxMatColorPickerModule} from "@angular-material-components/color-picker";
import {
  NgxMatDatetimePickerModule,
  NgxMatNativeDateModule,
  NgxMatTimepickerModule
} from "@angular-material-components/datetime-picker";
import {ErrorHandlerDialogComponent} from "@shared/http/error-handler-dialog/error-handler-dialog.component";
import {CovalentJsonFormatterModule} from "@covalent/core/json-formatter";
import {StorageService} from "@shared/services/storage.service";
import {StorageLocalService} from "@shared/services/storage-local.service";
import {AuthService} from "@shared/services/auth.service";
import {StorageSessionService} from "@shared/services/storage-session.service";
import {HasRoleDirective} from "@shared/directives/has-role.directive";
import {HasPermissionDirective} from "@shared/directives/has-permission.directive";
import {ContentEditableDirective} from "@shared/directives/content-editable.directive";
import {ValidateUrlDirective} from "@shared/directives/validate-url.directive";
import {ValidateArrayLengthDirective} from "@shared/directives/validate-array-length.directive";
import {ValidateDateDirective} from "@shared/directives/validate-date.directive";
import {ValidateDateMaxDirective} from "@shared/directives/validate-date-max.directive";
import {ValidateDateMinDirective} from "@shared/directives/validate-date-min.directive";
import {ValidateEmailDirective} from "@shared/directives/validate-email.directive";
import {ValidateEqualToDirective} from "@shared/directives/validate-equal-to.directive";
import {ValidateGreaterThanDirective} from "@shared/directives/validate-greater-than.directive";
import {ValidateGreaterThanEqualDirective} from "@shared/directives/validate-greater-than-equal.directive";
import {ValidateLessThanDirective} from "@shared/directives/validate-less-than.directive";
import {ValidateLessThanEqualDirective} from "@shared/directives/validate-less-than-equal.directive";
import {ValidateMaxDirective} from "@shared/directives/validate-max.directive";
import {ValidateMinDirective} from "@shared/directives/validate-min.directive";
import {ValidateNotEqualToDirective} from "@shared/directives/validate-not-equal-to.directive";
import {ValidatePhoneDirective} from "@shared/directives/validate-phone.directive";
import {ValidateRangeDirective} from "@shared/directives/validate-range.directive";
import {ValidateRangeLengthDirective} from "@shared/directives/validate-range-length.directive";
import {ValidateTimeMinDirective} from "@shared/directives/validate-time-min.directive";
import {ValidateTimeMaxDirective} from "@shared/directives/validate-time-max.directive";
import {DateFormatPipe} from "@shared/pipes/date-format.pipe";
import {EllipsisPipe} from "@shared/pipes/ellipsis.pipe";
import {StripHtmlPipe} from "@shared/pipes/strip-html.pipe";
import {IonicModule} from "@ionic/angular";
import {FeatherIconsModule} from "@shared/feather-icons.module";
import { BelongsToInputComponent } from './components/belongs-to-input/belongs-to-input.component';
import { LowerCasePipe, UpperCasePipe, TitleCasePipe } from '@angular/common';
import {DatetimeFormatPipe} from "@shared/pipes/datetime-format.pipe";

@NgModule({
  imports: [
    CommonModule,
    FlexLayoutModule,
    MaterialModule,
    TranslateModule,
    FormsModule,
    ReactiveFormsModule,
    CovalentJsonFormatterModule,
    IonicModule.forRoot(),
    RouterModule,
  ],
  declarations: [
    LoaderComponent,
    ErrorHandlerDialogComponent,
    BelongsToManyInputComponent,
    HasRoleDirective,
    HasPermissionDirective,
    ContentEditableDirective,
    ValidateArrayLengthDirective,
    ValidateDateDirective,
    ValidateDateMaxDirective,
    ValidateDateMinDirective,
    ValidateEmailDirective,
    ValidateEqualToDirective,
    ValidateGreaterThanDirective,
    ValidateGreaterThanEqualDirective,
    ValidateLessThanDirective,
    ValidateLessThanEqualDirective,
    ValidateMaxDirective,
    ValidateMinDirective,
    ValidateNotEqualToDirective,
    ValidatePhoneDirective,
    ValidateRangeDirective,
    ValidateRangeLengthDirective,
    ValidateTimeMinDirective,
    ValidateTimeMaxDirective,
    ValidateUrlDirective,
    DateFormatPipe,
    DatetimeFormatPipe,
    EllipsisPipe,
    StripHtmlPipe,
    BelongsToInputComponent,
  ],
  exports: [
    FormsModule,
    ReactiveFormsModule,
    FlexLayoutModule,
    HttpClientModule,
    MaterialModule,
    CovalentModule,
    TranslateModule,
    IonicModule,
    FeatherIconsModule,
    NgxMatSelectSearchModule,
    NgxEditorModule,
    NgxMatFileInputModule,
    NgxMatColorPickerModule,
    NgxMatDatetimePickerModule,
    NgxMatTimepickerModule,
    NgxMatNativeDateModule,

    LoaderComponent,
    BelongsToManyInputComponent,

    HasRoleDirective,
    HasPermissionDirective,
    ContentEditableDirective,
    ValidateArrayLengthDirective,
    ValidateDateDirective,
    ValidateDateMaxDirective,
    ValidateDateMinDirective,
    ValidateEmailDirective,
    ValidateEqualToDirective,
    ValidateGreaterThanDirective,
    ValidateGreaterThanEqualDirective,
    ValidateLessThanDirective,
    ValidateLessThanEqualDirective,
    ValidateMaxDirective,
    ValidateMinDirective,
    ValidateNotEqualToDirective,
    ValidatePhoneDirective,
    ValidateRangeDirective,
    ValidateRangeLengthDirective,
    ValidateTimeMinDirective,
    ValidateTimeMaxDirective,
    ValidateUrlDirective,
    DateFormatPipe,
    DatetimeFormatPipe,
    EllipsisPipe,
    StripHtmlPipe,
    BelongsToInputComponent,
  ],
  providers: [
    TdMediaService,
    InternalDocsService,
    HttpApiService,
    SnackBarService,
    StorageService,
    StorageLocalService,
    StorageSessionService,
    AuthService,

    LowerCasePipe,
    TitleCasePipe,
    UpperCasePipe
  ]
})
export class SharedModule {
}
