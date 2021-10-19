import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { GenresRoutingModule } from './genres-routing.module';
import { GenresListComponent } from './components/genres-list/genres-list.component';
import { GenresFormComponent } from './components/genres-form/genres-form.component';
import { GenresViewComponent } from './components/genres-view/genres-view.component';


@NgModule({
  declarations: [
    GenresListComponent,
    GenresFormComponent,
    GenresViewComponent
  ],
  imports: [
    CommonModule,
    GenresRoutingModule
  ]
})
export class GenresModule { }
