import { SharedModule } from '@shared';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LanguageSelectorComponent } from './language-selector.component';

@NgModule({
  imports: [
    CommonModule,
    SharedModule,
  ],
  declarations: [
    LanguageSelectorComponent,
  ],
  exports: [
    LanguageSelectorComponent,
  ]
})
export class I18nModule { }
